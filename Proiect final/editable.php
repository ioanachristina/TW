<?php 
include('server.php');
?>
<html>
<head>
<title>CityZen</title>


<link rel="stylesheet" type="text/css" href="nav.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="profile1.css">

</head>

<body>
<h1 id="header" onclick="window.location.href='index1.php'"></h1>
<form class="navbar" method='POST'>
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
	  <a href="apartiecersetori1.php">Aparitia cersetoriei</a>
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
<div class="dropdown">
<?php
$user = $_SESSION['username'];
		$q1="select user_id from users where username='$user'";
		$r= mysqli_query($db,$q1);
		$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
		$idu=$row['user_id'];
		$q2 = " SELECT count(*) as 'count' FROM notification WHERE id_user=$idu and isRead=0";
		$r1 = mysqli_query($db,$q2);
		$row1 = mysqli_fetch_assoc($r1);

?>
		<input type= "submit" class="dropbtn"  name="notif" value="Notificari (<?php echo $row1['count'];?>)"/>
			<i class = "fa fa-caret-down"></i>
		<div class="dropdown-content">
		<?php
		$q="SELECT * FROM NOTIFICATION WHERE id_user=$idu order by isRead asc  LIMIT 5";
		$r = mysqli_query($db,$q);
		if(isset($_POST['notif'])){
			$user = $_SESSION['username'];
			$q1="select user_id from users where username='$user'";
			$r= mysqli_query($db,$q1);
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$idu=$row['user_id'];
			$q12 = "UPDATE notification set isRead=1 where id_user='$idu'";
			mysqli_query($db,$q12);
			$page = $_SERVER['PHP_SELF'];
		echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
		}
		while($row=mysqli_fetch_array($r,MYSQLI_ASSOC)){
			if($row['isRead']==0){
			echo "<p><b>".$row['mesaj']."</b></p>";
			echo "<hr>";
			}
			else {
				echo "<p>".$row['mesaj']."</p>";
				echo "<hr>";
			}
		}
		
		?></div>
	</div>
</div>
</form>
	<form class="ProfilePage" method="POST">
		
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
		echo "<p class='num'>Nume: <input type='text' name='nume' /></p>";
		echo "<p class='num'>Prenume:  <input type='text' name='prenume' /></p>";
		echo "<p class='num'> Username : ";
		echo $row['username'];
		if($row['role_name']=="Admin") echo "<img src = 'star.png' id='star' />";
		echo "<i> ( "."<i style='color:red'>".$row['role_name']."</i> ) </i>";
		echo "</p>";
		echo "<p class='num'> Email :  <input type='email' name='email' /> </p>";
		echo "<p class='num'> Localitate :  <input type='text' name='loc' /></p>";

		echo "<input type='submit' name='save' class = 'adminp' value='Save' />";
		echo "</form>";
		
	}
	
	if(isset($_POST['save'])){
		$nume = $_POST['nume'];
		$prenume = $_POST['prenume'];
		$email = $_POST['email'];
		$localitate = $_POST['loc'];
		if($nume != ""){
			$q="UPDATE USERS set nume='$nume' where username='".$_SESSION['username']."'";
			mysqli_query($db,$q);
		}
		if($prenume != ""){
			$q="UPDATE USERS set prenume='$prenume' where username='".$_SESSION['username']."'";
			mysqli_query($db,$q);
		}
		if($email != "") {
			$q1="UPDATE USERS set EMAIL='$email' where username='".$_SESSION['username']."'";
			mysqli_query($db,$q1);
		}
		if($localitate != ""){
			$q2="UPDATE USERS set LOCALITATE='$localitate' where username='".$_SESSION['username']."'";
			mysqli_query($db,$q2);
		}
		header('location:profile.php');
	}	
?>	
	</form>	


</body>
</html>
