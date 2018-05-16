 <?php

 	function createConn(){
 		$servername = "localhost";
		$username = "<user_name>";
		$password = "<password>";
		$dbname = "<db_name>";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
 	}

?>

<?php 

	function register($email, $pass, $token){
		$conn = createConn();
		$sql = "INSERT INTO users VALUES('".$email."', '".$pass."', '".$token."');";
		if ($conn->query($sql) === TRUE) {
    		$success = "1";
		} else {
    		$success = "2";
		}
		return $success;
	}

	function fetch($email){
		$conn = createConn();
		$sql = "SELECT * FROM users WHERE email = '".$email."' AND token = '0';";
		$result = $conn -> query($sql);
		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
        		$success = $row["pass"];
        		return $success;
    		}
		} else {
    		$success = "-1";
    		return $success;
		}
	}

	function activate($email){
		$conn = createConn();
		$sql = "UPDATE users SET token = '0' WHERE email = '".$email."';";
		if ($conn->query($sql) === TRUE) {
    		$success = "1";
		} else {
    		$success = "2";
		}
		return $success;
	}

	function resetpass($email, $pass){
		$conn = createConn();
		$sql = "UPDATE users SET pass = '".$pass."', token = '0' WHERE email = '".$email."';";
		if ($conn->query($sql) === TRUE) {
    		$success = "1";
		} else {
    		$success = "2";
		}
		return $success;
	}

	function fetchtoken($email){
		$conn = createConn();
		$sql = "SELECT token FROM users WHERE email = '".$email."';";
		$result = $conn -> query($sql);
		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
        		$success = $row["token"];
        		return $success;
    		}
		} else {
    		$success = "-1";
    		return $success;
		}
	}

	function forgotpass($email, $token){
		$conn = createConn();
		$sql = "UPDATE users SET token = '".$token."' WHERE email = '".$email."';";
		if ($conn->query($sql) === TRUE) {
    		$success = "1";
		} else {
    		$success = "2";
		}
		return $success;
	}

?> 