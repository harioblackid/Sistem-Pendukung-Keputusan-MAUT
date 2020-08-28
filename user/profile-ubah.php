<?php
include '../class/Core.inc.php';

include '../class/Config.php';
include '../class/User.inc.php';

$config = new Config();
$db = $config->getConnection();

$user = new User($db);

	$user->id = $_POST["id"];
  	$user->username = $_POST["username"];
  	$user->password = $_POST["password"];
	$user->nama_lengkap = $_POST["nama_lengkap"];

	$getPass = $user->selectById($user->encode($_POST['id']));
	$pass = $getPass->fetch_object();  
	if(empty($_POST['old'])){
		if($user->update() == true){
			echo $user->successMessage("Data responden berhasil diubah!", "$base_url/?pg=profile");

		}
		else{
			echo $user->conn->error;
		}
	}
	else{


		if(md5($_POST['old']) == $pass->password){
			if($_POST['new'] == $_POST['password']){
				if($user->updateAll() == true){
					echo $user->successMessage("Data responden berhasil diubah!", "$base_url/?pg=profile");
				}
				else{
					echo $user->conn->error;
				}
			}
			else{
				echo $user->errorMessage("Password baru tidak sesuai!!!");
			}
		}
		else{
			echo $user->errorMessage("Password lama tidak sesuai!!!");
		}
	}
?>