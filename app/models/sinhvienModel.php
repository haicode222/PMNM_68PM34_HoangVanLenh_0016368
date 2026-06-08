<?php
require_once '../app/core/DB.php';

class SinhvienModel {
    private $conn;

    public function __construct(){
        $this->conn = ConnectDB::Connect();
    }

    // Hàm cũ (Bạn có thể giữ lại để dùng cho chức năng khác nếu cần)
    public function getAllSinhvien() {
        $query = "SELECT * FROM tbl_sinhviens";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($hoten, $sex, $mssv) {
        $query = "INSERT INTO tbl_sinhviens (fullname, sex, mssv) VALUES (:HoTen, :GioiTinh, :MSSV)"; 
        $stmt= $this->conn->prepare($query);
        
        $stmt->bindParam(':HoTen', $hoten);
        $stmt->bindParam(':GioiTinh', $sex);
        $stmt->bindParam(':MSSV', $mssv);
        if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }

    }

    

    // 1. Hàm đếm ng số lượng sinh viên trong bảng
    public function getTotalSinhvien() {
        $query = "SELECT COUNT(*) FROM tbl_sinhviens";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // fetchColumn() lấy ra con số đếm được ở cột đầu tiên
        return $stmt->fetchColumn(); 
    }

    // 2. Hàm lấy sinh viên theo trang (giới hạn số lượng)
    public function getSinhvienByPage($limit, $offset) {
        $query = "SELECT * FROM tbl_sinhviens LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        
        // CỰC KỲ QUAN TRỌNG: Phải ép kiểu về PDO::PARAM_INT
        // Nếu không có bước này, PDO sẽ hiểu nhầm $limit là chuỗi (string) và gây lỗi truy vấn
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>