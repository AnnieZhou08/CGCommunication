<?php
require ("connect.php");
include 'header_forgot_pass.php';

echo "

<form action= 'forgotpassword.php' method= 'POST'>
<table>
<tr>
	<td>Enter your username</td><td> <input type='text' name='username'> </td>
</tr>
<tr>
	<td> Enter your email</td><td> <input type='email' name= 'email'></td>
</tr>
</table>
<br>
<input type = 'submit' value= 'Submit' name= 'submit'>
</form>

";

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$email = $_POST['email'];
	
	$query = mysqli_query($link,"SELECT Email FROM user WHERE Username = '$username'");
	
	if(mysqli_num_rows($query)>0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$db_email = $row['Email'];
		}
		if($email == $db_email)
		{
			echo "
			<form action='pass_reset_complete.php' method='POST'>
				Enter a new password <br> <input type = 'password' name = 'newpass'> <br>
				Re-enter your password <br> <input type = 'password' name = 'newpass1'> <br> <br>
				<input type ='submit' value = 'Update Password!'>
				<input type = 'hidden' name='username' value ='$username'>
			</form>
			";
		}
		else
		{
			echo "Username or Email is incorrect";
		}
	}
	else
	{
		die('Invalid query: '. mysql_error());
		echo "That Username does not exist";
	}
}

?>