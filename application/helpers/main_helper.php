<?php
 
if ( ! function_exists('upload_img'))
{
    
    function upload_img($imagename,$folder)
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
if ( ! function_exists('upload_img_webp'))
{
    
    function upload_img_webp($imageTempName,$imageType,$folder,$size_array=[])
    {

        $image_name = rand(10,100).time();

        list($width,$height)=getimagesize($imageTempName);
        
        if(count($size_array)>0){
            foreach ($size_array as $new_size) {
                //print_r($new_size);
                $sizeArray = explode(",",$new_size);
                $nwidth = $sizeArray[0];
                count($sizeArray) >1 ? $nheight = $sizeArray[1] : $nheight = $sizeArray[0];
                $newimage=imagecreatetruecolor($nwidth,$nheight);

                if($imageType=='image/jpeg'){
                    //print_r("</br>JPEG runs");
                    $source=imagecreatefromjpeg($imageTempName);
                    imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                    $file_name=$image_name.$nwidth.$nheight.'.webp';
                    imagejpeg($newimage,$folder."/".$file_name);
                }elseif($imageType=='image/jpg'){
                    //print_r("</br> Jpg runs");
                    $source=imagecreatefrompng($imageTempName);
                    imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                    $file_name=$image_name.$nwidth.$nheight.'.webp';
                    imagepng($newimage,$folder."/".$file_name);
                }elseif($imageType=='image/png'){
                    //print_r("</br> png runs");
                    $source=imagecreatefrompng($imageTempName);
                    imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                    $file_name=$image_name.$nwidth.$nheight.'.webp';
                    imagepng($newimage,$folder."/".$file_name);
                }elseif($imageType=='image/webp'){
                    //print_r("</br> webp runs");
                    $source=imagecreatefromwebp($imageTempName);
                    imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                    $file_name=$image_name.$nwidth.$nheight.'.webp';
                    imagegif($newimage,$folder."/".$file_name);
                }else{
                    echo "Please select only jpg, png and gif image";
                }
            }
            return $image_name;
        }


        
    }
}

if ( ! function_exists('set_flash_message'))
{


    function set_flash_message($message,$class)
    {
        $CI =& get_instance();
        $messge = array('message' => $message,'class' => 'alert alert-'.$class);
            $CI->session->set_flashdata('item',$messge );
    }
        

}

if ( ! function_exists('get_price'))
{


    function get_price($city,$product)
    {
            if(isset($product[$city.'_500']) && $product[$city.'_500'] !==""){
                $product['default'] = $product[$city.'_500'];
            }else if(isset($product[$city.'_1000']) && $product[$city.'_1000'] !==""){
                $product['default'] = $product[$city.'_1000'];
            }else if(isset($product[$city.'_1500']) && $product[$city.'_1500'] !==""){
                $product['default'] = $product[$city.'_1500'];
            }else if(isset($product[$city.'_2000']) && $product[$city.'_2000'] !==""){
                $product['default'] = $product[$city.'_2000'];
            }else if( isset($product[$city.'_3000']) && $product[$city.'_3000'] !==""){
                $product['default'] = $product[$city.'_3000'];
            }else if(isset($product[$city.'_5000']) && $product[$city.'_5000'] !==""){
                $product['default'] = $product[$city.'_5000'];

            }else if($product['default_500'] !==""){
                $product['default'] = $product['default_500'];
            }else if($product['default_1000'] !==""){
                $product['default'] = $product['default_1000'];
            }else if($product['default_1500'] !==""){
                $product['default'] = $product['default_1500'];
            }else if($product['default_2000'] !==""){
                $product['default'] = $product['default_2000'];
            }else if($product['default_3000'] !==""){
                $product['default'] = $product['default_3000'];
            }else if($product['default_5000'] !==""){
                $product['default'] = $product['default_5000'];
            }

            $price_array = explode('/', $product['default']);

            //print_r($price_array);die();


            if(count($price_array )>1){
                return  $price_array[1];
            }else{
                return  $price_array[0];
            }
    }
        

}


if ( ! function_exists('get_price_by_weight'))
{


    function get_price_by_weight($city,$product,$weight)
    {
            if($product[$city.'_500'] !==""){
                $product['default'] = $product[$city.'_500'];
            }else if($product[$city.'_1000'] !==""){
                $product['default'] = $product[$city.'_1000'];
            }else if($product[$city.'_1500'] !==""){
                $product['default'] = $product[$city.'_1500'];
            }else if($product[$city.'_2000'] !==""){
                $product['default'] = $product[$city.'_2000'];
            }else if($product[$city.'_3000'] !==""){
                $product['default'] = $product[$city.'_3000'];
            }else if($product[$city.'_5000'] !==""){
                $product['default'] = $product[$city.'_5000'];
            }else if($product['default_500'] !==""){
                $product['default'] = $product['default_500'];
            }else if($product['default_1000'] !==""){
                $product['default'] = $product['default_1000'];
            }else if($product['default_1500'] !==""){
                $product['default'] = $product['default_1500'];
            }else if($product['default_2000'] !==""){
                $product['default'] = $product['default_2000'];
            }else if($product['default_3000'] !==""){
                $product['default'] = $product['default_3000'];
            }else if($product['default_5000'] !==""){
                $product['default'] = $product['default_5000'];
            }

            $price_array = explode('/', $product['default']);

            //print_r($price_array);die();


            if(count($price_array )>1){
                return  $price_array[1];
            }else{
                return  $price_array[0];
            }
    }
        

}