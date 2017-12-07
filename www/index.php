<?php
  $servername = "db";
  $username = "root";
  $password = "docker";
  $table = "returnPath";

$con = mysqli_connect($servername, $username, $password, $table);

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
  $mysqli = new mysqli($servername, $username, $password, $table);
  $getData = "SELECT * FROM emails";
  //$result =  mysqli_query($con, $getData);
  echo "Connected Successfully";

  if ($result = $mysqli->query($getData)) {
    printf("Select returned %d rows.\n", $result->num_rows, "\n");

    echo "\n" . '<pre>' . var_dump($result) . '</pre>';

    while($row = $result->fetch_assoc()) {

        echo "<br>" . "To Email " . $row["to_email"]. " From Email " . $row["from_email"] . "  Date " . $row["date_email"] . " Subject " . $row["subject"];
    }


    /* free result set */
    $result->close();
}


mysqli_close($con);
}

//SELECT * FROM emails WHERE from_email = 'chris@email.com';
//SELECT * FROM emails;
?>
