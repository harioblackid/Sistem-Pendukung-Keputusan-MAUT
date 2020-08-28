<?php
include 'Core.inc.php';

include 'Config.php';
include 'User.inc.php';
    

$config = new Config();
$db = $config->getConnection();

$login = new User($db);
    
    $login->username = $_POST['username'];
    $login->password = md5($_POST['password']);
    
    if($login->login()) {
    	if($_SESSION['level'] == "admin"){
    		echo $login->ajaxRedirect("$base_url/?pg=dashboard");	
    	}
    	else{
    		echo $login->errorMessage("Akses tidak diizinkan!");		
    	}    		
    	
    }
    else
    {
    	echo $login->errorMessage("Username / Password tidak benar");
    }

?>