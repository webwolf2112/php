<?php
  function varDump($variable) {
    return '<pre>' . var_dump($variable) . '</pre>';
  }

  function sanatizePostData($name) {
    if($_POST[$name]) {
      return  $santatizedName = filter_var($_POST[$name], FILTER_SANITIZE_STRING);
    } else {
      return '';
    }
  }
?>
