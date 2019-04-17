<?php include('server.php');?>
<html>

<head>
<title>Blocaje - CityZen</title>


<link rel="stylesheet" type="text/css" href="nav1.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="indeex1.css">


</head>
<body>
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
	<a href="logout.php'" >LogOut</a>
	<a href="profile.php" name="profile">Profil</a>
  	</div>
</div>

<div id = "Main">
   <?php
	$sqlget = "SELECT * FROM addtable where tip='blocaje'";
	$sqldata = mysqli_query($db, $sqlget) or die ('error getting infos');
	
	
	
	while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
		echo '<div class="EventBox">';
		echo "<h2>";
		echo $row['titlu'];
		echo "</h2>";
		echo "<p>Tipul evenimentului: ";
		echo $row['tip'];
		echo "</p>";
		echo "<p>Localitatea: ";
		echo $row['localitate'];
		echo "</p>";
		echo "<p>Data :";
		echo $row['data_form'];
		echo "</p>";
		echo "<p>Detalii : ";
		echo $row['detalii'];
		echo "</p>";
		echo "</div>";
	}
?>	
</div>

</body>
</html>
