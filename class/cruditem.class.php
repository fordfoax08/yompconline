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

  /* UPDATE ITEM ************* */
  public function updateItem($arr){
    $conn = new Dsn;
    $data = $arr;
    /* remove empty item from $data array */
    $data_filtered = array_filter($data, fn($item) => $item);
    /* Prepare SQLquery template */
    $sqla = '';
    $sqlb = 'UPDATE tbl_items SET';
    $sqlc = ' WHERE ';
    $dataValue = [];
    /* set sql template and remove item_id*/
    foreach(array_keys($data) as $key){
      if($key != 'item_id'){
        $sqla .= ' '.$key.' = ?,';
      }
      if($key === 'item_id'){
        $sqlc .= $key.' = ?';
      }
    }

    /* Arrange value for execute() */
    foreach($data as $key => $value){
      if($key !== 'item_id'){
        array_push($dataValue, is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value);
      }
    }

    foreach($data as $key => $value){
      if($key === 'item_id'){
        array_push($dataValue, $value);
      }
    }


    /* Sql query Template */
    $sql = $sqlb.rtrim($sqla,',').$sqlc;

    try{
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute($dataValue);
      if($stmt->rowCount() > 0){
        return '1';
      }else{
        return '0';
      }
    } catch(PDOException $e){
      echo 'Error Updating Item: '.$e->getMessage();
    }

    // return $dataValue;
  }


  /* Display index.php all item */
  public function getAllItems($page = 1,$item_category = 0){
    $conn = new Dsn;
    $paging = ($page - 1) * 20;
    // $sql = "SELECT * FROM tbl_items ORDER BY id DESC";
    // if($item_category > 0){
    //   $sql = "SELECT * FROM tbl_items WHERE item_category = ? ORDER BY id DESC";
    // }
    try{
      if($item_category > 0){
        $sql = "SELECT * FROM tbl_items WHERE item_category = ? ORDER BY RAND () LIMIT $paging,20";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute(array($item_category));
      }else{
        // $sql = "SELECT * FROM tbl_items ORDER BY RAND ()";
        $sql = "SELECT * FROM tbl_items ORDER BY RAND () LIMIT $paging,20";
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

  /* Get Pagination / all item to index.php */
  public function getPageCount($category=0){
    $conn = new Dsn;
    $sql = 'SELECT * FROM tbl_items';
    if($category > 0){
      $sql = "SELECT * FROM tbl_items WHERE item_category = ?";
    }

    try{
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute(array($category));
      if($stmt->rowCount() > 0){
        return count($stmt->fetchAll(PDO::FETCH_ASSOC)) / 20;
      }else{
        return count([]);
      }
    }catch(PDOException $e){
      echo 'Error getting Page: '.$e->getMessage();
    }
  }

  
  /* GET SELLER ITEM */
  public function getItemForModal($item_id){
    $conn = new Dsn;
    $sql = "SELECT * FROM tbl_items WHERE item_id = ?";
    try{
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute(array($item_id));
      if($stmt->rowCount() > 0){
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }else{
        return [];
      }
    }catch(PDOException $e){
      echo 'Error getting modal: '.$e->getMessage();
    }
  }

  /* Get item for Cart , index.php */
  public function getItemForCart($item_id){
    $conn = new Dsn;
    $sql = " SELECT * FROM tbl_items WHERE item_id = ?";
    try{
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute(array($item_id));
      if($stmt->rowCount() > 0){
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }else{
        return [];
      }
    }catch(PDOException $e){
      echo 'Error getting item for Cart: '.$e->getMessage();
    }
  }



  /* GET ONE SELLER/USER ITEM by item id, admin.php */
  public function getSellerItemById($user_id,$item_id){
    $conn = new Dsn;
    try{
      $sql = "SELECT * FROM tbl_items WHERE user_id = ? AND item_id = ?";
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute(array($user_id,$item_id));
      if($stmt->rowCount() > 0){
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }else{
        return [];
      }
    }catch(PDOException $e){
      echo 'Error: '.$e->getMessage();
    }
  }




  /* Display All User/seller's Item Ajax for admin.php*/
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


  /* GET All item count for admin.php*/
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



  /* SEARCH USER ITEM Ajax for admin.php*/
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


  /* SEARCH ITEM Ajax for index.html
  * Filters search_by & searc_category
  */
  public function searchItem($dataArr){
    $conn = new Dsn;
    $sql = "SELECT * FROM tbl_items WHERE item_name LIKE ?";
    $exec = array("%".$dataArr['search_que']."%");
    if($dataArr['search_category'] > 0){
      $sql = "SELECT * FROM tbl_items WHERE item_category = ? AND item_name LIKE ?";
      $exec = array($dataArr['search_category'],"%".$dataArr['search_que']."%");
    }

    try {
      $stmt = $conn->connect()->prepare($sql);
      $stmt->execute($exec);
      if($stmt->rowCount() > 0){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }else{
        return [];
      }
    } catch (PDOException $e) {
      echo 'Error Item search: '.$e->getMessage();
    }

    // return $dataArr['search_by'];


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