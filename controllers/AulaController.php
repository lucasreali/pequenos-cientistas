<?php

class AulaController 
{
    private $conn;

    public function __construct()
    {
        require_once '../database/connection.php';

        $db = new Database;
        $conn = $db->connect();
        $this->conn = $conn;
    }    
    
    public function addVideo($url, $description, $title)
    {
        session_start();
        $id = $_SESSION['user_id'];

        if (strpos($url, 'youtu.be') !== false) {
            $video_id = explode("/", parse_url($url, PHP_URL_PATH))[1];
            $url = "https://www.youtube.com/embed/$video_id";
        } else {
            $url = str_replace("watch?v=", "embed/", $url);
        }

        $sql = 'INSERT INTO aula (title, description, create_by) VALUES (:title, :description, :id)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();

            $aula_id = $this->conn->lastInsertId();

            $sql = 'INSERT INTO video (url, aula_id) VALUES (:url, :aula_id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);
            $stmt->bindParam(':aula_id', $aula_id, PDO::PARAM_INT);

            $stmt->execute();

            header('Location: /professor');

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
$aula = new AulaController();

switch ($crud_type) {
    case 'create_aula':
        $url = $_POST['url'];
        $description = $_POST['description'];
        $title = $_POST['title'];

        $aula->addVideo($url, $description, $title);
    }