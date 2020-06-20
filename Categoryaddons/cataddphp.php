<?php

session_start();



if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	header('location:../index.php');
}
else
{
	include '../config.php';
	
	if(isset($_POST['newcat']))
{
	$cat_name = mysqli_real_escape_string($db,$_POST['cat_name']);
	$cat_desc = mysqli_real_escape_string($db,$_POST['cat_desc']);
	$vpcode = mysqli_real_escape_string($db,$_POST['vpc']);
	
	/*$queryCreateUsersTable = "CREATE TABLE IF NOT EXISTS `category` (
    `cat_id` int(255) AUTO_INCREMENT,
    `cat_name` varchar(255) NOT NULL,
    `cat_desc` varchar(255) NOT NULL,
	`cat_img` varchar(255) NOT NULL,
	`cat_unique_key` varchar(10) NOT NULL,
	`cat_create` DATETIME NOT NULL,
     PRIMARY KEY  (`cat_id`))";
	 
	 

    $ress = $db->multi_query($queryCreateUsersTable);
	*/
	$sql = "SELECT * FROM category WHERE cat_name = '$cat_name'";
	$result = $db->query($sql);
	
	
	if(empty($cat_name))
	{
		echo "<span class='err'>Please fill in the category name </span>";
	}
	elseif(empty($cat_desc))
	{
		echo "<span class='err'>Please fill in the description field</span>";
	}
	elseif(strlen($cat_desc) > 500)
    {
			echo "<span class='err'>Please summarize in under 500 characters</span>";
			
	}
	elseif(mysqli_num_rows($result) > 0)
	{
		echo "<span class='err'>This category already exist</span>";
	}
	elseif(!isset($_FILES['file']['name']))
	{
		echo "<span class='err'>Please select an image</span>";
	}
	elseif(empty($vpcode))
	{
		echo "Plesae enter the vpcode";
	}
	elseif($vpcode != 'letsgetrightintothenews')
	{
		echo "<span class='err'>The vpcode is incorrect </span>";
	}
	else{
		    $token = 'sadkjeawhijwajdilhasilfjaehioryweapirjpway9uprpjrpewahjrej23136513123q08192383431';
			$token = str_shuffle($token);
		    $token= substr($token,0,10);
			$filecreate = mkdir("../Profilepics/Category/$token");
			$target_dir = "../Profilepics/Category/$token/";
            $uploadOk = 1;
            $base = mysqli_real_escape_string($db,basename($_FILES['file']['name']));
			$clean = clean($base);
			$imageFileType = strtolower(pathinfo($clean,PATHINFO_EXTENSION));
            $target_file = $target_dir . "Profile".".$imageFileType";
            $target_name = "Profile".".$imageFileType";
			$file = $_FILES['file']['name'];
            $check = getimagesize($_FILES["file"]["tmp_name"]);
  
  
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
  echo "<span class='err'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</span>";
  $uploadOk = 0;
}
elseif ($_FILES["file"]["size"] > 5000000) {
  echo "<span class='err'>Sorry, your file is too large.</span>";
  $uploadOk = 0;
} 
 elseif($check == false) {
    echo "<span class='err'>File is not an image.</span>";
    $uploadOk = 0;
  }
  else
  {
	            echo "<span class='err'></span>";
	            move_uploaded_file($_FILES['file']['tmp_name'],$target_file);
				$sql = "INSERT INTO category(cat_name,cat_desc,cat_img,cat_unique_key,cat_create) VALUES('$cat_name','$cat_desc','$target_name','$token',NOW())";
				$results = $db->query($sql);
				echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
				
				
  }
  
  
 
	}
	
 }
 

	
}

 function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-.]/', '', $string); // Removes special chars.
}

?>