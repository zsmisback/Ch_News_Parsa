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
		
		$com_tit = mysqli_real_escape_string($db,$_POST['comsel']);
		$vpcode = mysqli_real_escape_string($db,$_POST['vpcode']);
		
	 
	 
        if($com_tit == 'No')
		{
			echo "<span class='err'>There are no articles </span>";
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
			$sql = "DELETE FROM comments WHERE comment_id = $com_tit";
			$db->query($sql);
			echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
		}
		
		
		
	}
	
}

?>