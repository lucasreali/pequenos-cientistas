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

        session_start();
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
    
}
