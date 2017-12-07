<?php
  //database
  $servername = "db";
  $username = "root";
  $password = "docker";
  $table = "returnPath";

  //api server
  $serverRequest = $_SERVER['REQUEST_METHOD'];
  $url_elements = explode('/', $_SERVER['PATH_INFO']);

  echo $serverRequest. "<br>";
  echo $_SERVER['PATH_INFO'] . '<br><br>';

  $con = mysqli_connect($servername, $username, $password, $table);

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




  //deliver the endpoint

//SELECT * FROM emails WHERE from_email = 'chris@email.com';
//SELECT * FROM emails;
?>
