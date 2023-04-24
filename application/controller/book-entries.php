<?php
  require_once 'vendor/autoload.php';
  use application\model\Database;
  use application\model\Validation;

  if (isset($_POST["add"])) {
    if ($_POST["name"] == '' || $_POST["cost"] == '' || $_POST["author"] == '' || $_POST["description"] || $_FILES['image']['size'] == 0){
      $repsonse["status"] = 0;
      $repsonse["message"] = "All the fields should be filled.";
      print_r(json_encode($repsonse));
    }
    else {
      $image["name"] = $_FILES['image']['name'];
      $image["size"] = $_FILES["image"]["size"];
      $image["tmpName"] = $_FILES["image"]["tmp_name"];
      $query = new Database();
      $validate = new Validation();
      $file = $validate->imageValidation($image);
      $addBook = $query->addBook($_POST["name"], $_POST["description"], $_POST["cost"], $_POST["author"], $file);
    }
  }
  else {
    require_once 'application/view/book-entries.php';
  }
