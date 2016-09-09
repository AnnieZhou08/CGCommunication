<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="A short description." />
 	<meta name="keywords" content="put, keywords, here" />
 	<title>Signed Out</title>
	<link rel="stylesheet" href="style.css" type="text/css"> 

<style>

p{
  color: black; 
  font-family: "Courier";
  font-size: 40px;
  margin: 50px 0 0 50px;
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

#signin{
	margin-top: 20%;
	font-family: calibri;
	text-align: center;
	
}
</style>



<html>
<body>

<p>Signed Out<span>|</span></p>

<div id="wrapper">
	<div id="menu">
		
		<?php
			echo '<a class="item" href="signin.php">Sign in</a> or <a class="item" href="signup.php">Sign up</a> or <a class="item" href="home.html"> Home </a>';
		?>

	</div>
	<div id="content">

</body>



</html>