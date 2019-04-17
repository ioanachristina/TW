<?php include('server.php'); ?>
<html>


<head>
<title>CityZen</title>


<link rel="stylesheet" type="text/css" href="nav1.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="add1.css">

</head>
<body>
<h1 id="header" onclick="window.location.href='index1.php'"></h1>
<div class="navbar">
  <a href="index1.php">Pagina principala</a>
  <div class="dropdown">
    <button class="dropbtn" onclick = "#">Evenimente
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="deznat1.php">Dezastre naturale</a>
      <a href="blocaje1.php">Blocaje</a>
      <a href="accidente1.php">Accidente</a>
      <a href="actevandalism1.php">Acte de vandalism</a>
    </div>
  </div> 
  <a href="add.php">Adauga eveniment</a>

  <div class="right">
  	<!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p class="welcome">Welcome, <strong style="color:lightblue" ><?php echo $_SESSION['username']; ?></strong></p>
    	 
    <?php endif ?>
	<a href="logout.php" >LogOut</a>
	<a href="profile.php">Profil</a>
	

  	</div>
</div>
  	
		
<form action="add.php" method = "POST">

  <div class="container">
  <?php include('errors.php') ?>

		<center><?php if(!empty($success_message)) { ?>	
		<div class="success"><?php if(isset($success_message)) echo $success_message; ?></div>
		<?php } ?></center>
    <h2>Adauga anunt</h2>
  </div>
  <div class="container" style="background-color:white">
	<select name="tip" id="tip" >
        	<option value="">Alegeti categoria</option>
         	<option value="dezastre_naturale">Dezastre naturale</option>
          	<option value="blocaje">Blocaje</option>
          	<option value="accidente">Accidente</option>
         	<option value="acte_de_vandalism">Acte de vandalism</option>
     </select>
    <input type="text" placeholder="Titlu anunt" name="titlu" required>
    <input type="text" name="localitate" placeholder="Localitatea in care a avut loc" >
    <label>
      Data la care a avut loc : <input type="date" name="data" >
    </label>
	 <textarea id="detalii" name="detalii" placeholder="Detalii despre eveniment" style="height:150px"></textarea>
  

  <button type="submit" class="btn" name="add_anunt" value="Send" >Send </button>
  </div>
</form>


</body>
</html>

