<?php
  include('commonFunctions.php');
  //variables
  $servername = "db";
  $username = "root";
  $password = "docker";
  $table = "returnPath";

  //Request Methon Paramaters
  $serverRequest = $_SERVER['REQUEST_METHOD'];
  $url_elements = explode('/', $_SERVER['PATH_INFO']);

  //Database Connection Info
  $con = mysqli_connect($servername, $username, $password, $table);




  echo 'Server Request Type ' . $serverRequest. "<br>";
  echo 'Server Path Info ' . $_SERVER['PATH_INFO'] . '<br><br>';

  //database items to store
  $to_email = filter_var($_POST['to'], FILTER_SANITIZE_STRING);
  $from_email = filter_var($_POST['from'], FILTER_SANITIZE_STRING);
  $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
  $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
  $message_id = filter_var($_POST['message_id'], FILTER_SANITIZE_STRING);

  echo $to_email . ' ' . $from_email . ' '. $subject . ' ' . $date . ' ' . $message_id;

    // Check connection
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {

      //query the database for all of the rows
      $mysqli = new mysqli($servername, $username, $password, $table);
      $getData = "SELECT * FROM emails";

      //parse through the results
      if ($result = $mysqli->query($getData)) {
        printf("Select returned %d rows.\n", $result->num_rows, "\n");

        //loop through each row to parse the data
        while($row = $result->fetch_assoc()) {

            echo "<br>" . "To Email " . $row["to_email"]. " From Email " . $row["from_email"] . "  Date " . $row["date_email"] . " Subject " . $row["subject"];
        }
        /* free result set */
        $result->close();
    }

    mysqli_close($con);
  }

  // https://www.leaseweb.com/labs/2015/10/creating-a-simple-rest-api-in-php/
  // switch ($method) {
  // case 'GET':
  //   $sql = "select * from `$table`".($key?" WHERE id=$key":''); break;
  // case 'PUT':
  //   $sql = "update `$table` set $set where id=$key"; break;
  // case 'POST':
  //   $sql = "insert into `$table` set $set"; break;
  // case 'DELETE':
  //   $sql = "delete `$table` where id=$key"; break;



  //deliver the endpoint

//SELECT * FROM emails WHERE from_email = 'chris@email.com';
//SELECT * FROM emails;
?>
