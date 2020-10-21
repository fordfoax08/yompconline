<?php
class Dsn{
  private $server;
  private $username;
  private $password;
  private $database;
  private $charset;

  public function connect(){
    $this->server = 'localhost';
    $this->username = 'root';
    $this->password = '';
    $this->database = 'yom_pc_db';
    $this->charset = 'utf8mb4';

    $dsn = 'mysql:host='.$this->server.';dbname='.$this->database.';charset='.$this->charset;
    try {
      $pdo = new PDO($dsn, $this->username, $this->password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
  }
}
?>