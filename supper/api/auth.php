<?php
include_once '../core/init.php';

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'login') {
  $username = htmlentities($_POST['username']);
  $password = htmlentities($_POST['password']);
  $result = '';
  $customer = new Authentication();
  $customer->setUsername($username);
  $customer->setPassword($password);
  $data = $customer->login();

  if (count($data) > 0) {
    $_SESSION['loggedIn'] = $data[0]['email'] . $data[0]['password'];
    $_SESSION['id'] = $data[0]['id'];
    $_SESSION['username'] = $data[0]['username'];
    $_SESSION['email'] = $data[0]['email'];
    $_SESSION['status'] = $data[0]['status'];
    $_SESSION['loggedInData'] = $data[0];
   
    $result = $data[0]['status'];
    // $result = 'success';
  } else {
    $result = 'failed';
  }
  echo $result;
}
