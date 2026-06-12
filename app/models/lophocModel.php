<?php
require_once '../app/core/DB.php';

class LophocModel {
    private $conn;

    public function __construct(){
        $this->conn = ConnectDB::Connect();
    }

    // Get all classes
    public function getAllLophoc() {
        $query = "SELECT * FROM tbl_lophoc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total count of classes
    public function getTotalLophoc() {
        $query = "SELECT COUNT(*) FROM tbl_lophoc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Get classes by page (pagination)
    public function getLophocByPage($limit, $offset) {
        $query = "SELECT * FROM tbl_lophoc LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a class by ID
    public function getLophocById($id) {
        $query = "SELECT * FROM tbl_lophoc WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new class
    public function create($classid, $classname, $note) {
        $query = "INSERT INTO tbl_lophoc (classid, classname, note) VALUES (:classid, :classname, :note)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':classid', $classid);
        $stmt->bindParam(':classname', $classname);
        $stmt->bindParam(':note', $note);
        
        return $stmt->execute();
    }

    // Update a class
    public function update($id, $classid, $classname, $note) {
        $query = "UPDATE tbl_lophoc SET classid = :classid, classname = :classname, note = :note WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':classid', $classid);
        $stmt->bindParam(':classname', $classname);
        $stmt->bindParam(':note', $note);
        
        return $stmt->execute();
    }

    // Delete a class
    public function deleteLophoc($id) {
        $query = "DELETE FROM tbl_lophoc WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
