<?php
 
if ( ! function_exists('addToCart'))
{
    
    function addToCart($imagename,$folder)
    {

        $image=$_FILES[$imagename]['name'];
        //print_r($image);die();
        $CI =& get_instance();
        $config=array(
            'upload_path' => $folder,
            'allowed_types' => 'pdf|jpg|jpeg|png',
            'max_size'=>'100000',
            'file_name'=>$image
        );
        $CI->load->library('upload',$config);
        $CI->upload->initialize($config);
        if ($CI->upload->do_upload($imagename)) {

            $fileData = $CI->upload->data();
            $file_name= $fileData['file_name'];
            return $file_name;
        } else {
            return false;
        }
    }
}

?>