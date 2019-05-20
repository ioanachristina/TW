	<?php 
		include("server.php");

	if(isset($_POST['trimite'])){
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$sql = "SELECT * FROM users WHERE email = '$email'";
		$res = mysqli_query($db, $sql);
		$count = mysqli_num_rows($res);
		if($count == 1){
			echo "Send email to user with password";
		}else{
			echo "User name does not exist in database";
		}
	}
	$r = mysqli_fetch_assoc($res);
	$password = base64_decode($r['parola']);
	$to = $r['email'];
	$subject = "Your Recovered Password";
 
$message = "Please use this password to login " . $password;
$headers = "From : office@cityzen.ro";
	if(mail($to, $subject, $message, $headers)){
	echo "<p id='succes'>Verificati mail-ul</p>";
	}else{
	echo "<p id='fail'> Email-ul nu exista</p>";
	}
	?>