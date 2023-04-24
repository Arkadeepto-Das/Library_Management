<?php
  namespace application\model;
  /**
   * This class is used to check the format of user input data.
   * 
   *   @method passwordValidation()
   *     This function is used to check the format of the password.
   */
  class Validation {

    /**
     * This function is used to check the password of the user.
     * 
     *   @param string $password
     *     Stores the password.
     * 
     *   @return bool
     *     Returns TRUE if the password is valid otherwise FALSE.
     */
    public function passwordValidation(string $password) {
      if (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=!\?]{8,20}$/", $password) == 1) {
        return TRUE;
      }
      return FALSE;
    }

    /**
     * This function is used to check image file size and type.
     * 
     *   @param array $image
     *     Stores the details of the image file.
     *  
     *   @return mixed
     *     Returns the file path if file is valid otherwise FALSE.
     */
    public function imageValidation(array $image) {
      $target_dir = "public/assets/images/";
      $target_file = $target_dir . basename($image["name"]);
      $imageType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is an actual image or fake image.
      if(isset($_POST["submit"])) {
        $check = getimagesize($image["tmpName"]);
        if($check === FALSE) {
          return FALSE;
        }
        else {
          // Check file size.
          if ($image["size"] > 8000000) {
            return FALSE;
          }
          else {
            // Allow certain file formats.
            if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg") {
              return FALSE;
            }
            else {
              //Upload image file.
              move_uploaded_file($image["tmpName"], $target_file);
              return $target_file;
            }
          }
        }
      }
    }
  }
