<?php 
session_start();
//connect.php
$server	    = 'localhost';
$username	= 'root';
$password	= '';
$database	= 'testing';

$link = mysqli_connect($server, $username, $password, $database) or die("Error " . mysqli_error($link)); 
$mysqli = new mysqli($server, $username, $password, $database);

//if(!mysqli_connect($server, $username, $password, $database))
if(!$link)
{
 	exit('Error: could not establish database connection');
}
else
  echo 'Success... ' . $mysqli->host_info . "\n";
//if(!mysql_select_db($database))
//{
// 	exit('Error: could not select the database');
//}

//Note: mysql_connect, mysql_select_db, and mysql_query are deprecated.
?>