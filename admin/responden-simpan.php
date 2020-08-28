<?php
include '../class/Core.inc.php';

include '../class/Config.php';
include '../class/User.inc.php';

$config = new Config();
$db = $config->getConnection();

$user = new User($db);

	$user->id = $_POST["id"];
	$user->level = "user";
  	$user->username = $_POST["username"];
  	$user->password = $_POST["password"];
	$user->nama_lengkap = $_POST["nama_lengkap"];

	
		if($_POST['new'] == $_POST['password']){
			if($user->insert() == true){
				echo $user->successMessage("Responden baru berhasil ditambah!", "$base_url/?pg=responden");
			}
			else{
				echo $user->conn->error;
			}
		}
		else{
			echo $user->errorMessage("Password baru tidak sesuai!!!");
		}
?>