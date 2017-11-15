  <?php

  require __DIR__ . '/vendor/autoload.php';
  require_once("config.php");
  use Twilio\Rest\Client;


  $client = new Client($sid, $token);

  $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($conn->connect_error) die($conn->connect_error);

  $sql = "SELECT name , number FROM patient";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    	# code...
   while ($row = $result->fetch_assoc()) {
    		# code...

       // get time zone
    $timezoneMapper = \libphonenumber\PhoneNumberToTimeZonesMapper::getInstance();

    $get_time_num = \libphonenumber\PhoneNumberUtil::getInstance()->parse($row["number"]);

        // get current time based on time zone
    $time_zone = $timezoneMapper->getTimeZonesForNumber($get_time_num)[0];
    echo $time_zone . "\n";

    $date = new DateTime(" now ", new DateTimeZone($time_zone));
    echo $date->format('H:i:s');
    $curr_time = $date->format('H:i:s');

    //$curr_time = "04";
    if (strtotime($curr_time) <= strtotime(date('23:00:00')) && strtotime($curr_time) >= strtotime(date('10:00:00'))) {
          # code...

      echo "  curr_time : " . $curr_time;

        
          $client->messages->create(
        $row['number'],
      array(
       'from' => '+15622802226',
       'body' => 'Your name is : ' . $row['name']
     )
     );
  

     echo " message sent to name : " . $row["name"] . " " . $row["number"] . "\n";


   }
   else
   {
    echo " sleep time ";
  }


  }
  }
  ?>
