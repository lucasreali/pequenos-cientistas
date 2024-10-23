<?php
class AlunoModel
{

    private $user_id;
    private $conn;

    public function __construct()
    {

        require_once "database/connection.php";

        $db = new Database();
        $this->conn = $db->connect();

        session_start();
        $this->user_id = $_SESSION['user_id'];
    }

    public function getUser()
    {
        $sql = "SELECT * FROM aluno WHERE id=" . $this->user_id;
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);

            return $info;
        } catch (PDOException $e) {
            $errorMessage = json_encode($e->getMessage());
            echo "
            <script>
                alert($errorMessage);
                window.location.href = '/login';
            </script>";
        }
    }

    public function getUserById($user_id)
    {
        $sql = "SELECT * FROM aluno WHERE id=" . $user_id;
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);

            return $info;
        } catch (PDOException $e) {
            $errorMessage = json_encode($e->getMessage());
            echo "
            <script>
                alert($errorMessage);
                window.location.href = '/';
            </script>";
        }
    }

    public function getAllUsers()
    {
        $sql = "SELECT id FROM users";
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);

            return $info;
        } catch (PDOException $e) {
            $errorMessage = json_encode($e->getMessage());
            echo "
            <script>
                alert($errorMessage);
                window.location.href = '/';
            </script>";
        }

    }
}