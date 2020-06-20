<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
	header('location:../index.php');
}

include '../config.php';

?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"/>
 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<style>
h1{text-align:center;}
	a{color:black;}
	a:hover{text-decoration:none;}
	
	.overflow{
  white-space: nowrap; 
   
  overflow: hidden;
  text-overflow: ellipsis; 
  
}

.results tr[visible='false'],.no-result{
	display:none;
}

.results tr[visible='true']{
	display:table-row;
}
.counter{
	padding:8px;
	color: #black;
}
</style>
</head>
<body>
<?php include '../navbar3.php'; ?>
<div class='container-fluid'>
<h1>Comment List</h1>


<table class="table table-bordered results">
<thead>
      <tr>
        <th>Comment</th>
        <th>Comment By</th>
        <th>Under Article</th>
		<th>Edit</th>
		<th>Delete</th>
      </tr>
    </thead>
<tbody>

<?php


$sql = "SELECT * FROM comments LEFT JOIN articles ON comment_article = article_id";
$result = $db->query($sql);
while($row = $result->fetch_assoc())
{
 echo"	
 <tr>
<td>$row[comment_summary]</td>
 <td>$row[comment_by]</td>
  <td>$row[article_name]</td>
  <td><a href='editcomment.php?id=$row[comment_id]'><button class='btn btn-warning' type='submit'>Edit</button></a></td>
  <td><a href='deletecomment.php?id=$row[comment_id]'><button class='btn btn-danger' type='submit'>Delete</button></a></td>
  </tr>
  ";
}

?>
  
</tbody>	
</table>
 </div>
</body> 

<script>
$(document).ready(function(){
	$('table').DataTable();
});
</script>
</body>
</html>