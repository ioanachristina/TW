<?php 
include('server.php');
?>
<html>
<head>
<title>CityZen</title>


<link rel="stylesheet" type="text/css" href="nav.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="adm1.css">


</head>
<body>
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
<div>
<?php
	$sqlget = "SELECT * FROM perms ";
	$sqldata = mysqli_query($db, $sqlget) or die ('error getting infos');
	
	while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
		$ida = $row['id'];
		$idu = $row['user_id'];
		$s = "Select username from users where user_id='$idu'";
		$sqld =mysqli_query($db , $s);
		$r = mysqli_fetch_array($sqld ,MYSQLI_ASSOC);
		$idan=1;
		echo "<form method='POST'>";
    echo '<div class="EventBox">';
		echo "<h2>";
		echo $row['titlu'];
		echo "</h2>";
		echo "<p>Tipul evenimentului : ";
		echo $row['tip'];
		echo "</p>";
		echo "<p>Localitatea : ";
		echo $row['localitate'];
		echo "</p>";
		echo "<p>Data : ";
		echo $row['data_form'];
		echo "</p>";
		echo "<p>User : ";
		echo $r['username'];
		echo "</p>";
		echo "<p>Detalii : ";
		echo $row['detalii'];
    echo "</p>";
    echo "<div class='rightbtn'>";
    echo "<button type='submit' class='acc' name='posteaza'>Posteaza</button>";
    echo "</div>";
	echo "<div class='leftbtn'>";
	echo "<button type='submit' class='acc' name='respinge'>Sterge</button>";
	echo "</div>";
	echo "</div>";
	echo "<input type='hidden' value='$ida' name='idhidd' />";
	echo "</form>";
  }
  

  if(isset($_POST['posteaza'])){
	$i = $_POST['idhidd'];
    $query="SELECT * FROM perms where id='$i'";
    $rq=mysqli_query($db,$query);
    $row=mysqli_fetch_array($rq,MYSQLI_ASSOC);
	$id = $row ['id'];
    $tip=$row['tip'];
    $titlu=$row['titlu'];
    $localitate=$row['localitate'];
    $data=$row['data_form'];
    $detalii=$row['detalii'];
    $user=$row['user_id'];
	$msg = "Anuntul tau din categoria $tip a fost postat!";

	$q="INSERT INTO addtable (id, tip,titlu,localitate,data_form,detalii,user_id)
          VALUES ('$i','$tip','$titlu','$localitate','$data','$detalii','$user')";
	$q2 = "INSERT INTO notification (id_user,id_anunt,mesaj) values ($user,$i,'$msg')";
    mysqli_query($db,$q);
	mysqli_query($db,$q2);
    $q1="DELETE FROM perms where id='$id'";
    mysqli_query($db,$q1);
	header('LOCATION: adminperm.php');
  }
  if(isset($_POST['respinge'])){
	 $i = $_POST['idhidd'];
    $query="SELECT * FROM perms where id='$i'";
    $rq=mysqli_query($db,$query);
    $row=mysqli_fetch_array($rq,MYSQLI_ASSOC);
	$tip = $row['tip'];
	$user=$row['user_id'];
	$q="DELETE FROM perms where id='$i'";
	$msg = "Anuntul tau din categoria $tip a fost sters!";
	$q1 = "INSERT INTO notification (id_user,id_anunt,mesaj) values ($user,$i,'$msg')";
	mysqli_query($db,$q1);
	mysqli_query($db,$q);
	header('location: adminperm.php');
  }
?>	
</div>
</body>
</html>