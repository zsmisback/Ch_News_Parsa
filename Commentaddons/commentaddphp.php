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
	    $art_tit = mysqli_real_escape_string($db,$_POST['artsel']);
		$vpcode = mysqli_real_escape_string($db,$_POST['vpcode']);
		
		$queryCreateUsersTable = "CREATE TABLE IF NOT EXISTS `comments` (
    `comment_id` int(255) AUTO_INCREMENT,
    `comment_summary` varchar(255) NOT NULL,
	`comment_article` int(255) NOT NULL,
	`comment_create` datetime NOT NULL,
	`comment_by` varchar(255) NOT NULL,
     PRIMARY KEY  (`comment_id`))";
	 
	 

    $ress = $db->multi_query($queryCreateUsersTable);
		
		if(empty($cdesc))
		{
			echo "<span class='err'>Please fill in the comment description </span>";
		}
		elseif(strlen($cdesc) > 500)
        {
			echo "<span class='err'>Please summarize in under 500 characters</span>";
			
	    }
		elseif(empty($art_tit) || $art_tit == 'No')
		{
			echo "<span class='err'>No articles </span>";
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
			$sql = "INSERT INTO comments(comment_summary,comment_article,comment_create) VALUES('$cdesc','$art_tit',NOW())";
			$db->query($sql);
			echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
		}
		
		
	}
	
}

?>