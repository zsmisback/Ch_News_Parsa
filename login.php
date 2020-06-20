<?php

include 'Loginaddons/loginphp.php';
	

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
  
  <style>
  .container{background-color:grey;}
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
<div class="container">
<br><br>
<form name="log" id="logpass" method="post">
<input type="text" class="form-control mb-4" name="user" id="username" placeholder="Enter your username">
<p id="error" class="text-center"></p>

<input type="password" class="form-control mb-4" name="passw" id="password" placeholder="Enter your password">
<span onclick="myFunction()" id="eye" class="far fa-eye passcheck"></span>
<input type="password" class="form-control mb-4" name="vpc" id="vpcode" placeholder="Enter the vpcode">
<span onclick="myFunction2()" id="eye" class="far fa-eye passcheck"></span>
<p id="error2"></p>
<button type="submit" id="loginuser" name="act" value="log" class="btn btn-success btn-block">Log in</button>
<br>

<a href="index.php" id="ext2"><button type="button" class="btn btn-danger btn-block">Cancel</button></a>
<br>
</form>

</div>

<script>
$(document).ready(function(){
	
	$('#logpass').submit(function(event){
		event.preventDefault();
		var user = $('#username').val();
		var password = $('#password').val();
		var vpcode = $('#vpcode').val();
		var loginuser = $('#loginuser').val();
		
		$.ajax({
		url:'Loginaddons/loginphp.php',
		method:'POST',
		data:{user: user,
			password: password,
			vpcode: vpcode,
			loginuser: loginuser},
			
		beforeSend:function(){
			
			$('input').prop('disabled',true);
			$('button').prop('disabled',true);
			
			$('#error2').html("<span class='spinner-border text-info'></span>");
			$('#loginuser').html("<span id='forpasspn' class='spinner-grow spinner-grow-sm'></span> Processing");
		},

        complete:function(){
			$('input').prop('disabled',false);
			$('button').prop('disabled',false);
			
			$('#loginuser').html("Submit");
			
		},		
			
		success:function(data){
			$('#error2').html(data);
		},
		
		error:function(){
			$('#error2').html('Failed to process data');
		}
		
		
	});
		
	});
	
	
	
});	

function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

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