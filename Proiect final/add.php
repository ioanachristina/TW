<?php include('server.php'); ?>
<html>


<head>
<title>CityZen</title>


<link rel="stylesheet" type="text/css" href="naav.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="add.css">

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
		$q="SELECT * FROM NOTIFICATION WHERE id_user=$idu order by isRead asc LIMIT 5 ";
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
			<option value="aparitia_cersetoriei">Aparitia cersetoriei </option>
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

