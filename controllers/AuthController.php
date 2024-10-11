<?php
class AuthController
{
    private $conn;

    public function __construct($conn)
    {
        session_start();
        $this->conn = $conn;
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT email, user_type FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $user_table = $user['user_type'];
                $sql = "SELECT email, password, id FROM " . $user_table . " WHERE email = :email";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                $stmt->execute();
                $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user_data && password_verify($password, $user_data['password'])) {

                    $_SESSION['user_id'] = $user_data['id'];
                    $_SESSION['user_type'] = $user['user_type'];

                    switch ($user['user_type']) {
                        case 'professor':
                            header("Location: /professor_page");
                            break;
                        case 'aluno':
                            header("Location: /aluno_page");
                            break;
                        case 'responsavel':
                            header("Location: /responsavel_page");
                            break;
                        case 'admin':
                            header("Location: /admin_page");
                            break;
                    }
                    exit();
                } else {
                    echo "<script>alert('Email ou senha incorretos');</script>";
                }
            } else {
                echo "<script>alert('Usuário não encontrado');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login.php");
        exit();
    }
}

require_once '../database/connection.php';
$db = new Database();
$conn = $db->connect();

$case = $_POST['case'];
$authcontroller = new AuthController($conn);

switch ($case) {
    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];

        $authcontroller->login($email, $password); // Passando a variável correta
        break;
    case 'logout':
        $authcontroller->logout();
        break;
}
?>
