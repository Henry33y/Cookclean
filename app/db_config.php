<?php

//ob_start();
//session_start();

$server_name = 'localhost';
$user_name = 'afrohwno_buom';
$password = 'buomonline@55';
$database = 'afrohwno_buomonline';


$conn = mysqli_connect($server_name, $user_name, $password , $database);
$mysqli = new mysqli($server_name, $user_name, $password, $database);


/* check connection */
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}




function sanitize($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
