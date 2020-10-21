<?php

class FilterInput{


  /* Check if String lenght is Valid -bool */
  public function isStringCountValid($str){
    if(strlen($str) >= 250){
      return false;
    }
    return true;
  }

  /* Sanitize String remove html tag and remove whitespace before after*/
  public function sanitizeString($str){
    $trimmed_str = trim($str);
    return filter_var($trimmed_str, FILTER_SANITIZE_STRING);
  }

  /* Email validation
    included also sanitation
  */  
  public function isEmailValid($email){
    $original_e = $email;
    $sanitized_e = filter_var($original_e, FILTER_SANITIZE_EMAIL);
    if($original_e == $sanitized_e && filter_var($original_e, FILTER_VALIDATE_EMAIL)){
      return true;
    }else{
      return false;
    }
  }



}


$testInputFilter = "Connection to input_filter.class.php success!";
?>