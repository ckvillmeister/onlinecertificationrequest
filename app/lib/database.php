<?php

class database{

	private $hostname = "localhost";
	private $username = "root";
	private $password = "";
	private $database_name = "clinic_db";
	private $conn;
	
	public function connection(){
		$this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database_name);

		if ($this->conn->connect_error){
			echo 'Failed to connect to MySQL '. mysqli_connect_error();
		}
		else{
			mysqli_select_db($this->conn, $this->database_name);
			$this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database_name);
			//$this->conn->set_charset("ISO-8859-1");
			$this->conn->set_charset("utf8mb4");
			return $this->conn;
		}
	}

}
	
?>