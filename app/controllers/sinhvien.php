<?php
require_once '../app/core/controller.php';

class sinhvien extends controller
{
  // Thêm tham số $page = 1 (Mặc định khi vào link /sinhvien thì sẽ ở trang 1)
  public function index($page = 1)
  {
    $sinhvienModel = $this->model('sinhvienModel');
    
    // --- BẮT ĐẦU XỬ LÝ PHÂN TRANG --- //
    $limit = 10; // Giới hạn 10 sinh viên / trang
    $page = max(1, intval($page)); // Ép kiểu số nguyên, đảm bảo số trang luôn lớn hơn hoặc bằng 1
    $offset = ($page - 1) * $limit; // Công thức tính mốc bắt đầu cắt dữ liệu

    // Lấy tổng số lượng để tính xem có tất cả bao nhiêu trang
    $totalSV = $sinhvienModel->getTotalSinhvien();
    $totalPages = ceil($totalSV / $limit); // ceil() để làm tròn lên (VD: 15sv / 10 = 1.5 -> 2 trang)

    // Lấy đúng 10 sinh viên của trang hiện tại
    $sinhviens = $sinhvienModel->getSinhvienByPage($limit, $offset);  
    // --- KẾT THÚC XỬ LÝ PHÂN TRANG --- //
  
    // Trả về View và đóng gói thêm 2 biến $currentPage, $totalPages sang mảng $data
    $this->view("layout/masterlayout", [
        'viewname' => 'sinhvien/index',
        'sinhviens' => $sinhviens, 
        'title' => 'Danh sách sinh viên',
        'currentPage' => $page,
        'totalPages' => $totalPages
    ]);
  }

  public function create()
  {
    // Trả về View
    require_once "../app/view/sinhvien/create.php";
  }
  public function store()
  {
   if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
     
      $HoTen = $_POST['hoten'];
      $GioiTinh = $_POST['sex'];
       $MSSV = $_POST['mssv'];

      $sinhvienModel = $this->model('sinhvienModel');
      $result = $sinhvienModel->create( $HoTen, $GioiTinh, $MSSV);
      if ($result) {
        header("Location: /sinhvien/index");
        exit();
      } else {
        echo "Thêm mới sinh viên thất bại!";
        exit();
      }
    }
  }
}