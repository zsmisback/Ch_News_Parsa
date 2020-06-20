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
		
		
		$vpcode = mysqli_real_escape_string($db,$_POST['vpcode']);
	    
		
		
		if(empty($vpcode))
		{
			echo "<span class='err'>Please fill in the vpcode</span>";
		}
		elseif($vpcode != 'letsgetrightintothenews')
		{
			echo "<span class='err'>Wrong vpcode </span>";
		}
		else
		{
			$sql = "SELECT * FROM articles WHERE article_id = $_GET[id]";
			$result = $db->query($sql);
			$row = $result->fetch_assoc();
			
			if($row['article_block'] == 0)
			{
				$sql = "UPDATE articles SET article_block = '1' WHERE article_id = $_GET[id]";
			    $result = $db->query($sql);
				echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
				
			}
			else
			{
				$sql = "UPDATE articles SET article_block = '0' WHERE article_id = $_GET[id]";
			    $result = $db->query($sql);
				echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
			}
			
			
			
		}
		
		
	}
	
}

?>