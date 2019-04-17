<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
<title>CityZen</title>

<link rel="stylesheet" type="text/css" href="register1.css">
<link rel="stylesheet" type="text/css" href="baranav+body.css">
<link rel="stylesheet" type="text/css" href="header1.css">

</head>

<body>
<h1 id="header" onclick="window.location.href='index.php'"></h1>
<div class="navbar">
  <a href="index.php">Pagina principala</a>
  <div class="dropdown">
    <button class="dropbtn">Evenimente
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="deznat.php">Dezastre naturale</a>
      <a href="blocaje.php">Blocaje</a>
     <a href="accidente.php">Accidente</a>
      <a href="actevandalism.php">Acte de vandalism</a>
    </div>
  </div> 
  <div class="right">
  	<a href="login.php">Login</a>

  	</div>
</div>
<div class="user">
	<header class = "user_header">
		<h3 class="user_title"><h1>Inregistrare</h1>
				<p>Completati datele de mai jos pentru a va inregistra.</h1>
	</header>
	<?php include('errors.php') ?>
	<?php if(!empty($success_message)) { ?>	
		<div class="success"><?php if(isset($success_message)) echo $success_message; ?></div>
		<?php } ?>
<form class="form" method="POST" action="register.php">
	
	<div class ="form_group">
		<input type="text" placeholder="Nume" class="form_input" name="nume" />
	</div>
	
	<div class="form_group">
		<input type="text" placeholder="Prenume" class="form_input" name="prenume" />
	</div>
	
	<div class = "form_group">
		<input type ="text" placeholder="Nume de utilizator" class="form_input" name="username"/>
	</div>
	
	<div class="form_group">
		<input type="email" placeholder="Email" class="form_input" name="email" />
	</div>
		
	<div class="form_group">
		<input type="text" placeholder="Localitate" class ="form_input" name="localitate" />
	</div>
	
	<div class="form_group">
		<input type="password" placeholder="Parola" class="form_input" name="password" />
	</div>
	
	<div class="form_group">
		<input type="password" placeholder="Repeta parola" class="form_input" name="cpassword" />
	</div>
	
	<div class="form_group">
		<center><span class="form_input"> Prin inregistrare sunteti de acord cu <a href="#">Termenii&Conditiile</a></span></center>
	</div>
	<button type="submit" class="btn" name="reg_user" >Sign up</button>

</form>
		<p class="bottom"> Ai deja cont? <a href="login.php" > Login</a></p>
</div>
	

</body>

</html>