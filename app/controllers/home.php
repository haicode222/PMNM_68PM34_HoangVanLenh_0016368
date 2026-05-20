<?php
class home
{
  public function index()
  {
    require_once '../app/view/home/index.php';
  }
  public function login()
  {
    require_once "../app/view/home/login.php";
  }
}