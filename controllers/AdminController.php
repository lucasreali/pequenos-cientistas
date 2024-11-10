<?php

class AdminController
{
    private $conn;

    public function __construct($conn = null)
    {

        
        require_once '../database/connection.php';


        $db = new Database;
        $conn = $db->connect();
        $this->conn = $conn;
    }

    public function aproveProfessor($id)
    {
        $sql = "UPDATE professor SET permission=1, permission_assigned=1 WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            header("Location: /admin");
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }
    public function blockProfessor($id)
    {
        $sql = "UPDATE professor SET permission=0, permission_assigned=1 WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            header("Location: /admin");
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

$crud_type = $_POST['crud_type'];

if (isset($crud_type)) {

    $admin = new AdminController();

    switch ($crud_type) {
        case 'aprove':
            $id = $_POST['id'];
            $admin->aproveProfessor($id);
            break;
        case 'block':
            $id = $_POST['id'];
            $admin->blockProfessor($id);
            break;
    }
}