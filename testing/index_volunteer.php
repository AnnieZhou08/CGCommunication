<?php
include 'connect.php';
include 'header_volunteer.php';

if(isset($_SESSION['signed_in']))  //Notice: Undefined index, 'user_level'
{	
	echo '<br><p style = "margin-top: 5%"> Hello. <b>' . htmlentities($_SESSION['user_name']) . '</b><span>|</span></p></b> <a class="item" href="signout_volunteer.php" style="right:0px;">Sign out</a> <br> </br>';
	echo '<a class = "item" href="calendar_volunteer.php"> View events </a> <br>';
	echo '<a class = "item" href="create_post_volunteer.php"> Create a Post </a> <br>';
	echo '<a class = "item" href="all_posts_volunteer.php"> View All Posts </a> <br>';
	echo '<a class = "item" href="create_msg_volunteer.php"> Create a Message </a> <br>';
	echo '<a class = "item" href="view_message_volunteer.php"> View messages </a> <br>';
	echo '<a class = "item" href="change_settings_volunteer.php?id='.$_SESSION['user_id'].'"> Account Settings </a> <br>';
}
else
{
	echo '<a class="item" href="signin-admin.php">Sign in</a> or <a class="item" href="signup.php">Sign up</a>';
}
?>