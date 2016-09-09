<html>
<body>
<?php
//database connection	
include 'connect.php';
include 'header_volunteer.php';

$query1=mysqli_query($link,"select Hours, Username, Email, User_ID, User_Level from user");
echo '<p> Edit Users <span>|</span>';
echo '<br> <a class = "item" href = "index.php"> Home </a> <br> <br> <br>';
echo "<table><tr><td><b>Name</b></td><td><b>Email</b></td><td><b>User Level</b></td><td><b>Hours</b></td>";
while($query2=mysqli_fetch_array($query1))
{
echo "<tr><td>".$query2['Username']."</td>";
echo "<td>".$query2['Email']."</td>";
echo "<td>".$query2['User_Level']."</td>";
echo "<td>".$query2['Hours']."</td>";
echo "<td><a href='edit_user.php?id=".$query2['User_ID']." style=color:black;'>Edit</a></td>";
echo "<td><a href='delete_user.php?id=".$query2['User_ID']."'>Delete</a></td><tr>";
}
?>
</ol>
</table>
</body>
</html>
