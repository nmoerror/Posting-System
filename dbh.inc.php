<!-- 
    Author: Alejandro González
    Auckland University of Technology
    Stablish a server and database connection
-->

<?php
$servername = "your-servername";
$DBusername = "your-username";
$DBpassword = "your-servername-password";
$DBname = "your-databasename";

$conn = mysqli_connect($servername, $DBusername, $DBpassword, $DBname);
if (!$conn) {
    die("Connectiong Failed." . mysqli_connect_error());
}
