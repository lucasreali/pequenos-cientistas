<?php

class ProfessorController
{
    private $conn;

    public function __construct($conn = null)
    {

        try {
            require_once 'database/connection.php';
        } catch (Exception $e) {
            require_once '../database/connection.php';
        }

        $db = new Database;
        $conn = $db->connect();
        $this->conn = $conn;
    }


    // code
        public function create($name, $email, $password, $cpf, $subject)
        {
            $sql = 'INSERT INTO professor (name, cpf, email, password, subject) VALUES (:name, :cpf, :email, : password, : subject);';
            $sql .= "INSERT INTO users (email, cpf, user_type) VALUES (:email, :cpf, 'professor')";


             $stmt = $this->conn->prepare($sql);
             $stmt->bindParam(":name", $name, PDO::PARAM_STR);
             $stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
             $stmt->bindParam(":password", $password, PDO::PARAM_STR);
             $stmt->bindParam(":email", $email, PDO::PARAM_STR);

             try {
                $stmt->execute();
                header("Location: /");
                exit();
            } catch (PDOException $e) {
                $errorMessage = json_encode($e->getMessage());
                echo "
                <script>
                    alert($errorMessage);
                    window.location.href = '/login';
                </script>";
            }
            $stmt = null;
            
        }

    // code

}