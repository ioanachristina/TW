<?php 
include('server.php');
?>
<html>
<head>
<title>CityZen</title>


<link rel="stylesheet" type="text/css" href="nav1.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="profil2.css">

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
	<a href="logout.php" name="log_out" >Log Out</a>
	<a href="profile.php" name="profile">Profil</a>
	

  	</div>
</div>
	<form class="ProfilePage">
		
<?php

	$sqlget = "SELECT * FROM users 
				JOIN USER_ROLE ON USER_ROLE.USER_ID=USERS.USER_ID
				JOIN ROLES ON ROLES.ROLE_ID=USER_ROLE.ROLE_ID
				WHERE username= '".$_SESSION['username']."'";
	$sqldata = mysqli_query($db, $sqlget) or die ('error getting infos');
	
	
	while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
		echo "<div class='LeftCol'>";
		if($row['role_name']=="Admin") {
			echo "<img src = 'avataradmin.png' id='avatar' />";
		}
		else if($row['role_name']=="SuperUser"){
				echo "<img src = 'avatarsuperuser.png' id='avatar' />";
		}
		else{
		echo "<img src = 'avataruser.png' id='avatar' />";
		}
		echo "<h3 class='num1'>";

		echo "</h3>";
		echo "</div>";
		echo "<div class='RightCol'>";
		echo "<p class='num'>Nume: "." ".$row['nume']."</p>";
		echo "<p class='num'>Prenume: "." ".$row['prenume']."</p>";
		echo "<p class='num'> Username : ";
		echo $row['username'];
		if($row['role_name']=="Admin") echo "<img src = 'star.png' id='star' />";
		echo "<i> ( "."<i style='color:red'>".$row['role_name']."</i> ) </i>";
		echo "</p>";
		echo "<p class='num'> Email : ";
		echo $row['email'];
		echo "</p>";
		echo "<p class='num'> Localitate : ";
		echo $row['localitate'];
		echo "</p>";
		if($row['role_name']=="Admin") {
			echo "<a href='adminperm.php'><input type='button' class='adminp' onclick='window.location.href="."'adminperm.php'"."'"." value='Anunturi adaugate'/></a>";
			echo "<a href='adminperm1.php'><input type='button' class='adminp' onclick='window.location.href="."'adminperm1.php'"."'"." value='Schimba roluri useri'/></a>";

		}
		if($row['role_name']=="SuperUser") {
			echo "<a href='adminperm.php'><input type='button' class='adminp' onclick='window.location.href="."'adminperm.php'"."'"." value='Anunturi adaugate'/></a>";
		}
		echo "</div>";
		
	}
?>	
	</form>	


</body>
</html>
