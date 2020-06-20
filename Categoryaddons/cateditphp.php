<?php

session_start();



if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	header('location:../index.php');
}
else
{
	include '../config.php';
	
	if(isset($_POST['id']))
	{
		$sql = "SELECT * FROM category WHERE cat_id = $_POST[id]";
		$stmt = $db->result($sql);
		while($row = mysqli_fetch_assoc($stmt))
		{
			$data = $row['cat_name'];
		}
		echo json_encode($data);
	}
	
}

?>