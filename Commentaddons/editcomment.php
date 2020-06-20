<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	header('location:../index.php');
}

include '../config.php';

$sql = "SELECT * FROM comments WHERE comment_id = $_GET[id]";
$result = $db->query($sql);
$row = $result->fetch_assoc();

?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <script src="ckeditor.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="jquery.backstretch.min.js"></script>
  <style>
.passcheck {
        float: right;
        margin-right: 6px;
        margin-top: -50px;
        position: relative;
        z-index: 2;
        
    }
	#eye:hover{cursor:pointer;}
</style>
</head>
<body>
<?php include '../navbar3.php'; ?>
<div class='container' id='category_back'>
<form name='comm' method='post' id='comments'>

<h3 id='user' class='text-center'>Edit a Comment</h3>

<textarea class='form-control' name='comment_desc' rows='4' cols='155' id='cdesc' placeholder='Summary'><?php echo $row['comment_summary']; ?></textarea>
<br>
<input type="password" class="form-control mb-4" name="vpc" id="vpcode" placeholder="Enter the vpcode"/>
<span onclick="myFunction2()" id="eye" class="far fa-eye passcheck"></span>
<p class='err' id='error'></p>
<button type="submit" id='cbtn' class="btn btn-dark btn-block btn-lg" name='newcom' >Submit</button>
</form>
<a href="../index.php" id='artcan'><button type="submit" class="btn btn-danger btn-block btn-lg">Cancel</button></a>
<br>

</div>
<script>
$(document).ready(function(){
	$('#comments').submit(function(event){
		event.preventDefault();
		
		var cdesc = $('#cdesc').val();
		var vpcode = $('#vpcode').val();
		var cbtn = $('#cbtn').val();
		$.ajax({
			url:'editcommentphp.php?id=<?php echo $_GET['id']; ?>',
			method:'POST',
			data:{
				  cdesc:cdesc,
				  vpcode:vpcode,
				  cbtn:cbtn},
				  
				  beforeSend:function(){
			
			$('input').prop('disabled',true);
			$('button').prop('disabled',true);
			
			$('#error').html("<span class='spinner-border text-info'></span>");
			$('#cbtn').html("<span id='forpasspn' class='spinner-grow spinner-grow-sm'></span> Processing");
		},

        complete:function(){
			$('input').prop('disabled',false);
			$('button').prop('disabled',false);
			
			$('#cbtn').html("Submit");
			
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

function myFunction2() {
  var x = document.getElementById("vpcode");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>