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

    public function newAdmin($name, $email, $password)
    {
        
        session_start();
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO admin (name, email, password, created_by) VALUES (:name, :email, :password, :created_by);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(':created_by', $user_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            header("Location: /newadmin");
            exit();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
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
        case 'new_admin':
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $admin->newAdmin($name, $email, $password);
    }
}