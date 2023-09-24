<?php
 
if ( ! function_exists('render'))
{
    $CI = &get_instance();

    // function client_render(string $name, array $data = [], array $options = [])
    // {
        
    //     $data['content'] = view("client/".$name,$data, $options);
    //     return $this->load->view('client/layout',$data,$options);
    // }

    function admin_render(string $name, array $data = [], array $options = [])
    {
        $CI = &get_instance();
        $data['name'] = "admin/".$name;
        return $CI->load->view('admin/layout',['data'=>$data],$name,$options);
    }
    function client_render(string $name, array $data = [], array $options = [])
    {
        $CI = &get_instance();
        $data['name'] = "front/".$name;
        return $CI->load->view('front/layout',['data'=>$data],$name,$options);
    }



}

