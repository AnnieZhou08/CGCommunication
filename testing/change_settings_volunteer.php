<!-- edit_user.php -->
<html>
<body>

<?php
//database connection	
include 'connect.php';
include 'header_volunteer.php';

error_reporting(E_ALL ^ E_NOTICE);

if($_SESSION['signed_in'] == false)
{
	//the user is not an admin
	echo "<BR>";
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
if(isset($_GET['id']))
{
$id=$_GET['id'];
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$passagain=$_POST['passagain'];

if($passagain != $password)
{
	echo 'Passwords must match!';
}
else
{
$query3=mysqli_query($link,"UPDATE user SET Username='$name', 
							Email='$email',
							Password='$password'
							where user_id='$id'");
if($query3)
{
//header('location:list_user.php');
echo 'Update successful.';
}
else
{
echo "<BR>";
echo 'Failed to edit entry.';
}
}
}
//$query1=mysqli_query($link,"select * from users where id='$id'");

$order = "SELECT * FROM user where User_ID='$id'";
$result = mysqli_query($link, $order);

//$query2=mysqli_fetch_array($query1);
$query2 = mysqli_fetch_array($result);

echo '<p>Account Settings<span>|</span> </p>';
echo '<a class = "item" href = "index_volunteer.php"> Home </a><br> <br> <br>';
?>
<form style = "margin-top: 5%" method="post" action="">
<table>
<tr>
<td> Name: </td> <td> <input class="input" type="text" name="name" id="name" value="<?php echo $query2['Username']; ?>" /> </td>
</tr>
<tr>
<td> Email: </td> <td> <input class="input" type="text" name="email" id="email" value="<?php echo $query2['Email']; ?>" /></td>
</tr>
<tr>
<td> Password </td> <td> <input class="input" type="password" name="password" id="password"/></td>
</tr>
<tr>
<td> Password Again </td> <td> <input class="input" type="password" name="passagain" id="passagain"/></td>
</tr>
<br />
</table>
<input type="submit" name="submit" value="Update" />
</form>
<?php
}
}
?>
</body>
</html>