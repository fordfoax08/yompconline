<?php
require_once '../class/crudinfo.class.php';
$con = new CrudInfo;
$dataJson = json_encode($con->getAllUserName());
echo $dataJson;
?>