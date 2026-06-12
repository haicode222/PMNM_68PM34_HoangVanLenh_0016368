<?php
require_once '../app/core/controller.php';

class sinhvien extends controller
{
  // Thêm tham số $page = 1 (Mặc định khi vào link /sinhvien thì sẽ ở trang 1)
  public function index($page = 1)
  {
    $sinhvienModel = $this->model('sinhvienModel');
    $lophocModel = $this->model('lophocModel');
    
    // Get filter parameters from GET
    $mssv = isset($_GET['mssv']) ? trim($_GET['mssv']) : '';
    $fullname = isset($_GET['fullname']) ? trim($_GET['fullname']) : '';
    $classid = isset($_GET['classid']) ? trim($_GET['classid']) : '';
    // Sort parameter: values: mssv_asc, mssv_desc, name_asc, name_desc
    $sort = isset($_GET['sort']) ? trim($_GET['sort']) : '';
    
    // Load all lophocs for dropdown
    $lophocs = $lophocModel->getAllLophoc();
    
    // --- BẮT ĐẦU XỬ LÝ PHÂN TRANG --- //
    $limit = 10; // Giới hạn 10 sinh viên / trang
    $page = max(1, intval($page)); // Ép kiểu số nguyên, đảm bảo số trang luôn lớn hơn hoặc bằng 1
    $offset = ($page - 1) * $limit; // Công thức tính mốc bắt đầu cắt dữ liệu

    // Lấy tổng số lượng với filter
    $totalSV = $sinhvienModel->getTotalSinhvienWithFilter($mssv, $fullname, $classid);
    $totalPages = ceil($totalSV / $limit); // ceil() để làm tròn lên (VD: 15sv / 10 = 1.5 -> 2 trang)

    // Lấy đúng 10 sinh viên của trang hiện tại (WITH CLASS NAMES via LEFT JOIN + FILTER + SORT)
    $sinhviens = $sinhvienModel->getSinhvienWithClassAndFilter($limit, $offset, $mssv, $fullname, $classid, $sort);  
    // --- KẾT THÚC XỬ LÝ PHÂN TRANG --- //
  
    // Trả về View và đóng gói thêm 2 biến $currentPage, $totalPages sang mảng $data
    $this->view("layout/masterlayout", [
        'viewname' => 'sinhvien/index',
        'sinhviens' => $sinhviens, 
        'lophocs' => $lophocs,
        'title' => 'Danh sách sinh viên',
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'mssv' => $mssv,
        'fullname' => $fullname,
        'classid' => $classid,
        'sort' => $sort
    ]);
  }

  public function create()
  {
    // Load danh sách lớp học
    $lophocModel = $this->model('lophocModel');
    $lophocs = $lophocModel->getAllLophoc();
    
    $this->view("layout/masterlayout", [
        'viewname' => 'sinhvien/create',
        'lophocs' => $lophocs,
        'title' => 'Thêm sinh viên'
    ]);
  }
  public function store()
  {
   if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
     
      $HoTen = $_POST['hoten'];
      $GioiTinh = $_POST['sex'];
      $MSSV = $_POST['mssv'];
      $ClassID = $_POST['classid'];

      $sinhvienModel = $this->model('sinhvienModel');
      $result = $sinhvienModel->create( $HoTen, $GioiTinh, $MSSV, $ClassID);
      if ($result) {
        header("Location: /sinhvien/index");
        exit();
      } else {
        echo "Thêm mới sinh viên thất bại!";
        exit();
      }
    }
  }

  public function edit($id = null)
  {
    if ($id === null) {
      header("Location: /sinhvien/index");
      exit();
    }

    $sinhvienModel = $this->model('sinhvienModel');
    $sinhvien = $sinhvienModel->getSinhvienById($id);

    if (!$sinhvien) {
      echo "Sinh viên không tồn tại!";
      exit();
    }

    // Load danh sách lớp học
    $lophocModel = $this->model('lophocModel');
    $lophocs = $lophocModel->getAllLophoc();

    $this->view("layout/masterlayout", [
        'viewname' => 'sinhvien/edit',
        'sinhvien' => $sinhvien,
        'lophocs' => $lophocs,
        'title' => 'Chỉnh sửa sinh viên'
    ]);
  }

  public function update($id = null)
  {
    if ($id === null || $_SERVER['REQUEST_METHOD'] !== 'POST') {
      header("Location: /sinhvien/index");
      exit();
    }

    $HoTen = $_POST['hoten'];
    $GioiTinh = $_POST['sex'];
    $MSSV = $_POST['mssv'];
    $ClassID = $_POST['classid'];

    $sinhvienModel = $this->model('sinhvienModel');
    $result = $sinhvienModel->update($id, $HoTen, $GioiTinh, $MSSV, $ClassID);

    if ($result) {
      header("Location: /sinhvien/index");
      exit();
    } else {
      echo "Cập nhật sinh viên thất bại!";
      exit();
    }
  }

  public function delete($id = null)
  {
    if ($id === null) {
      header("Location: /sinhvien/index");
      exit();
    }

    $sinhvienModel = $this->model('sinhvienModel');
    $result = $sinhvienModel->deleteSinhvien($id);

    if ($result) {
      header("Location: /sinhvien/index");
      exit();
    } else {
      echo "Xóa sinh viên thất bại!";
      exit();
    }
  }
}