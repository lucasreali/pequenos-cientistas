<?php
class AuthController
{
    private $conn;

    public function __construct()
    {
        session_start();
        
        require_once '../database/connection.php';
        $db = new Database;
        $this->conn = $db->connect(); // Corrigido
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
                            header("Location: /professor");
                            break;
                        case 'aluno':
                            header("Location: /aluno");
                            break;
                        case 'responsavel':
                            header("Location: /responsavel");
                            break;
                        case 'admin':
                            header("Location: /admin");
                            break;
                    }
                    exit();
                } else {
                    echo "<script>alert('Email ou senha incorretos');</script>";
                }
            } else {
                echo "
                <script>
                    alert('Usuário não encontrado');
                    window.location.href = '/login';
                </script>";
            }
        } catch (PDOException $e) {
            echo "
            <script>
                alert('Erro: " . $e->getMessage() . "');
                window.location.href = '/login';
            </script>";
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
        exit();
    }
}

$case = $_POST['case'];
$authcontroller = new AuthController();

switch ($case) {
    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];

        $authcontroller->login($email, $password);
        break;
    case 'logout':
        $authcontroller->logout();
        break;
}
