<?php
include('server.php');
	$ind = NULL;
	if(isset($_SESSION['username'])){
		$ind = $_SESSION['username'];
	}

	$que="UPDATE users 
			SET log_in=NULL
			WHERE username='$ind'";
	  mysqli_query($db,$que);
	  session_destroy();

	header('location:login.php');

?>