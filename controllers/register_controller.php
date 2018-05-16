<?php 

	include("controllers/db_controller.php");
	include("controllers/mail_controller.php");

?>

<?php 
	if(isset($_POST["submit"])){
		if(preg_match("/@/", $_POST["email"]) == false){
			$form_err = "Invalid E-Mail";
		}
		elseif($_POST["pass"] != $_POST["cpass"]){
			$form_err = "Invalid Credentials";
		}
		else{
			$token = openssl_random_pseudo_bytes(10);
			$token = bin2hex($token);
			$success = register($_POST["email"], $_POST["pass"], $token);
			if($success == "1"){
				$act_link = "http://localhost:8000/activate.php?id=".urlencode($_POST["email"])."&key=".urlencode($token)."";
				registermail($_POST["email"], $act_link);
			}
		}
	}
?>