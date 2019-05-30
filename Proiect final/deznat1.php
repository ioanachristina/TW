<?php include('server.php');?>
<html>

<head>
<title>CityZen</title>


<link rel="stylesheet" type="text/css" href="nav.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="in.css">

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
		$q="SELECT * FROM NOTIFICATION WHERE id_user=$idu order by isRead asc LIMIT 5";
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

<div id="Main">
	<p></p>
 <span style="font-weight:normal;">
                <font face="Roboto" size="4" onclick="showFiltering()">
                    <img src="filter-icon.svg" alt="Filter icon" width="20" height="20"> FILTREAZĂ</font></span></h2>

 <form id="filter-panel" method = "GET">
    <div class="FilterBox">
			<p><span style="float:center">Rating:
         <select name="rating">
			<option value=""></option>
                <option value="asc">Crescator</option>
                <option value="desc">Descrescator</option>
            </select>
        </span>
        <p><span style="float:center">Localitate:
		<select name="localitate">
		<option value=""></option>
		<?php
			$q = "Select DISTINCT localitate from addtable ";
			$r = mysqli_query($db,$q);
			while($row = mysqli_fetch_array($r,MYSQLI_ASSOC)){
				$loc = $row['localitate'];
				echo "<option value='$loc'>$loc</option>";
			}
		?>
		</select>
        </span>

        <!-- &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; -->

        <span style="float:right">Data:
            <select name="data">
			<option value=""></option>
                <option value="asc">Crescator</option>
                <option value="desc">Descrescator</option>
            </select>
        </span>
        </p>
		<span style="float:right"> <input type='submit' name='filter' value = "Filtreaza" /> </center></span>
    </div>
</form>

<p id="p1"></p>

<script>
var ok = 0;

function showFiltering() {

if(ok) {
    document.getElementById("filter-panel").style.display = "none";

    document.getElementById("p1").innerHTML = "";

    ok = 0;
}

else {
    document.getElementById("filter-panel").style.display = "block";
    document.getElementById("p1").innerHTML = "<br><br><br><br><br><br><br><br>";
    ok = 1;
    }
}
</script></h2>
  <?php
  $where = "";
  if(isset($_GET['filter'])){
		$rating = mysqli_real_escape_string($db,$_GET['rating']);
		$loc = mysqli_real_escape_string($db,$_GET['localitate']);
		$data = mysqli_real_escape_string($db,$_GET['data']);
		if($rating != "" && $loc != ""  && $data != ""){
			$sqlget = "select * from addtable 
					where tip='dezastre_naturale' and localitate = '$loc' order by likes $rating , data_adaugare $data ";
		}
		else if($rating != "" && $loc != "" &&$data == ""){
			$sqlget = "select * from addtable 
					where tip='dezastre_naturale' and localitate = '$loc' order by likes $rating ";
		}
		else if($rating != "" && $loc == "" &&$data != ""){
			$sqlget = "select * from addtable 
					where tip='dezastre_naturale' order by likes $rating , data_adaugare $data ";
		}
		else if($rating == "" && $loc != "" &&$data != ""){
			$sqlget ="select * from addtable 
					where tip='dezastre_naturale' and localitate = '$loc' order by data_adaugare $data ";
		}
		else if($rating != "" && $loc == "" &&$data == ""){
			$sqlget = "select * from addtable 
					where tip='dezastre_naturale' order by likes $rating ";
		}
		else if($rating == "" && $loc != "" &&$data == ""){
			$sqlget = "select * from addtable 
					where tip='dezastre_naturale' and localitate = '$loc' ";
		}
		else if($rating == "" && $loc == "" &&$data != ""){
			$sqlget = "select * from addtable 
					where tip='dezastre_naturale' order by data_adaugare $data";
		}
		
	$sqldata = mysqli_query($db, $sqlget) or die ('error getting infos');
	while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
		$ida = $row['id'];
		echo "<form method='POST' action='index1.php'>";
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
		$q = "SELECT count(*) as cnt from rating where id_anunt='$ida'";
		$r=mysqli_query($db,$q);
		$l=mysqli_fetch_array($r,MYSQLI_ASSOC);
		echo "<input type='submit' class='like' name='like' value='Like(".$l['cnt'].")' /> ";
		echo "</div>";
		echo "<input type='hidden' value='$ida' name='idhidd' />";
		echo "</form>";
	}
}
	else{
	$sqlget = "SELECT * FROM addtable where tip='dezastre_naturale'";
	$sqldata = mysqli_query($db, $sqlget) or die ('error getting infos');
	
	
	while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
		$ida = $row['id'];
		echo "<form method='POST' action='index1.php'>";
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
		$q = "SELECT count(*) as cnt from rating where id_anunt='$ida'";
		$r=mysqli_query($db,$q);
		$l=mysqli_fetch_array($r,MYSQLI_ASSOC);
		echo "<input type='submit' class='like' name='like' value='Like(".$l['cnt'].")' /> ";
		echo "</div>";
		echo "<input type='hidden' value='$ida' name='idhidd' />";
		echo "</form>";
	}
	}

?>	

</div>

</body>
</html>
