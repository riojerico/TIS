<?php
## OOP ###
class Database
{
    private $host     = '';
    private $db_name  = '';
    private $username = '';
    private $password = '';
    private $port     = '';
    public  $conn;

    public function dbConnection()
	  {

	    $this->conn = null;
      try
		  {
      $this->conn = new PDO("mysql:host=" . $this->host . ";port=" .$this->port. ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      }
		catch(PDOException $exception)
		  {
        echo "Connection error: " . $exception->getMessage();
      }

        return $this->conn;
    }
}
?>
