<!--delete_user.php-->
<html>
<body>
<?php
include 'connect.php';

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
$query1=mysqli_query($link,"delete from user where User_ID = $id");
if($query1)
{
header('location:list_users.php');
}
else
{
echo "<BR>";
echo 'Failed to delete entry.';
}
}
}
?>
</body>
</html>