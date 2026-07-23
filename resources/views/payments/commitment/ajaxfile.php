<?php
include 'config.php';

$request = 1;
if(isset($_POST['request'])){
	$request = $_POST['request'];
}

// Select2 data
if($request == 1){
	if(!isset($_POST['searchTerm'])){
		$fetchData = mysqli_query($con,"select * from bank_details order by Name limit 5");
	}else{
		$search = $_POST['searchTerm'];
		$fetchData = mysqli_query($con,"select * from bank_details where Name like '%".$search."%' limit 5");
	}
		
	$data = array();

	while ($row = mysqli_fetch_array($fetchData)) {
	    $data[] = array("id"=>$row['id'], "text"=>$row['Name']);
	}

	echo json_encode($data);
	exit;
}

// Add element
if($request == 2){

	$html = "<br><select class='select2_el' style='width: 200px;' ><option value='0'>- Search user -</option></select><br>";
	echo $html;
	exit;

}
