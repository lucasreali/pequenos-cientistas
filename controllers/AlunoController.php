<?php
class AlunoController
{
    private $conn;

    public function __construct($conn = null)
    {

        
        require_once '../database/connection.php';


        $db = new Database;
        $conn = $db->connect();
        $this->conn = $conn;
    }

    public function create($name, $cpf, $email, $password, $date_born, $email_responsavel): void
    {
        $sql = 'SELECT id FROM responsavel WHERE email = :email';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email_responsavel, PDO::PARAM_STR);
        $stmt->execute();

        $responsavel = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_responsavel = $responsavel ? $responsavel['id'] : null;

        if ($id_responsavel === null) {
            echo '
            <script>
                alert("Erro: responsável não encontrado");
                window.location.href = "/login";
            </script>';
            return;
        }

        $sql = "INSERT INTO aluno (name, cpf, email, password, date_born, id_responsavel) 
                VALUES (:name, :cpf, :email, :password, :date_born, :id_responsavel);";

        // $sql .= "INSERT INTO users (email, cpf, user_type) VALUES (:email, :cpf, 'aluno')";

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
            $errorMessage = json_encode($e->getMessage());
            echo "
            <script>
                alert($errorMessage);
                window.location.href = '/login';
            </script>";
        }


        $stmt = null;
    }

    

    public function delete($id)
    {

    }

    public function update($id, $data)
    {

    }

}

$crud_type = $_POST['crud_type'];

if (isset($crud_type)) {

    $aluno = new AlunoController();

    switch ($crud_type) {
        case 'create':
            $name = $_POST['name'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $date_born = $_POST['dateborn'];
            $email_responsavel = $_POST['emailresponsavel'];

            $aluno->create($name, $cpf, $email, $password, $date_born, $email_responsavel);
            break;

        case 'login':

    }
}