<?php
  require_once('../includes/connection.inc.php');



  class CrudRegister{


    public function insertIntoAccount($dataAccount){
      $conn = new Dsn;
      $a = '';
      $b = '';
      $c = '';
      foreach(array_filter($dataAccount) as $key => $val){
        $a = $a.$key.',';
        $b = $a.$val.',';
        $c = $c.'?,';
      }

      try {
        $sql = 'INSERT INTO tbl_user_account('.rtrim($a,',').')VALUES('.rtrim($c,',').')';
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute(array_values(array_filter($dataAccount)));
        if($stmt->rowCount() > 0){
          return true;
        }else{
          return false;
        }
      } catch (PDOException $e) {
        echo 'ERROR! '.$e->getMessage();
      }
    }
    
    /* INSERTING USER INFORMATION img. name etc... */

    public function insertIntoInfo($dataInfo){
      $conn = new Dsn;
      // a = key, b = value of assoc array $dataInfo and $c = anon placeholder
      $a = '';
      $b = '';
      $c = '';
      // array filter incase value is empty in $dataInfo it won, include
      foreach(array_filter($dataInfo) as $key => $val){
        $a = $a.$key.',';
        $b = $b.$val.',';
        $c = $c.'?,';
      }
      try{
        $sql = 'INSERT INTO tbl_user_info('.rtrim($a,',').')VALUES('.rtrim($c,',').')';
        $stmt = $conn->connect()->prepare($sql);
        //Execute needs an array param
        $stmt->execute(array_values(array_filter($dataInfo)));
        if($stmt->rowCount() > 0){
          return true;
        }else{
          return false;
        }
      }catch(PDOException $e){
        echo 'Error: '.$e->getMessage();
      }
    }

    

    //End of Class CrudRegister
  } 

?>