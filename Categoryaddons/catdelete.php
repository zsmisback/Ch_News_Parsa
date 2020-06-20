<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	header('location:../index.php');
}

include '../config.php';

$sql = "SELECT * from category";
$result = $db->query($sql);

?>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class='container' id='category_back'>
<form name='cat' method='post' id='category'>
<h3 id='user' class='text-center'>Delete a Category</h3>
<div class='form-group'>
Select the category:<select class='form-control' id='titsel' name='titselect'>
                   
<?php 

if(empty($result))
{
	echo "<script type='text/javascript'>
		        alert('There are no categories');
			   setTimeout(function(){window.location.assign('../index.php');});	</script>";
			   
	echo "<option value='No'>No categories</option>";
}

while($row = mysqli_fetch_assoc($result))
{
echo "
      <option value=$row[cat_id]>$row[cat_name]</option>";
}
?>
</select>
</div>
<input type="text" class="form-control mb-4" name="vpc" id="vpcode" placeholder="Enter the vpcode">
<p id='caterr' name='caerr'></p>
<button type="submit" id='cbtn' class="btn btn-dark btn-block btn-lg" name='newcat' >Submit</button>
</form>
<a href="../index.php"><button type="submit" class="btn btn-danger btn-block btn-lg">Cancel</button></a>
<br>
</div>
<script>
$(document).ready(function(){
	
	
	$('#category').submit(function(event){
		event.preventDefault();
		var titsel = $('#titsel').val();
		var cbtn = $('#cbtn').val();
		var vpcode = $('#vpcode').val();
		
		$.ajax({
		url:'catdeletephp.php',
		method:'POST',
		data:{titsel:titsel,
		      vpcode:vpcode,
		      cbtn:cbtn},	
		beforeSend:function(){
			
			$('input').prop('disabled',true);
			$('button').prop('disabled',true);
			
			$('#caterr').html("<span class='spinner-border text-info'></span>");
			$('#cbtn').html("<span id='forpasspn' class='spinner-grow spinner-grow-sm'></span> Processing");
		},

        complete:function(){
			$('input').prop('disabled',false);
			$('button').prop('disabled',false);
		    
			$('#cbtn').html("Submit");
			
		},		
			
		success:function(data){
			$('#caterr').html(data);
		},
		
		error:function(){
			$('#caterr').html('Failed to process data');
		}
		
		
	});
		
	});
	
});	
</script>
</body>
</html>