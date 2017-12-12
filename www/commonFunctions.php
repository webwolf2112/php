<?php
  class CommonFunctions {

    function varDump($variable) {
      return '<pre>' . var_dump($variable) . '</pre>';
    }

    function sanatizePostData($name) {
      $_POST = json_decode(file_get_contents('php://input'), true);
      if($_POST[$name]) {
        return  $santatizedName = filter_var($_POST[$name], FILTER_SANITIZE_STRING);
      } else {
        return '';
      }
    }
  }
?>
