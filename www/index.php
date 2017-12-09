<?php
  include('commonFunctions.php');

  //TO DO BREAK THIS DOWN INTO OOP

  //variables
  $servername = "db";
  $username = "root";
  $password = "docker";
  $db = "returnPath";
  $table = "emails";

  //Request Methon Paramaters
  $method = $_SERVER['REQUEST_METHOD'];
  $url_elements = explode('/', $_SERVER['PATH_INFO']);

  //Database Connection Info
  $con = mysqli_connect($servername, $username, $password, $db);




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

      //SET THE CORRECT endpoint

      switch ($method) {
      case 'GET':
        $sql_query = "SELECT * FROM $table";
        break;
      case 'POST':
      $sql_query = "INSERT INTO $table VALUES (null, '".$to_email."','".$from_email."', '".$date."', '".$subject."', '".$message_id."')";
      break;
      default:
          $sql_query = "SELECT * FROM $table";
          break;
      }


      //TODO
      // case 'PUT':
      //   $sql_query = "";
      //   break;
      // case 'DELETE':
      //   $sql_query = "";
      //   break;
      // }

      echo($sql_query);




      //query the database for all of the rows
      $mysqli = new mysqli($servername, $username, $password, $db);
      // $sql_query = "SELECT * FROM $table";


      //parse through the results
      if ($result = $mysqli->query($sql_query)) {
        printf("Select returned %d rows.\n", $result->num_rows, "\n");
        printf(varDump($result));

        //loop through each row to parse the data
        if($method == 'GET') {
          while($row = $result->fetch_assoc()) {

              echo "<br>" . "To Email " . $row["to_email"]. " From Email " . $row["from_email"] . "  Date " . $row["date_email"] . " Subject " . $row["subject"];
          }

          $result->close();

        } else {
          echo "Your New message has been posted";
        }
        /* free result set */
    }

    mysqli_close($con);
  }


  //deliver the endpoint

//SELECT * FROM emails WHERE from_email = 'chris@email.com';
//SELECT * FROM emails;
?>
