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
        $sql = "SELECT id, email, password, user_type FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
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
        } catch (PDOException $e) {
            echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
        }

        $stmt = null; 
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login.php");
        exit();
    }
}
