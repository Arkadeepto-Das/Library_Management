<?php
  $uri = $_SERVER["REQUEST_URI"];
  $uri = rtrim($uri);
  switch ($uri) {
    case '/' :
      require_once 'application/controller/role.php';
      break;

    case '/customer' :
      require_once 'application/controller/customer.php';
      break;

    case '/admin' :
      require_once 'application/controller/admin.php';
      break;

    case '/register' :
      require_once 'application/controller/register.php';
      break;

    case '/book-entries' :
      require_once 'application/controller/book-entries.php';
      break;
  
    default :
      require_once 'application/controller/role.php';
      break;
  }
