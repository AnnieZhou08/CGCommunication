<!-- edit_user.php -->
<html>
<body>

<?php
//database connection	
include 'connect.php';
include 'header_volunteer.php';

error_reporting(E_ALL ^ E_NOTICE);

if($_SESSION['signed_in'] == false && $_SESSION['user_level'] != 1)
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
$hours=$_POST['hours'];
$levels=$_POST['level'];

$query3=mysqli_query($link,"UPDATE user SET Username='$name', 
							Email='$email',
							Hours='$hours',
							User_Level = '$levels'
							where User_ID='$id'");
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
//$query1=mysqli_query($link,"select * from users where id='$id'");

$order = "SELECT * FROM user where User_ID='$id'";
$result = mysqli_query($link, $order);

//$query2=mysqli_fetch_array($query1);
$query2 = mysqli_fetch_array($result);

echo '<p>Edit User <span>|</span> </p>';
echo '<a class = "item" href = "index.php"> Home </a> - <a class = "item" href = "list_users.php"> Go Back </a> <br> <br> <br>';
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
<td> User Level: </td> <td> <input class="input" type="text" name="level" id="level" value="<?php echo $query2['User_Level']; ?>" /></td>
</tr>
<tr>
<td> Hours: </td> <td> <input class="input" type="text" name="hours" id="hours" value="<?php echo $query2['Hours']; ?>" /></td>
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