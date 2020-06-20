<?php

session_start();




	include '../config.php';
	
	
	
	if(isset($_POST['cbtn']))
	{
		
		$cdesc = mysqli_real_escape_string($db,$_POST['cdesc']);
		if(!isset($_SESSION['ad_name']))
		{
			
		}
		else
		{
		$user = $_SESSION['ad_name'];
		}
	 
	 if(empty($cdesc))
		{
			echo "<span class='err'>Please enter your comment </span>";
		}
		elseif(strlen($cdesc) > 150)
        {
			echo "<span class='err'>Please summarize in under 150 characters</span>";
			
	    }
		else
		{  
	
	          if(!isset($user))
            {
	          $sql = "INSERT INTO comments(comment_summary,comment_article,comment_create) VALUES ('$cdesc','$_GET[id]',NOW())";
			$db->query($sql);
			echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('content.php?id=$_GET[id]');});	</script>";
            }
			else
			{
			$sql = "INSERT INTO comments(comment_summary,comment_article,comment_create,comment_by) VALUES ('$cdesc','$_GET[id]',NOW(),'$user')";
			$db->query($sql);
			echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('content.php?id=$_GET[id]');});	</script>";
	        }	
		}
		
		
		
	}
	


?>