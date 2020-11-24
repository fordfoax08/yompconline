<?php
 require_once('../includes/connection.inc.php');

 class CrudInfo{
  public function getAllUserName(){
    $conn = new Dsn;
    try {
      $sql = "SELECT user_name, user_email FROM tbl_user_account";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }


  /* USER LOG IN */
  public function loginUser($array){
    $conn = new Dsn;
    $u_name = $array[0];
    $u_pwd = $array[1];
    try {
      $sql = 'SELECT user_name,user_email,user_password FROM tbl_user_account WHERE user_name = ? OR user_email = ?';
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$u_name,$u_name]);
      if($stmt->rowCount() >= 1){
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(password_verify($u_pwd,$res[0]['user_password'])){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    } catch (PDOException $e) {
      echo 'ERROR login user: '.$e->getMessage();
    }
  }



  public function getUserId($user_name){
    $conn = new Dsn;
    try {
      $sql = "SELECT user_id FROM tbl_user_account WHERE user_name = ? or user_email = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$user_name,$user_name]);
      if($stmt->rowCount() >= 1){
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }else{
        return false;
      }
    } catch (PDOException $e) {
      echo 'Error getting Credential: '.$e->getMessage();
    }
  }
  
  /* Get cart item */
  /* public function getCartItem($user_id){
    $conn = new Dsn;
    $sql = "SELECT user_cart FROM tbl_user_info WHERE user_id = ?";
    try {
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute(array($user_id));
      if($stmt->rowCount() > 0){
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }else{
        return [];
      }
    } catch (PDOException $e) {
      echo 'ERROR GETTING Cart item: '.$e->getMessage();
    }
   } */


 }




?>