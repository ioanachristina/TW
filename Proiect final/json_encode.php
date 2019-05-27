<?php
$return_arr = array();
$fetch = mysqli_query("SELECT * FROM ADDTABLE");

while($row = mysqli_fetch_array($fetch,MYSQLI_ASSOC)){
	$row_array['tip']=$row['tip'];
	$row_array['titli']=$row['titlu'];
	$row_array['localitate']=$row['localitate'];
	$row_array['data']=$row['data_form'];
	$row_array['detalii']=$row['detalii'];
	$row_array['user_id']=$row['user_id'];
	
	array_push($return_arr , $row_array);
}
echo json_encode($return_arr);

?>