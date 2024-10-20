<?php
class ResponsavelController
{
    private $conn;

    public function __construct($conn = null)
    {

        
        require_once '../database/connection.php';
        

        $db = new Database;
        $conn = $db->connect();
        $this->conn = $conn;
    }

    public function create($name, $email, $password, $cpf, $phone)
    {
        $sql = 'INSERT INTO responsavel (name, email, password, cpf, phone) VALUES (:name, :email, :password, :cpf, :phone);';
        $sql .= "INSERT INTO users (email, cpf, user_type) VALUES (:email, :cpf, 'responsavel');";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);

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
}

$crud_type = $_POST['crud_type'];
$professor = new ResponsavelController();

switch ($crud_type) {
    case 'create':
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpf = $_POST['cpf'];
        $phone = $_POST['phone'];

        $professor->create($name, $email, $password, $cpf, $phone);
}
