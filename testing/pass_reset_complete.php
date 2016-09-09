<?php
require("connect.php");
include 'header_forgot_pass.php';

$newpass = $_POST['newpass'];
$newpass1 = $_POST['newpass1'];
$post_username = $_POST['username'];

if($newpass == $newpass1)
{
	$enc_pass = sha1($newpass);
	mysqli_query($link, "UPDATE user SET Password='$newpass' WHERE Username = '$post_username'");
	
	echo "Your password has been updated";
}
else
{
	echo "Password must match";
}


?>