<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	header('location:../index.php');
}

include '../config.php';

$sql = "SELECT * from articles";
$result = $db->query($sql);

if($result->num_rows == 0)
{
	echo "<script type='text/javascript'>
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
}
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">
  <script src="ckeditor.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="jquery.backstretch.min.js"></script>
  <style>
  
  </style>
</head>
<body>
<div class='container' id='category_back'>
<form name='art' method='post' id='article'>

<h3 id='user' class='text-center'>Delete an Article</h3>


<div class='form-group'>
Select an article:<select class='form-control' id='artsel' name='artselect'>
                   
<?php 

if(empty($result))
{
	echo "<script type='text/javascript'>
		        alert('There are no categories');
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
			   
	echo "<option value='No'>No articles</option>";
}

while($row = mysqli_fetch_assoc($result))
{
echo "
      <option value=$row[article_id]>$row[article_name]</option>";
}
?>
</select>
</div>
<input type="text" class="form-control mb-4" name="vpc" id="vpcode" placeholder="Enter the vpcode"/>
<p class='err' id='error'></p>
<button type="submit" id='abtn' class="btn btn-dark btn-block btn-lg" name='newart' >Submit</button>
</form>
<br>
<a href="../index.php" id='artcan'><button type="submit" class="btn btn-danger btn-block btn-lg">Cancel</button></a>
<br>

</div>
<script>
$(document).ready(function(){
	$('#article').submit(function(event){
		event.preventDefault();
		var artsel = $('#artsel').val();
		var vpcode = $('#vpcode').val();
		var abtn = $('#abtn').val();
		
		$.ajax({
			url:'articledeletephp.php',
			method:'POST',
			data:{artsel:artsel,
			      vpcode:vpcode,
				  abtn:abtn},
				  
				  beforeSend:function(){
			
			$('input').prop('disabled',true);
			$('button').prop('disabled',true);
			
			$('#error').html("<span class='spinner-border text-info'></span>");
			$('#abtn').html("<span id='forpasspn' class='spinner-grow spinner-grow-sm'></span> Processing");
		},

        complete:function(){
			$('input').prop('disabled',false);
			$('button').prop('disabled',false);
			
			$('#abtn').html("Submit");
			
		},
		
		success:function(data){
				$('#error').html(data);
				
		},

        error:function(){
			$('#error').html('Failed to process data');
		}		
			
		})
		
		
		
	});
	
	
	
	
});
</script>
</body>
</html>