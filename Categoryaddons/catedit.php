<?php
session_start();



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
  <script src="jquery.backstretch.min.js"></script>
  <style>

  </style>
</head>
<body>
<div class='container' id='category_back'>
<form name='cat' method='post' id='category'>
<h3 id='user' class='text-center'>Edit a Category</h3>


<div class='form-group'>
Select a title:<select class='form-control' id='titsel' name='titselect'>
                   
<?php 
while($row = mysqli_fetch_assoc($result))
{
echo "
      <option value=$row[cat_id]>$row[cat_name]</option>";
}
?>
</select>
</div>
<input type='text' id = 'cname' name = 'cat_name' class='form-control mb-4' placeholder = 'Enter the name of the category'>
<button type="submit" id='cbtn' class="btn btn-dark btn-block btn-lg" name='newcat' >Submit</button>
</form>

<br>
</div>
<script>
$(document).ready(function(){
	
	var name = localStorage.getItem('name');
	var desc = localStorage.getItem('desc');
	var img = localStorage.getItem('img');
	alert(name);
	$('#category').on('change','#titsel',function(){
		var id = ($('select option').filter(':selected').val());
		
		$.ajax({
			url:'cateditphp.php',
			method:'POST',
			data:{id:id},
			dataType:'JSON',
			success:function(data){
				console.log(data.name);
				
				
			}
		})
	});
	
	
});
</script>
</body>