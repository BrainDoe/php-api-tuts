<?php 
  class Database {
    // DB properties
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_name = 'myblog';
    private $db_pass = '';
    private $conn;

    public function connect(){
      $this->conn = null;

      try{
        $this->conn = new PDO('mysql:host='.$this->db_host.';dbname=' . $this->db_name, $this->db_user, $this->db_pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e){
        echo 'Connection Error'.$e->getMessage();
      }

      return $this->conn;
    }
  }