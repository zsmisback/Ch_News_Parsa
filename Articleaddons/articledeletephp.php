<?php

session_start();



if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	header('location:../index.php');
}
else
{
	include '../config.php';
	
	
	
	if(isset($_POST['abtn']))
	{
		
		$art_tit = mysqli_real_escape_string($db,$_POST['artsel']);
		$vpcode = mysqli_real_escape_string($db,$_POST['vpcode']);
		
	 
	 


		
		if($art_tit == 'No')
		{
			echo "<span class='err'>Please select an article </span>";
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
			$sql = "DELETE FROM articles WHERE article_id = $art_tit";
			$db->query($sql);
			echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
		}
		
		
		
	}
	
}

?>