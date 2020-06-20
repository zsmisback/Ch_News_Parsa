<?php

session_start();



include '../config.php';




if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	
	
}
else
{header('location:index.php');}


if(isset($_POST['loginuser'])) {
	
	
	$username = mysqli_real_escape_string($db,$_POST['user']);
	$password = mysqli_real_escape_string($db,$_POST['password']);
	$vpcode = mysqli_real_escape_string($db,$_POST['vpcode']);
	
	$queryCreateUsersTable = "CREATE TABLE IF NOT EXISTS `admins` (
    `admin_id` int(255) AUTO_INCREMENT,
    `admin_name` varchar(255) NOT NULL,
    `admin_password` varchar(255) NOT NULL,
     PRIMARY KEY  (`admin_id`))";
	 
	 

$ress = $db->multi_query($queryCreateUsersTable);

 $queryInsertUserData = "INSERT INTO admins VALUES('1','resheil','123456')";
 
 $ress2 = $db->multi_query($queryInsertUserData);

	$sq = "SELECT * FROM admins WHERE admin_name = '$username'";
   $res=$db->query($sq);

 
	  
	  
	if(empty($username)){
		echo "Please type in your registered username";
	} 
	elseif(empty($password)){
		echo "Please enter a password";
	}
	elseif(empty($vpcode)){
		echo "Plesae enter the vpcode";
	}
	elseif(mysqli_num_rows ($res) == 0){
	   
	   
		   echo "This username does not exist";
	   }
	elseif($vpcode != 'letsgetrightintothenews'){
	   echo "The vpcode that you've entered is wrong";
	   
	   }
	   else{
	  $sql = "SELECT admin_id,admin_name,admin_password FROM admins WHERE admin_name = ?";
	  
	  
	  if($stmt = $db->prepare($sql)){
		  
		  
		  
		  $stmt->bind_param('s',$username);
		  
		  
		  
		  if($stmt->execute()){
			  
			  $stmt->store_result();
			  
			  if($stmt->num_rows == 1){
				  $stmt->bind_result($ad_id,$ad_name,$ad_pass);
				  
				  if($stmt->fetch()){
					  
					  if($password == $ad_pass){
						  $_SESSION["loggedin"] = true;
		
						  $_SESSION["ad_id"]=$ad_id;
						  $_SESSION["ad_name"]=$ad_name;
						  $_SESSION["ad_pass"]=$ad_pass;
						
						  echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('index.php');});	</script>";
					  
				  }else{
					  
					  echo "This password does not exist/Wrong Password";
				  }
			  }
		  }
	  } else{
		  echo "Opps";
	  }
  }
  
      $stmt->close();
	 
	 
	 
 }
	   
        
	
    // check if e-mail address is well-formed
    
	
   
  
   
   
	  
	  
       
	  
	  
	  
  
  
   
   
   
  
  
 
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



?>