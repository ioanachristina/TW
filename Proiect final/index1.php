<?php 
  include('server.php');

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

?>
<!DOCTYPE html>
<html>

</html>
<head>
<title>CityZen</title>

<link rel="stylesheet" type="text/css" href="nav1.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="ind1.css">

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
	  <a href="apartiecersetori1.php">Aparitia cersetoriei</a>
    </div>
  </div> 
  <a href="add.php">Adauga eveniment</a>

  <div class="right">
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p class="welcome">Welcome, <strong style="color:lightblue" ><?php echo $_SESSION['username']; ?></strong></p>
    	 
    <?php endif ?>
	<a href="logout.php" name="log_out" >LogOut</a>
	<a href="profile.php">Profil</a>
	
	
  	</div>
</div>

 <h2 class="newTitle">Cele mai recente evenimente</h2>

<?php
	$sqlget = "SELECT * FROM addtable order by data_form desc";
	$sqldata = mysqli_query($db, $sqlget) or die ('error getting infos');
	
	
	
	while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
		$ida = $row['id'];
		echo "<form method='POST'>";
		echo "<div class='EventBox'>";
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
		echo "<p>Detalii : ";
		echo $row['detalii'];
		echo "</p>";
		$q = "SELECT likes from addtable where id='$ida'";
		$r=mysqli_query($db,$q);
		$l=mysqli_fetch_array($r,MYSQLI_ASSOC);
		echo "<input type='submit' class='like' name='like' value='Like(".$l['likes'].")' /> ";
		echo "</div>";
		echo "<input type='hidden' value='$ida' name='idhidd' />";
		echo "</form>";
	}
?>	
<?php 
if(isset($_POST['like'])){
		$i =  $_POST['idhidd'];
		$sql = "UPDATE addtable SET likes = likes + 1 WHERE id = $i"; 
		mysqli_query($db,$sql);
		$page = $_SERVER['PHP_SELF'];
		echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
	}
?>
<form method="POST">
<center><button type="submit" class="btn" name="jsond">Download as JSON</button> </center>
</form>
<?php
if(isset($_POST['jsond'])){
	$query = "SELECT * FROM ADDTABLE";
		$result = mysqli_query($db,$query);
		$response = array();
		$posts = array();
		
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$tipEveniment = $row['tip'];
			$titlu = $row['titlu'];
			$localitate = $row['localitate'];
			$data = $row['data_form'];
			$detalii = $row['detalii'];
			$user_id = $row['user_id'];
			$likes = $row['likes'];
			
			$posts[]=array('tip'=>$tipEveniment,'titlu'=>$titlu,'localitate'=>$localitate,'data'=>$data,'detalii'=>$detalii,'user_id'=>$user_id ,'likes' => $likes);
		}
		$response['posts'] = $posts;
		
		if (file_exists('resumate.json')) {
			$fh = fopen('resumate.json', 'a');
			fwrite($fh, json_encode($response,JSON_PRETTY_PRINT));
		} else {
			$fh = fopen('resumate.json', 'w');
			fwrite($fh, json_encode($response,JSON_PRETTY_PRINT));
		}
		fclose($fh);
		$page = $_SERVER['PHP_SELF'];
		echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
		
}
?>

</body>
</html>
