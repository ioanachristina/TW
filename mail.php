	<?php 
		include("server.php");

	if(isset($_POST['trimite'])){
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$sql = "SELECT * FROM users WHERE email = '$email'";
		$res = mysqli_query($db, $sql);
		$count = mysqli_num_rows($res);
	
	$r = mysqli_fetch_assoc($res);
	$password = base64_decode($r['parola']);
	$to = $r['email'];
	$subject = "Your Recovered Password";
 
$message = "Please use this password to login " . $password;
$headers = "From : office@cityzen.ro";
	if(mail($to, $subject, $message, $headers)){
		$message = "Verificati mail-ul!";
			echo "<script type='text/javascript'>alert('$message');</script>";
	}else{
	$message = "Email-ul nu este corect!";
			echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
	?>