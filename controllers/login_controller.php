<?php 
	if(isset($_POST["submit"])){
		if(preg_match("/@/", $_POST["email"]) == false){
			$form_err = "Invalid E-Mail";
		}
		else{
			include("controllers/db_controller.php");
			$success = fetch($_POST["email"]);
			if($success == $_POST["pass"]){
				session_start();
				$_SESSION['email'] = $_POST["email"];      
				//redirect to somepage
				echo "SUCCESFUL LOGIN";
			}
			else{
				$user_err = "1"; 
			}
		}
	}
?>