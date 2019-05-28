<?php include('server.php');?>
<!DOCTYPE html>
<html>

<head>
<title>Acte de vandalism - CityZen</title>


<link rel="stylesheet" type="text/css" href="baranav+body.css">
<link rel="stylesheet" type="text/css" href="header1.css">
<link rel="stylesheet" type="text/css" href="index.css">

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
	  <a href="apartiecersetori.php">Aparitia cersetoriei</a>
    </div>
  </div> 
  <div class="right">
  	<a href="login.php">Login</a>

  	</div>
</div>

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
			$where = "and localitate = '$loc' order by likes $rating,data_form $data";
		}
		if($rating != "" && $loc != "" &&$data == ""){
			$where = "and localitate = '$loc' order by likes $rating";
		}
		if($rating != "" && $loc == "" &&$data != ""){
			$where = "order by likes $rating , data_form $data";
		}
		if($rating == "" && $loc != "" &&$data != ""){
			$where = "and localitate='$loc' order by data_form $data";
		}
		if($rating != "" && $loc == "" &&$data == ""){
			$where = " order by likes $rating";
		}
		if($rating == "" && $loc != "" &&$data == ""){
			$where = "and localitate='$loc'";
		}
		if($rating == "" && $loc == "" &&$data != ""){
			$where = "order by data_form $data";
		}
		$sqlget = "SELECT * FROM addtable where tip='acte_de_vandalism' $where";
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
		$q = "SELECT likes from addtable where id='$ida'";
		$r=mysqli_query($db,$q);
		$l=mysqli_fetch_array($r,MYSQLI_ASSOC);
		echo "</div>";
		echo "<input type='hidden' value='$ida' name='idhidd' />";
		echo "</form>";
	}
}
	else{
	$sqlget = "SELECT * FROM addtable where tip='acte_de_vandalism'";
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
		$q = "SELECT likes from addtable where id='$ida'";
		$r=mysqli_query($db,$q);
		$l=mysqli_fetch_array($r,MYSQLI_ASSOC);
		echo "</div>";
		echo "<input type='hidden' value='$ida' name='idhidd' />";
		echo "</form>";
	}
	}


?>	
</div>

</body>

</html>