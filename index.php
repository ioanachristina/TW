<?php include('server.php'); ?>
<html>

<head>
<title>CityZen</title>


<link rel="stylesheet" type="text/css" href="baranav+body.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="indeex1.css">

</head>

<body>
<h1 id="header" onclick="window.location.href='index.php'"></h1>
<div class="navbar">
  <a href="index.php">Pagina principala</a>
  <div class="dropdown">
    <button class="dropbtn" onclick = "#">Evenimente
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

<div id="Main">

 <h2 class="newTitle">Cele mai recente evenimente</h2>

  <?php
	$sqlget = "SELECT * FROM addtable order by data_form desc";
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

</div>

</body>

</html>
