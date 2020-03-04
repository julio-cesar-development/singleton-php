<?php
class DatabaseConnection {
  private $host;
  private $db_name;
  private $username;
  private $password;
  private $conn;

  public function __construct() {
    $this->host = !empty($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : 'localhost';
    $this->db_name = !empty($_ENV['DB_DATABASE']) ? $_ENV['DB_DATABASE'] : 'Singleton';
    $this->username = !empty($_ENV['DB_USER']) ? $_ENV['DB_USER'] : 'root';
    $this->password = !empty($_ENV['DB_PASSWORD']) ? $_ENV['DB_PASSWORD'] : 'admin';
    $this->conn = null;
  }

  public function connect() {
    try {
      $dsn = "mysql:host=$this->host;dbname=$this->db_name";
      $this->conn = new PDO($dsn, $this->username, $this->password);
    } catch(PODException $err) {
      echo 'Connection Error: '.$err->GetMessage();
    }
    return $this->conn;
  }
}

?>
