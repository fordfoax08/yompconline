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

    /* KEY and table param */
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


  /* Display index.php all item */
  public function getAllItems($item_category = 0){
    $conn = new Dsn;
    // $sql = "SELECT * FROM tbl_items ORDER BY id DESC";
    // if($item_category > 0){
    //   $sql = "SELECT * FROM tbl_items WHERE item_category = ? ORDER BY id DESC";
    // }
    try{
      if($item_category > 0){
        $sql = "SELECT * FROM tbl_items WHERE item_category = ? ORDER BY id DESC";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute(array($item_category));
      }else{
        $sql = "SELECT * FROM tbl_items ORDER BY id DESC";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute();
      }

      /* Returning Result data */
      if($stmt->rowCount() > 0){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }else{
        return [];
      }
    } catch (PDOException $e){
      echo 'Error: '.$e->getMessage();
    }
  }




  /* Display All User/seller's Item Ajax */
  public function getAllUserItem($user_id, $sort_by,$limit){
    $sort = 'DESC';
    if($sort_by == 2){
      $sort = 'ASC';
    }
    $conn = new Dsn;
    try{
      $sql = "SELECT * FROM tbl_items WHERE user_id = ? ORDER BY id $sort LIMIT $limit,10";
      // $sql = "SELECT * FROM tbl_items WHERE user_id = ? ORDER BY id $sort LIMIT $limit,$limit_offset";
      // $sql = "SELECT * FROM tbl_items WHERE user_id = ? ORDER BY id $sort";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$user_id]);
      if($stmt->rowCount() > 0){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }else{
        return [];
      }
    }catch(PDOException $e){
      echo 'Error: '.$e->getMessage();
    }
  }


  /* GET All item count */
  public function getAllItemsCount($user_id){
    $conn = new Dsn;
    try {
      $sql = "SELECT * FROM tbl_items WHERE user_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute(array($user_id));
      if($stmt->rowCount() > 0){
        return $stmt->rowCount();
      }else{
        return 0;
      }
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }



  /* SEARCH USER ITEM Ajax*/
  public function searchUserItem($user_id, $search_data,$search_option){
    $opt = 'item_name';
    if($search_option == 2){
      $opt = 'item_id';
    }
    $conn = new Dsn;
    try {
      $sql = "SELECT * FROM tbl_items WHERE user_id = ? AND $opt LIKE ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute([$user_id,"%{$search_data}%"]);
      if($stmt->rowCount() > 0){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }else{
        return [];
      }
    } catch (PDOException $e) {
      echo 'Error'.$e-getMessage();
    }

  }
  

  /* DELETE Item/s Ajax
  * admin.php
  */


  public function deleteSellerItems($user_id, $item_id, $sort_by, $limit){
    $placeholder = '';
    for($i = 0; $i < count($item_id);$i++){
      $placeholder .= '?,';
    }
    /* return $placeholder; */
    array_unshift($item_id,$user_id);

    $conn = new Dsn;
    try{
      $sql = "DELETE FROM tbl_items WHERE user_id = ? AND item_id IN (".rtrim($placeholder,',').")";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute($item_id);
      if($stmt->rowCount() > 0){
        return $this->getAllUserItem($user_id,$sort_by,$limit);
      }else{
        return [];
      }
    }catch(PDOException $e){
      echo 'Error: '.$e->getMessage();
    }
  }
  


}







?>