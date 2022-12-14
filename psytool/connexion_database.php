<?php 

$user="root";
$mdp="";
$db="psytool";
$server="localhost";

$conn=mysqli_connect($server, $user, $mdp, $db);

if ($conn) {
   // echo "connection ok";
} else {
    die(mysqli_connect_error());
}


?>