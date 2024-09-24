<?php  

$dbhost = "localhost";
$dbuser = "id20511549_root";
$dbpass = "hp&qNJwoIjw1o7f$";
$dbname = "id20511549_users";

if (!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)) {
	die("failed to connect!");
}