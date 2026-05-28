<?php
require_once '../app/core/controller.php';
class sinhvien extends controller
{
  public function index()
  {
    $sinhvienModel = $this->model('sinhvienModel');
    $sinhviens = $sinhvienModel -> getAllSinhvien();  
  
    // Trả về View
    $this->view("sinhvien/index", ['sinhviens' => $sinhviens, 'title' => 'danh sach sinh vien']);
  }

  public function create()
  {
    // Trả về View
    require_once "../app/view/sinhvien/create.php";
  }
}