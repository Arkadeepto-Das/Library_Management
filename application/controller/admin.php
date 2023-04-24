<?php
  require_once 'vendor/autoload.php';

  use application\model\Database;
  use application\model\Validation;
  
  if (isset($_POST["userName"]) && isset($_POST["password"])) {
    $role = $_POST["role"];
    $userName = $_POST["userName"];
    $password = $_POST["password"];
    $query = new Database();
    $validate = new Validation();
    $userDetails = $query->userDetails($userName, $role);
    $response = [];
    if ($userDetails === NULL || $userName != $userDetails["username"]) {
      $response['status'] = 0;
      $response['userName'] = "Username doesn't exist.";
      print_r(json_encode($response));
      exit();
    }
    elseif ($validate->passwordValidation($password) === FALSE) {
      $response['status'] = 0;
      $response['password'] = "Password should be of min 8 characters with atleast 1 uppercase, 1 lowercase, 1 digit and 1 special character.";
      print_r(json_encode($response));
      exit();
    }
    elseif ($password != $userDetails["password"]) {
      $response['status'] = 0;
      $response['password'] = "Incorrect password";
      print_r(json_encode($response));
      exit();
    }
    else {
      $response['status'] = 1;
      print_r(json_encode($response));
    }
  }
  else {
    require_once 'application/view/admin_login.php';
  }
