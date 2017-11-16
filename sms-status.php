<?php

require_once("config.php");

$update = json_decode(file_get_contents('php://input'));

echo $update;

$sid = $_REQUEST['MessageSid'];
$status = $_REQUEST['MessageStatus'];


$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($conn->connect_error) die($conn->connect_error);

 $query = "INSERT INTO msg_status(id,status) VALUES" .
      		"('$sid', '$status')";

    $result =  $conn->query($query);
    if(!$result)
    {
    	echo "error in inserting data " . $conn->error;
    }
    else
    {
    	echo " RECORD ADDED SUCCESSFULLY !! . You will get SMS soon";
    } 



$conn->close();
?>
