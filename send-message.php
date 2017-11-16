  <?php

  require __DIR__ . '/vendor/autoload.php';
  require_once("config.php");
  use Twilio\Rest\Client;

  $client = new Client($sid, $token);

  function send_message($name,$number)
  {
      global $client;
      $attempts  = 0;
      while($attempts < 5)
      {
      try {
        $client->messages->create(
        $number,
      array(
       'from' => 'your Twilio number here',
       'body' => 'Your name is : ' . $name,
       'statusCallback' => 'http://5c77867a.ngrok.io/amnesia/sms-status.php'
     )
     );
        $conn = new mysqli('localhost', 'root', 'pass', 'amnesia');
        if ($conn->connect_error) die($conn->connect_error);
        $sql = "SELECT id FROM msg_status ORDER BY pid DESC LIMIT 1";
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
          $mid = $result->fetch_assoc();  
          echo " check : " . $mid['id'];
        
        $sql = "SELECT status FROM msg_status ORDER BY pid DESC LIMIT 1";
        echo "sql check  : " . $sql;
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
          $row = $result->fetch_assoc();
          if($row['status'] != "sent" || $row['status'] == "undelivered" || $row['status'] == "failed")
          {
              $data = "FAILED msg id : " . $mid['id'] . " status : " . $row['status'] . " time : " . date("h:i:sa");
              file_put_contents('logs.txt', $data, FILE_APPEND);
              ++$attempts;
          }
          else if ($row['status'] == "sent" || $row['status'] == "delivered") {
            return "success";
          }
          else
          {
            echo "unknown shit happened";
            break;
          } 
        }
      }
      } catch (TwilioRestException $e) {

          return  $e;
      }
    }
     
  

}
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
    if (strtotime($curr_time) <= strtotime(date('23:59:00')) && strtotime($curr_time) >= strtotime(date('08:00:00'))) {
          # code...

      echo "  curr_time : " . $curr_time;

       $final = send_message($row["name"] , $row["number"]); 
      if ($final == "success") {
        # code...
        echo " message sent to name : " . $row["name"] . " " . $row["number"] . "\n";
      }
      else
      {
        echo "something happened !!";
      }     


   }
   else
   {
    echo " sleep time ";
  }


  }
    $conn->close();

  }
  ?>
