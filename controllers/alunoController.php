<?php
class alunoController {
    private $conn;
    private $table_name = 'aluno';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createAluno($name, $cpf, $email, $password, $date_born):void {
        $sql = 'INSERT INTO ' . $this->table_name . " (name, cpf, email, password, date_born) VALUES (:name, :cpf, :email, :password, :date_born)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(":date_born", $date_born);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "<script>alert('Erro: " . $e->getMessage() . ");</script>";
        }

        $stmt = null;
        header("Location: /");
    }
}

$crud_type = $_POST['crud_type'];
$conn = new Database();
$aluno = new alunoController($conn);


switch ($crud_type)
{
    case 'create':

        $name = $_POST['name'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $date_born = $_POST['date_born'];

        $aluno->createAluno($name, $cpf, $email, $password, $date_born);
        break;
    
}