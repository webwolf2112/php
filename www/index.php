<?php
  include('variables.php');
  include('commonFunctions.php');

  class Email {
    public $to;
    public $from;
    public $subject;
    public $message_id;
    public $date;
  }

  class ReturnMessage {
      public $return_message;
      public $return_data;
  }

  $common = new CommonFunctions();
  $con = mysqli_connect($servername, $username, $password, $db);

  //database items to store
  $to_email = $common->sanatizePostData('to');
  $from_email = $common->sanatizePostData('from');
  $subject = $common->sanatizePostData('subject');
  $date = $common->sanatizePostData('date');
  $message_id = $common->sanatizePostData('message_id');

    // Check connection
    if (mysqli_connect_errno())
    {
      $data = new ReturnMessage();
      $data-> $return_message = "Failed to connect to MySQL: " . mysqli_connect_error();
      $data-> $return_data = [];

      echo json_encode($data);

    } else {

      //SET THE CORRECT Method
      if(isset($_SERVER['REQUEST_METHOD'])) {
          $method = $_SERVER['REQUEST_METHOD'];
      } else {
        $method = 'GET';
      }

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

      //TODO Add the PUT and Delete Methods into query prams

      $mysqli = new mysqli($servername, $username, $password, $db);

      if ($result = $mysqli->query($sql_query)) {

        if($method == 'GET') {

          $data = new ReturnMessage();
          $data->return_message = "Emails returned from server";
          $return_data = [];

          while($row = $result->fetch_assoc()) {
            $email = new Email();
            $email->to = $row["to_email"];
            $email->from = $row["from_email"];
            $email->subject = $row["subject"];
            $email->date = $row["date_email"];
            $email->message_id = $row["message_id"];

            array_push($return_data, $email);
          }

          $data->return_data = $return_data;
          $result->close();
        } else {

          $data = new ReturnMessage();
          $data->return_message = "Your email message has been submitted";
          $data-> $return_data = [];
        }

        $data->post_var = $_FILES;
        $data->email = $_POST;

        header('Content-Type: application/x-www-form-urlencoded');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        echo json_encode($data);
    }

    mysqli_close($con);
  }
?>
