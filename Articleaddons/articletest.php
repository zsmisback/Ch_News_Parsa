<?php
session_start();



include '../config.php';



?>

<html>
<head>

</head>
<body>
<?php

$sql = "SELECT * from articles WHERE article_category = '2'";
$result = $db->query($sql);

while($row = mysqli_fetch_assoc($result))
{
	echo $row['article_content'];
}

?>
</body>
</html>