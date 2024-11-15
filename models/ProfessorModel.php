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
            $this->handleError($e);
        }
    }

    public function getPermission()
{
    $id = $this->user_id;

    $sql = "SELECT permission_assigned, permission FROM professor WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    try {
        $stmt->execute();
        $permission = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($permission['permission_assigned'] == false) {
            echo "
                <script>
                    alert('Sua permissão ainda não foi atribuída, aguarde os administradores confirmá-la');
                    window.location.href = '/';
                </script>
            ";

            return false;
        } else if ($permission['permission_assigned'] == true && $permission['permission'] == false) {
            echo "
                <script>
                    alert('Lamentamos, mas sua permissão não pode ser aprovada');
                    window.location.href = '/';
                </script>
            ";
            return false;
        }

        return true;
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
