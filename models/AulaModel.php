<?php
class AulaModel
{
    private $user_id;
    private $conn;

    public function __construct()
    {
        require_once "database/connection.php";

        $db = new Database();
        $this->conn = $db->connect();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->user_id = $_SESSION['user_id'];
    }

    public function getAulas() 
    {
        $sql = "SELECT * FROM vw_video_aula;";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $aulas;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return [];
        }
    }

    public function getDesafios() 
    {
        $sql = "SELECT * FROM desafios;";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $desafios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $desafios;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return [];
        }
    }

    public function getDesafioById($id) 
    {
        $sql = "SELECT * FROM desafios WHERE id = :id;";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $desafio = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $desafio;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return [];
        }
    }

    public function getQuestions($id)
    {
        $sql = "SELECT * FROM question WHERE desafio_id = :id;";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $question = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $question;
        } catch (PDOException $e) {
            error_log("Erro ao buscar questões: " . $e->getMessage());
        }
    }

}
