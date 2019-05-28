<?php include('mail.php');?>
<html>

<head>
<title>Recuperare parola - CityZen</title>

<link rel="stylesheet" type="text/css" href="baranav+body.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="recuppass1.css">


</head>
<body>
<h1 id="header" onclick="window.location.href='index.php'"></h1>
<div class="navbar">
  <a href="index.php">Pagina principala</a>
  <div class="dropdown">
    <button class="dropbtn" onclick = "deznat.php">Evenimente
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="deznat.php">Dezastre naturale</a>
      <a href="blocaje.php">Blocaje</a>
      <a href="accidente.php">Accidente</a>
      <a href="actevandalism.php">Acte de vandalism</a>
	  <a href="apartiecersetori.php">Aparitia cersetoriei</a>
    </div>
  </div> 
  <div class="right">
  	<a href="login.php">Login</a>

  	</div>
</div>
<div class="user">
<form class="form"  method="POST" action="recuppass.php">
	<?php include('errors.php') ?>

		<center><?php if(!empty($success_message)) { ?>	
		<div class="success"><?php if(isset($success_message)) echo $success_message; ?></div>
		<?php } ?></center>
	<header class = "user__header">
		<h2 class="user__title"> <h1>Ati uitat parola?</h1>
				<p>Va rugam,introduceti adresa de e-mail mai jos. Veti primi un mail cu parola.</p></h3>
		<div class="form__group">
			<input type="email" placeholder="Email" class="form__input" name="email" required >
		</div>
		<input type="submit" value="Trimite" class="btn" name="trimite"/>
	</form>


</body>
</html>