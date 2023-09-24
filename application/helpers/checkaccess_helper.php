<?php
 
if ( ! function_exists('checkAccess'))
{
    
    function checkAccess($fname,$redirect="adminn")
    {
    	$role = ["1"=>"All","5"=>["test1","test2","test3"]];
    	$redirect = ["1"=>"adminn","5"=>"adminuser","10"=>"/"];


    	if (!isset($_SESSION['role']) ) {
			redirect(base_url($redirect));
		}else{
			$role[$_SESSION['role']];

			if($role[$_SESSION['role']]=="All"){
				return true;
			}

			if (!in_array($fname,$role[$_SESSION['role']]) ) {
				set_flash_message("You Don't Have permission To Access","danger");
				redirect(base_url($redirect[$_SESSION['role']]));
			}
			return true;
		}

    }
}

?>