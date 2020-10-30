<?php
require_once('../includes/connection.inc.php');

class CrudItem{
  public function insertNewItem($arr){
    $arr_data = array_values($arr);
    $arr_data_cleaned = array_map(function($item){
      if(is_array($item)){
        return json_encode($item, JSON_PRETTY_PRINT);
      }else{
        return $item;
      }
    },$arr_data);
    $sql_items = '';
    $sql_val_placeholder = '';
    foreach(array_keys($arr) as $key){
      $sql_items .= $key.',';
      $sql_val_placeholder .= '?,';
    }
    try {
      $conn = new Dsn;
      $sql = 'INSERT INTO tbl_items('.rtrim($sql_items, ',').')VALUES('.rtrim($sql_val_placeholder, ',').')';
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute($arr_data_cleaned);
      if($stmt->rowCount() > 0){
        return true;
      }else{
        return false;
      }
    } catch (PDOExeption $e) {
      echo 'ERROR: '.$e->getMessage();
    }
   
  }

  

  


}







?>