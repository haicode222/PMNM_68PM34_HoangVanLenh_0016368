<?php
class sinhvien
{
  public function index()
  {
    // Trả về View
    require_once "../app/view/sinhvien/index.php";
  }

  public function create()
  {
    // Trả về View
    require_once "../app/view/sinhvien/create.php";
  }
}