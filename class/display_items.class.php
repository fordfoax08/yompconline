<?php
require_once 'includes/connection.inc.php';

class DisplayItems{
  /* Get all Items of Current Seller / User  */
  public function getSellersItems($user_id){
    $conn = new Dsn;
    try{
      $sql = 'SELECT * FROM tbl_items WHERE user_id = ?';
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



  /* template for items to be displayed in Admi.php user's items */
  public function displayTemplate($dataArr){
    $template = '
      <tr>
        <td>
          <input type="checkbox" name="productName">
        </td>
        <td><img src="multimedia/image/'.$dataArr[0].'/'.$dataArr[1].'" alt=""></td>
        <td>
          <p>'.$dataArr[2].'</p>
          <p>'.$dataArr[3].'</p>
        </td>
        <td>
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
          </svg>
        </td>
      </tr>
    ';
    return $template;
  }

}
?>