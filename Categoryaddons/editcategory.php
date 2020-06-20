<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	header('location:../index.php');
}

include '../config.php';

$sql = "SELECT * FROM category WHERE cat_id = $_GET[id]";
$result = $db->query($sql);
$row = $result->fetch_assoc();

?>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
<form name='cat' method='post' id='category' enctype="multipart/form-data">
<h3 id='user' class='text-center'>Edit a Category</h3>

<input type='text' id = 'cname' name = 'cat_name' class='form-control mb-4' placeholder = 'Enter the name of the category' value='<?php echo $row['cat_name']; ?>'>

<textarea class='form-control' placeholder = 'Add the summary' name='cat_desc' rows='20' cols='155' id='cdesc'><?php echo $row['cat_desc']; ?></textarea>
<br>
<input type="password" class="form-control mb-4" name="vpc" id="vpcode" placeholder="Enter the vpcode"/>
<span onclick="myFunction2()" id="eye" class="far fa-eye passcheck"></span>
<input type='file' name='file' id='file'/>
<br><br>
Current Image:
<img src="../Profilepics/Category/<?php echo $row['cat_unique_key']; ?>/<?php echo $row['cat_img']; ?>" style="width:200px">
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
		var cname = $('#cname').val();
		var cdesc = $('#cdesc').val();
		var vpcode = $('#vpcode').val();
		var cbtn = $('#cbtn').val();
		var property = document.getElementById('file').files[0];
	    var form_data = new FormData();
		form_data.append("cat_name",cname);
		form_data.append("cat_desc",cdesc);
		form_data.append("vpc",vpcode);
		form_data.append("newcat",cbtn);
		form_data.append("file",property);
		
		$.ajax({
			
			url:'editcategoryphp.php?id=<?php echo $_GET['id']; ?>',
			method:'POST',
			data:form_data,
			contentType:false,
			cache:false,
			processData:false,	
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
			
		})
		
		
	});
	
	$('#category').on('change','#file', function(){
	
	var property = document.getElementById('file').files[0];
	var image_name = property.name;
	var image_extension = image_name.split('.').pop().toLowerCase();
	var image_size = property.size;
	
	if(jQuery.inArray(image_extension,['gif','png','jpg','jpeg']) == -1)
	{
		document.getElementById('caterr').innerHTML = 'Sorry,only GIFs,PNGs,JPGs and Jpeg files are allowed';
		
	}
	else{
	if(image_size > 5000000)
	{
		document.getElementById('caterr').innerHTML = 'Sorry, your file is too large.';
		
	}
	else{
		document.getElementById('caterr').innerHTML = '';
		
		
		
		
	}
	}
	
	
	
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