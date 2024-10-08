<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'pequenos_cientistas';
    private $username = 'root';
    private $password = '1234';
    private $conn;


    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo "<script> alert('Erro: " . $e->getMessage() . "'); </script>";
        }

        return $this->conn;
    }
}

$db = new Database();