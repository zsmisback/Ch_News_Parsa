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
		
		
	    $cdesc = mysqli_real_escape_string($db,$_POST['cdesc']);
		$vpcode = mysqli_real_escape_string($db,$_POST['vpcode']);
		
		
		if(empty($cdesc))
		{
			echo "<span class='err'>Please fill in the comment description </span>";
		}
		elseif(strlen($cdesc) > 500)
        {
			echo "<span class='err'>Please summarize in under 500 characters</span>";
			
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
			$sql = "UPDATE comments SET comment_summary = '$cdesc',comment_create = NOW() WHERE comment_id = $_GET[id]";
			$db->query($sql);
			echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
		}
		
		
	}
	
}

?>