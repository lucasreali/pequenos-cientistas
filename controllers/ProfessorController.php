<?php

class ProfessorController
{
    private $conn;

    public function __construct()
    {
        require_once '../database/connection.php';

        $db = new Database;
        $conn = $db->connect();
        $this->conn = $conn;
    }


    public function create($name, $email, $password, $cpf, $subject)
    {
        $sql = 'INSERT INTO professor (name, cpf, email, password, subject) VALUES (:name, :cpf, :email, :password, :subject);';
        $sql .= "INSERT INTO users (email, cpf, user_type) VALUES (:email, :cpf, 'professor')";



        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":subject", $subject, PDO::PARAM_STR);

        try {
            $stmt->execute();
            header("Location: /login");
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
        exit();
    }


    private function handleError($e)
    {
        $errorMessage = json_encode($e->getMessage());
        $redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/login';

        echo "
        <script>
            alert($errorMessage);
            window.location.href = '$redirectUrl';
        </script>";
        exit;
    }
}

$crud_type = $_POST['crud_type'];
$professor = new ProfessorController();

switch ($crud_type) {
    case 'create':
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpf = $_POST['cpf'];
        $subject = 'biologia';

        $professor->create($name, $email, $password, $cpf, $subject);
        return;
        
}