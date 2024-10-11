<?php
class alunoController
{
    private $conn;
    private $table_name = 'aluno';

    public function __construct($conn)
    {
        session_start();
        $this->conn = $conn;
    }

    public function createAluno($name, $cpf, $email, $password, $date_born, $email_responsavel): void
    {
        $sql = 'SELECT id FROM responsavel WHERE email = :email';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email_responsavel, PDO::PARAM_STR);
        $stmt->execute();

        $responsavel = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_responsavel = $responsavel ? $responsavel['id'] : null;

        if ($id_responsavel === null) {
            echo '<script>alert("Erro: responsável não encontrado");</script>';
            return;
        }

        $sql = 'INSERT INTO ' . $this->table_name . " (name, cpf, email, password, date_born, id_responsavel) 
                VALUES (:name, :cpf, :email, :password, :date_born, :id_responsavel)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(":date_born", $date_born, PDO::PARAM_STR);
        $stmt->bindParam(":id_responsavel", $id_responsavel, PDO::PARAM_INT);

        try {
            $stmt->execute();
            header("Location: /");
            exit();
        } catch (PDOException $e) {
            echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
        }

        $stmt = null;
    }

    public function login($email, $password)
{
    $sql = "SELECT id, email, password FROM " . $this->table_name . " WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    
    try {
        $stmt->execute();
        $info_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($info_user && password_verify($password, $info_user['password'])) {
            $_SESSION['aluno_id'] = $info_user['id'];
            $_SESSION['aluno_email'] = $info_user['email'];

            header("Location: /aluno_page");
            exit();
        } else {
            echo "<script>alert('Email ou senha incorretos');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
    }

    $stmt = null; // Fecha o statement
}

}

// Criação da conexão
require_once '../database/connection.php';
$db = new Database();
$conn = $db->connect();

$crud_type = $_POST['crud_type'];
$aluno = new alunoController($conn);

switch ($crud_type) {
    case 'create':
        $name = $_POST['name'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $date_born = $_POST['dateborn'];
        $email_responsavel = $_POST['emailresponsavel'];


        $aluno->createAluno($name, $cpf, $email, $password, $date_born, $email_responsavel);
        break;
}
