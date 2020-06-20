<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Champion News:India's Best Source for Blogs,News and Interviews related to sports</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- slick slider -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  

  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
 <style>
 a{text-decoration:none;}
 </style>
</head>

<body>
  <!-- preloader -->
  <div class="preloader">
    <div class="loader">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- /preloader -->

<header class="navigation">
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.php?page=1"><img class="img-fluid" src="images/logo.png" alt="parsa"></a>
    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navogation"
      aria-controls="navogation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
  
   <div class='collapse navbar-collapse text-center' id='navogation'>
      <ul class='navbar-nav ml-auto'>
        <li class='nav-item dropdown'>
          <a class='nav-link text-uppercase text-dark' href='index.php?page=1'>
            Home
          </a>  
        </li>
		<?php
		 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
      {	  
        echo"
        <li class='nav-item'>
          <a class='nav-link text-uppercase text-dark' href='about.php'>About</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link text-uppercase text-dark' href='contact.php'>Contact</a>
        </li>
      </ul>";
	  }
	  else
	  {
		  echo"<li class='nav-item'>
<div class='dropdown'>
<a class='nav-link dropdown-toggle text-uppercase text-dark' data-toggle='dropdown' href='#'>Category</a>
<div class='dropdown-menu'>
      <a class='dropdown-item' href='Categoryaddons/catadd.php'>Add category</a>
      <a class='dropdown-item' href='Categoryaddons/categorylist.php'>List categories</a>
    </div>
</div>
</li>
 <li class='nav-item'>
 <div class='dropdown'>
  <a class='nav-link dropdown-toggle text-uppercase text-dark' data-toggle='dropdown' href='#'>Articles</a>
  <div class='dropdown-menu'>
      <a class='dropdown-item' href='Articleaddons/articleadd.php'>Add articles</a>
      <a class='dropdown-item' href='Articleaddons/articlelist.php'>List articles</a>
	  
      
    </div>
 </div>
 </li>
 <li class='nav-item'>
 <div class='dropdown'>
  <a class='nav-link dropdown-toggle text-uppercase text-dark' data-toggle='dropdown' href='#'>Comments</a>
  <div class='dropdown-menu'>
      <a class='dropdown-item' href='Commentaddons/commentadd.php'>Add comment</a>
      <a class='dropdown-item' href='Commentaddons/commentlist.php'>List comments</a>
    </div>
	</div>
 </li>
 <li class='nav-item'>
  <a class='nav-link text-uppercase text-dark' href='logout.php'>Logout</a>
 </li>";
	  }
	  ?>
      <form class='form-inline position-relative ml-lg-4'>
        <input class='form-control px-0 w-100' type='search' placeholder='Search'>
        <!-- <button class='search-icon' type='submit'><i class='ti-search text-dark'></i></button> -->
        <a href='search.html' class='search-icon'><i class='ti-search text-dark'></i></a>
      </form>
    </div>
  
	
  </nav>
</header>