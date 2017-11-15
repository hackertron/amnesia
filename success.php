<?php

require_once("config.php");


$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($conn->connect_error) die($conn->connect_error);

function sanitizestring($var)
{
	 global $conn;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $conn->real_escape_string($var);

}

 if (isset($_POST['name']) && isset($_POST['mobile'])) {
 	# code...
 	$name   = sanitizestring($_POST['name']);
 	$number = sanitizestring($_POST['mobile']);

 	echo "name : " . $name . " number : ".$number;

 	$query = "INSERT INTO patient(name,number) VALUES" .
      		"('$name', '$number')";

    $result =  $conn->query($query);
    if(!$result)
    {
    	echo "error in inserting data " . $conn->error;
    }
    else
    {
    	echo " RECORD ADDED SUCCESSFULLY !! . You will get SMS soon";
    }
 }
 else
 {
 	echo "Name or number are not valid";
 }

 $conn->close();

 ?>
