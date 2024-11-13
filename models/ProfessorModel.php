<?php
class ProfessorModel
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
        $sql = "SELECT * FROM professor WHERE id=" . $this->user_id; // Corrigido para 'professor'
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

    private function getPermission() {
        $id = $_SESSION['user_id'];

        $sql = "SELECT permission_asingned FROM professor WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);


        try {
            $stmt->execute();
            $permission = $stmt->fetchAll();

            return $permission;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
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
