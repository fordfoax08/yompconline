<?php
require_once 'includes/connection.inc.php';

class UserDetails{
  public function getUserInformation($u_id){
    $conn = new Dsn;
    try {
      $sql = 'SELECT * FROM tbl_user_info WHERE user_id = ?';
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$u_id]);
      if($stmt->rowCount() > 0){
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }else{
        return [];
      }
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }



}
$testUserDetails = 'User Details Connected';


?>
