<?php
session_start();

$_SESSION = array();


session_destroy();

if(isset($_COOKIE['frname']))
{
	$frname = $_COOKIE['frname'];
 setcookie('frname',$frname,time() - 3600,"/");
}

header('location:index.php');
exit;
?>