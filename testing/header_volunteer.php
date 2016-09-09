<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="A short description." />
 	<meta name="keywords" content="put, keywords, here" />
 	<title>Volunteer Forum</title>
	<link rel="stylesheet" href="style.css" type="text/css"> 
	<link rel="shortcut icon" type="image/ico" href = "/favicon.ico"/>

<style>

p{
  color: black; 
  font-family: "Courier";
  font-size: 40px;
  margin: -100px 0 0 0px;
  white-space: nowrap;
  overflow: hidden;
  width: 30em;
  animation: type 4s steps(60, end); 
}

p a{
  color: black;
  text-decoration: none;
}

a:hover{
	color: #8B8B8B;
}

span{
  animation: blink 1s infinite;
}

@keyframes type{ 
  from { width: 0; } 
} 

@keyframes type2{
  0%{width: 0;}
  50%{width: 0;}
  100%{ width: 100; } 
} 

@keyframes blink{
  to{opacity: .0;}
}

::selection{
  background: black;
}

</style>

<body>

<br><br>
<h1></h1>
	<div id="menu">

		<?php
		if(isset($_SESSION['signed_in']))  //Notice: Undefined index, 'user_level'
		{
			//echo '<p> Hello, <b>' . htmlentities($_SESSION['user_name']) . ' </p> </b>';
		}
		else
		{
			echo '<a class="item" href="signin-admin.php">Sign in</a> or <a class="item" href="signup.php">Sign up</a>';
		}
		?>
	<div id="content">