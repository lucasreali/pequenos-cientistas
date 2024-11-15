<?php

class ResponsavelModel
{
    private $user_id;
    private $conn;

    public function __construct()
    {
        require_once "database/connection.php";

        $db = new Database();
        $this->conn = $db->connect();

        $this->user_id = $_SESSION['user_id'];
    }

    public function getUser()
    {
        $sql = 'SELECT * FROM responsavel WHERE id=' . $this->user_id;
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            return $info;
        } catch (PDOException $e) {
            $errorMessage = json_encode($e->getMessage());
            $redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/login';
            echo "
            <script>
                alert($errorMessage);
                window.location.href = '$redirectUrl';
            </script>";
        }
    }

    public function getUserById($user_id)
    {
        $sql = "SELECT * FROM responsavel WHERE id=" . $user_id;
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            return $info;
        } catch (PDOException $e) {
            $errorMessage = json_encode($e->getMessage());
            $redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/login';
            echo "
            <script>
                alert($errorMessage);
                window.location.href = '$redirectUrl';
            </script>";
        }
    }

    public function getDependentes()
    {
        $sql = "SELECT * FROM aluno WHERE id_responsavel=" . $this->user_id;
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute();
            $dependentes = $stmt->fetch(PDO::FETCH_ASSOC);
            return $dependentes;
        } catch (PDOException $e) {
            $errorMessage = json_encode($e->getMessage());
            $redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/login';
            echo "
            <script>
                alert($errorMessage);
                window.location.href = '$redirectUrl';
            </script>";
        }
    }
}
