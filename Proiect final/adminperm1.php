<?php 
include('server.php');
?>
<html>
<head>
<title>CityZen</title>


<link rel="stylesheet" type="text/css" href="nav.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="adm.css">

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
<div class="data-collection">
<?php
	$query="SELECT * FROM users 
				JOIN USER_ROLE ON USER_ROLE.USER_ID=USERS.USER_ID
				JOIN ROLES ON ROLES.ROLE_ID=USER_ROLE.ROLE_ID
				ORDER BY USER_ROLE.USER_ID ASC";
	$result=mysqli_query($db,$query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$id= $row['user_id'];
		echo "<form class='Main' method='POST'>";
		echo "<div><span>Info</span><span></span></div>";
		echo "<div><span>Actual role </span>";
		echo "<span>".$row['role_name']."</span></div>";
		echo "<div><span>Username</span>";
		echo "<span>".$row['username']."</span></div>";
		echo "<div><span> User ID </span>";
		echo "<span>".$row['user_id']."</span></div>";
		echo "<div><span> Change role </span>";
		echo "</span><select name='rol' >";
		echo "<option value = '' selected = 'selected'></option>";
		echo "<option value = 'User'>User</option>";
		echo "<option value = 'SuperUser'>SuperUser </option>";
		echo "<option value = 'Admin' > Admin </option>";
		echo "</select></span></div>";
		echo "<button type='submit' class='but' name='aplica'> Apply </button>";
		echo "<button type='submit' class='but' name='sterge'> Sterge cont </button>";
		echo "<input type='hidden' name='idhidd' value='$id' />";
		echo "</form>";
	}
	
?>
</div>


<?php

	if(isset($_POST['aplica'])){
			$tipRol = mysqli_real_escape_string($db, $_POST['rol']);
			$user_id = mysqli_real_escape_string($db, $_POST['idhidd']);
			$s = " select role_id from roles where role_name='$tipRol'";
			$r = mysqli_query($db,$s);
			$rw= mysqli_fetch_array($r,MYSQLI_ASSOC);
			$rol=$rw['role_id'];

			$s1="update user_role 
				set role_id=$rol
					where user_id='$user_id'";
			mysqli_query($db,$s1);
			$page = $_SERVER['PHP_SELF'];
			echo '<meta http-equiv="Refresh" content="0;' . $page . '">';

	}
	if(isset($_POST['sterge'])){
		$user_id = mysqli_real_escape_string($db,$_POST['idhidd']);
		$query = "Delete from users where user_id=$user_id";
		mysqli_query($db,$query);
		$page = $_SERVER['PHP_SELF'];
		echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
	}
?>
</body>
</html>