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

    public function createDesafio($title, $question, $resp1, $resp2, $resp3, $resp4) {
        session_start();
        $id = $_SESSION['user_id'];

        $sql = "INSERT INTO desafios (title, question, id_teacher) VALUES (:title, :question, :id);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':question', $question, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            
            $desafio_id = $this->conn->lastInsertId();
            $sql = "INSERT (resp_1, resp_2, resp_3, resp_4, desafio_id) INTO VALUES (:resp1, :resp2, :resp3, :resp4, $desafio_id);";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':resp1', $resp1, PDO::PARAM_STR);
            $stmt->bindParam(':resp2', $resp2, PDO::PARAM_STR);
            $stmt->bindParam(':resp3', $resp3, PDO::PARAM_STR);
            $stmt->bindParam(':resp4', $resp4, PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }

    }


    public function addDesafio($title, $question, $resp1, $resp2, $resp3, $resp4) 
    {
        $sql = "INSERT INTO desafios (id_teacher, title, )";
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
        break ;
    
    case 'create_desafio':
        $title = $_POST['title'];
        $question = $_POST['question'];
        $resp1 = $_POST['resp1'];
        $resp2 = $_POST['resp2'];
        $resp3 = $_POST['resp3'];
        $resp4 = $_POST['resp4'];

        $aula->addDesafio($title, $question, $resp1, $resp2, $resp3, $resp4);

}

