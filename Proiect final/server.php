<?php
session_start();

// initializing variables
	$username = "";
	$nume ="";
	$prenume ="";
	$password_1 = "";
	$localitate ="";
	$cpassword ="";
	$email  = "";
	$errors = array(); 

// connect to the database
	$db = mysqli_connect('localhost', 'root', '22051998', 'twproiect');
	if(isset($_POST['reg_user'])){
		//receive all input values from the form
		$nume = mysqli_real_escape_string($db,$_POST['nume']);
		$prenume = mysqli_real_escape_string($db,$_POST['prenume']);
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$localitate = mysqli_real_escape_string($db,$_POST['localitate']);
		$password_1 = mysqli_real_escape_string($db,$_POST['password']);
		$cpassword = mysqli_real_escape_string($db,$_POST['cpassword']);
		
		// form validation: ensure that the form is correctly filled ...
		// by adding (array_push()) corresponding error unto $errors array
		if(empty($username)) { array_push($errors,"Trebuie sa introduceti numele de utilizator.");}
		if(empty($nume)) { array_push($errors,"Trebuie sa introduceti numele.");}
		if(empty($prenume)) { array_push($errors,"Trebuie sa introduceti prenumele.");}
		if(empty($email)) { array_push($errors,"Trebuie sa introduceti email-ul.");}
		if(empty($localitate)) { array_push($errors,"Trebuie sa introduceti localitatea.");}
		if(empty($password_1)) { array_push($errors,"Trebuie sa introduceti parola.");}
		if($password_1 != $cpassword ) { array_push($errors , "Cele doua parole nu coincid.");}
		
		if(strlen($password_1) < 6) {array_push($errors, "Parola trebuie sa aiba cel putin 6 caractere!");}
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){array_push($errors,"Introduceti un email valid!");}
		if(!preg_match("/^[a-zA-Z]+$/",$nume)){array_push($errors,"Numele trebuie sa contina doar litere");}
		if(!preg_match("/^[a-zA-Z ]+$/",$prenume)){array_push($errors,"Prenumele trebuie sa contina doar litere si spatii");}
		if(!preg_match("/^[a-zA-Z -]+$/",$localitate)){array_push($errors,"Localitatea  trebuie sa contina doar litere ,spatii sau cratima");}
		
		//first ceck the database to make sure
		//a user does not already exist with the same username
		$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query ($db , $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if($user){ //if user exists
			if($user['username'] === $username){
				array_push($errors, "Numele de utilizator exista");}
			if($user['email'] === $email){
				array_push($errors , "Email-ul a fost utilizat");}
			}
			
		//Finally , register user is there are no errors in the form
		if(!count($errors)){
			$password = base64_encode($password_1); //encrypt the password before saving in database
			$query="INSERT INTO users ( nume,prenume,username,email,localitate,parola)
					VALUES ('$nume','$prenume','$username','$email','$localitate','$password')";
			mysqli_query($db, $query);
			$q = "SELECT user_id FROM USERS WHERE username='$username'";
			$rw=mysqli_query($db,$q);
			$ras=mysqli_fetch_array($rw,MYSQLI_ASSOC);
			$idd=$ras['user_id'];
			$qq="INSERT INTO user_role (user_id,role_id) values ('$idd',2)";
			mysqli_query($db,$qq);
			$success_message = "<center>V-ati inregistrat cu succes! Acum va puteti loga.  
									<a href='login.php'>Login </a></center>";
			}
	}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = base64_encode($password);
  	$query = "SELECT * FROM users 
				join user_role on user_role.user_id=users.user_id
				join roles on roles.role_id=user_role.role_id
				WHERE username='$username' AND parola='$password'";
  	$results = mysqli_query($db, $query);
	$q="SELECT user_id FROM users where username='$username'";
	$res = mysqli_query($db,$q);

	$r = mysqli_fetch_array($res,MYSQLI_ASSOC);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "Te-ai logat!";
	  $id = $r['user_id'];
	  $que="UPDATE users 
			SET log_in='$id' 
			WHERE username='$username'";
	  mysqli_query($db,$que);
	  header('location:profile.php');
  	}else {
  		array_push($errors, "Username sau parola gresita.");
  	}
  }
	$_SESSION['succes']="V-ati logat cu succes";
	$id = $r['user_id'];
}		

//ADAUGA ANUNT	

	if(isset($_POST['add_anunt'])){
		$tipEveniment = mysqli_real_escape_string($db,$_POST['tip']);
		$titlu = mysqli_real_escape_string($db, $_POST['titlu']);
		$localitate = mysqli_real_escape_string($db, $_POST['localitate']);
		$data = mysqli_real_escape_string($db,$_POST['data']);
		$detalii = mysqli_real_escape_string($db, $_POST['detalii']);
	
   
	if (empty($tipEveniment)) {
		array_push($errors, "Trebuie sa alegeti tipul de eveniment!");
	}
	if (empty($titlu)) {
		array_push($errors, "Trebuie sa alegeti titlu anuntului!");
	}
	if (empty($localitate)) {
		array_push($errors, "Trebuie sa introduceti localitatea!");
	}
	if (empty($data)) {
		array_push($errors, "Trebuie sa introduceti data!");
	}
	if (empty($detalii)) {
		array_push($errors, "Trebuie sa introduceti detalii!");
	}
	$ind = NULL;
	if(isset($_SESSION['username'])){
		$ind = $_SESSION['username'];
	}

	$q="SELECT log_in from users where username='$ind'";
	$re=mysqli_query($db , $q);
	$r=mysqli_fetch_array($re,MYSQLI_ASSOC);
	$i=$r['log_in'];
	
	if(count($errors) == 0){
		$query="INSERT INTO perms ( tip,titlu,localitate,data_form,detalii,user_id)
				VALUES ('$tipEveniment','$titlu','$localitate','$data','$detalii','$i')";
		mysqli_query($db, $query);
		$_SESSION['success']="Ati adaugat anuntul cu succes!";
		$success_message="Ati adaugat anuntul cu succes!";
	}
}

//like
if(isset($_POST['like'])){
		$i =  $_POST['idhidd'];
		$sql = "UPDATE addtable SET likes = likes + 1 WHERE id = $i"; 
		mysqli_query($db,$sql);
		$page = $_SERVER['PHP_SELF'];
		echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
	}
