<?php

session_start();



if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	header('location:../index.php');
}
else
{
	include '../config.php';
	
	
	
	if(isset($_POST['cbtn']))
{
	$titsel = mysqli_real_escape_string($db,$_POST['titsel']);
	$vpcode = mysqli_real_escape_string($db,$_POST['vpcode']);
	
	$sql="SELECT * FROM articles LEFT JOIN category ON article_category = cat_id WHERE article_category = $titsel";
	 
	 $res = $db->query($sql);
	
	if($titsel == 'No')
	{
		
			   
			   
		echo "<span class='err'>There are no categories</span>";
	}
	elseif($res->num_rows > 0)
		{
			echo "<span class='err'>This category cannot be deleted unless and  until you delete all the articles in it </span>";
		}
	elseif(empty($vpcode))
	{
		echo "Plesae enter the vpcode";
	}
	elseif($vpcode != 'letsgetrightintothenews')
	{
		echo "<span class='err'>The vpcode is incorrect </span>";
	}	
	else
	{
		$sql = "DELETE FROM category WHERE cat_id = $titsel";
		$result = $db->query($sql);
		echo "<script type='text/javascript'>
		        
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
	}
	
 }

} 

	
?>