<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="A short description." />
 	<meta name="keywords" content="put, keywords, here" />
 	<title>Calendar</title>
	<link rel="stylesheet" href="style.css" type="text/css"> 


<style>

#title{
font-family: Arial;
font-size: 30pt;
font-weight: lighter;
color: #CEF6EC;
margin-left: 80px;
margin-top: -80px;
}

#titlebanner{
margin-left: -30px;
margin-right: -30px;
margin-top: 100px;
}

#message{
font-family: Arial;
font-size: 16pt;
color:#088A85;
margin-left: 80px;
margin-top: 50px;
}

#messagebox{
border: solid;
border-color: #088A85;
width: 500px;
height: 400px;
margin-left: 80px;
margin-top: 20px;
}

#logoutbutton{
display: block;
position: absolute;
width: 115px;
padding: 10px;
font-size: 20px;
text-align: center;
margin-right: 150px;
margin-left: 1040px;
font-family: Arial, Helvetica, sans-serif;
background-color: #0B3861;
margin-top:-253px;
border: solid;
border-color: #CEECF5;
color: white;
}

#logoutbutton:hover{
background-color: #CEECF5;
color: #08088A;
border-color: #08088A;
}

#logoutbutton a:hover{
color: #08088A;
}

#homebutton{
display: block;
position: absolute;
width: 150px;
padding: 10px;
font-size: 20px;
text-align: center;
margin-right: 150px;
margin-left: 860px;
font-family: Arial, Helvetica, sans-serif;
background-color: #0B3861;
margin-top:-253px;
border: solid;
border-color: #CEECF5;
color: white;
align: right;
}

#homebutton:hover{
background-color: #CEECF5;
color: #08088A;
border-color: #08088A;
}
#homebutton a:hover{
color: #08088A;
}

#familybutton{
position: absolute;
border: solid;
border-color: #5858FA;
background-color: #04B4AE;
color: white;
width: 400px;
font-size: 20pt;
font-family: Arial;
text-align: center;
padding: 20px;
border-radius: 8px;
margin-top: -400px;
margin-left: 700px;
align: right;
}
#familybutton:hover{
background-color: #08088A;
border-color: white;
}

#volunteerbutton{
position:absolute;
border: solid;
border-color: #8258FA;
background-color: #0489B1;
color: white;
width: 400px;
font-size: 20pt;
font-family: Arial;
text-align: center;
padding: 20px;
border-radius: 8px;
margin-top: -300px;
margin-left: 700px;
}
#volunteerbutton:hover{
background-color: #08088A;
border-color: white;

}

#sendmsg{
position: absolute;
border: solid;
border-color: #AC58FA;
background-color: #045FB4;
color: white;
width: 400px;
font-size: 20pt;
font-family: Arial;
text-align: center;
padding: 20px;
border-radius: 8px;
margin-top: -200px;
margin-left: 700px;
}
#sendmsg:hover{
background-color: #29088A;
border-color: white;
}

#registerbutton{
position: absolute;
border: solid;
border-color: #D358F7;
background-color: #0404B4;
color: white;
width: 400px;
font-size: 20pt;
font-family: Arial;
text-align: center;
padding: 20px;
border-radius: 8px;
margin-top: -100px;
margin-left: 700px;
}
#registerbutton:hover{
background-color: #4B088A;
border-color: white;
}
#content{
	font-size: 12pt;
	width: 80%;
	color: white;
}
#test{
	color: white;
	display: inline;
}
#title{
	margin-top: 5%;
	margin-left: 5%;
	
}

</style>

</head>

<body class="body-admin">

<br><br>
<p style = "font-family: Courier; font-size: 300%; color: black; margin-left: 10%; margin-top: 5%"> Your Events</p>
<a class="item" style = "margin-left: 10%; margin-top: -10%;" href="index.php">Home</a>-<a class="item" style = "margin-top: -10%;" href="create_event.php">Create an Event</a>

	<div id="wrapper">
		<div id="test">
		<?php
		if(isset($_SESSION['signed_in']))  //Notice: Undefined index, 'user_level'
		{
			//echo 'Hello <b>' . htmlentities($_SESSION['user_name']) . ' &nbsp;&nbsp;<a class="item" href="signout.php">Sign out</a>';
		}
		else
		{
			echo '<a class="item" href="signin-admin.php">Sign in</a> or <a class="item" href="index.html">Home</a>';
		}
		
		?>
		</div>

	<div id="content">