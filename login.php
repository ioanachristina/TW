<?php 
	include('server.php')	
?>
<!DOCTYPE html>
<html>

</html>
<head>
<title>Login - CityZen</title>

<link rel="stylesheet" type="text/css" href="baranav+body.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="login.css">



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
	<header class = "user__header">
		<h1 class="user__title"> Login </h1><br>
	</header>
		<?php include('errors.php'); ?>

	<form class="form" method="POST" action="login.php">
		<div class="form__group">
			<input type = "text" placeholder="Nume de utilizator" name="username" class="form__input" />
		</div>
		
		<div class = "form__group">
			<input type="password" placeholder="Parola" name = "password" class="form__input" />
		</div>
		
		<button type="submit"  class="btn" name="login_user"> Login </button>
	</form>
		<p class="bottom"> Nu aveti cont ? <a href="register.php"> Creare cont </a> .</p>
		<p class="bottom"> Ati uitat parola ? <a href="recuppass.php"> Recuperare parola </a> .</p>

</div>

</body>

