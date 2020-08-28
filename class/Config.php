<?php
class Config {
  private $host = "localhost";
  private $db_name = "db_saw";
  private $username = "root";
  private $password = "";
  public $conn;
  public $data;

  public function __construct(){
    $this->getConnection();
    $this->data = [
              'module_title'    => 'All Kriteria - SPK',
              'module_subtitle' => 'Data Kriteria',
              'module_desc'     => 'Kriteria',
              'module_icon'     => 'fa fa-file'
          ];
    return $this->data;  
  }
  

  public function getConnection() {
    $this->conn = null;
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

    if ($this->conn->connect_error) {
      return die("Connection failed: " . $this->conn->connect_error);
    }
    else{
      return $this->conn;
    }
  }
}
