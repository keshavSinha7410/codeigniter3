<?php

 $CI = &get_instance();
 
if ( ! function_exists('orderInsert'))
{
    //$CI->load->view('admin/layout');
    $CI->load->model('front/Order_model' , 'Order_model');; 
    
    function orderInsert($batch_id,$payUTransactionId='')
    {
        $CI = &get_instance();

        $temp_cart = $CI->db->query("select * from temp_cart where batch='$batch_id'")->result_array();
        $inserted_data_ids = [];
        foreach ($temp_cart  as $cart) {

            $cid = $cart['cart_id'];
            unset($cart['id']);
            $cart['transaction_id'] = $payUTransactionId;
            $cart['payment_status'] = "done";
            $id = $CI->Order_model->insert($cart);
            $id > 0 ? array_push($inserted_data_ids,$id) :"";
            
            deleteFromCartAndTemCart($cid);
        }


        return $inserted_data_ids;

    }
}

if ( ! function_exists('deleteFromCartAndTemCart'))
{

    
    function deleteFromCartAndTemCart($cart)
    {
        $CI = &get_instance();
        $_cart = $CI->db->query("delete from cart where id='$cart'");
        $temp_cart = $CI->db->query("delete from temp_cart where cart_id='$cart'");

        if($_cart && $temp_cart){
            return true;
        }else{
            return false;
        }

        
    }
}

?>