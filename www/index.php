<?php
  $servername = "127.0.0.1";
  $username = "root";
  $password = "docker";

  phpinfo();

  if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    echo 'Phew we have it!';
}

  $conn = new mysqli($servername, $username, $password);

  if($conn->connect_err) {
    echo "Connection was not successful";
    die('Connection Failed: ' . $conn->connect_error);
  }
  echo "Connected Successfully";
?>
