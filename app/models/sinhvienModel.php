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

    public function create($hoten, $sex, $mssv, $classid) {
        $query = "INSERT INTO tbl_sinhviens (fullname, sex, mssv, classid) VALUES (:HoTen, :GioiTinh, :MSSV, :classid)"; 
        $stmt= $this->conn->prepare($query);
        
        $stmt->bindParam(':HoTen', $hoten);
        $stmt->bindParam(':GioiTinh', $sex);
        $stmt->bindParam(':MSSV', $mssv);
        $stmt->bindParam(':classid', $classid);
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

    // 3. Hàm lấy một sinh viên theo ID
    public function getSinhvienById($id) {
        $query = "SELECT * FROM tbl_sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Hàm cập nhật thông tin sinh viên
    public function update($id, $hoten, $sex, $mssv, $classid) {
        $query = "UPDATE tbl_sinhviens SET fullname = :HoTen, sex = :GioiTinh, mssv = :MSSV, classid = :classid WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':HoTen', $hoten);
        $stmt->bindParam(':GioiTinh', $sex);
        $stmt->bindParam(':MSSV', $mssv);
        $stmt->bindParam(':classid', $classid);
        
        return $stmt->execute();
    }

    // 5. Hàm xóa sinh viên
    public function deleteSinhvien($id) {
        $query = "DELETE FROM tbl_sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // ========== TASK 2: METHODS WITH INNER JOIN ========== //
    
    // Get students with class names using INNER JOIN - by page
    public function getSinhvienWithClassByPage($limit, $offset) {
        $query = "SELECT sv.id, sv.fullname, sv.sex, sv.mssv, sv.classid, lh.classname 
                  FROM tbl_sinhviens sv 
                  LEFT JOIN tbl_lophoc lh ON sv.classid = lh.classid 
                  LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single student with class name using INNER JOIN
    public function getSinhvienWithClassById($id) {
        $query = "SELECT sv.id, sv.fullname, sv.sex, sv.mssv, sv.classid, lh.classname 
                  FROM tbl_sinhviens sv 
                  LEFT JOIN tbl_lophoc lh ON sv.classid = lh.classid 
                  WHERE sv.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ========== FILTER METHODS ========== //
    
    // Get total count with filters
    public function getTotalSinhvienWithFilter($mssv = '', $fullname = '', $classid = '') {
        $query = "SELECT COUNT(*) FROM tbl_sinhviens sv 
              LEFT JOIN tbl_lophoc lh ON sv.classid = lh.classid WHERE 1=1";
        
        if (!empty($mssv)) {
            $query .= " AND sv.mssv LIKE :mssv";
        }
        if (!empty($fullname)) {
            $query .= " AND sv.fullname LIKE :fullname";
        }
        if (!empty($classid)) {
            $query .= " AND sv.classid = :classid";
        }
        
        try {
            $stmt = $this->conn->prepare($query);
            
            if (!empty($mssv)) {
                $stmt->bindValue(':mssv', '%' . $mssv . '%');
            }
            if (!empty($fullname)) {
                $stmt->bindValue(':fullname', '%' . $fullname . '%');
            }
            if (!empty($classid)) {
                $stmt->bindParam(':classid', $classid);
            }
            
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            error_log("Filter query error: " . $e->getMessage());
            return 0;
        }
    }

    // Get filtered students by page
    public function getSinhvienWithClassAndFilter($limit, $offset, $mssv = '', $fullname = '', $classid = '') {
        $query = "SELECT sv.id, sv.fullname, sv.sex, sv.mssv, sv.classid, lh.classname 
              FROM tbl_sinhviens sv 
              LEFT JOIN tbl_lophoc lh ON sv.classid = lh.classid 
              WHERE 1=1";
        
        if (!empty($mssv)) {
            $query .= " AND sv.mssv LIKE :mssv";
        }
        if (!empty($fullname)) {
            $query .= " AND sv.fullname LIKE :fullname";
        }
        if (!empty($classid)) {
            $query .= " AND sv.classid = :classid";
        }
        
        $query .= " ORDER BY sv.id LIMIT :limit OFFSET :offset";
        
        try {
            $stmt = $this->conn->prepare($query);
            
            if (!empty($mssv)) {
                $stmt->bindValue(':mssv', '%' . $mssv . '%');
            }
            if (!empty($fullname)) {
                $stmt->bindValue(':fullname', '%' . $fullname . '%');
            }
            if (!empty($classid)) {
                $stmt->bindParam(':classid', $classid);
            }
            
            $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Filter query error: " . $e->getMessage());
            return [];
        }
    }

}
?>