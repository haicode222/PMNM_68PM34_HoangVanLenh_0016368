<?php
require_once '../app/core/controller.php';

class lophoc extends controller
{
    public function index($page = 1)
    {
        $lophocModel = $this->model('lophocModel');
        
        // --- PAGINATION LOGIC --- //
        $limit = 10; // 10 classes per page
        $page = max(1, intval($page));
        $offset = ($page - 1) * $limit;

        $totalLophoc = $lophocModel->getTotalLophoc();
        $totalPages = ceil($totalLophoc / $limit);

        $lophocs = $lophocModel->getLophocByPage($limit, $offset);
        // --- END PAGINATION --- //
    
        $this->view("layout/masterlayout", [
            'viewname' => 'lophoc/index',
            'lophocs' => $lophocs, 
            'title' => 'Danh sách lớp học',
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function create()
    {
        require_once "../app/view/lophoc/create.php";
    }

    public function store()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $classid = $_POST['classid'];
            $classname = $_POST['classname'];
            $note = $_POST['note'];

            $lophocModel = $this->model('lophocModel');
            $result = $lophocModel->create($classid, $classname, $note);
            
            if ($result) {
                header("Location: /lophoc/index");
                exit();
            } else {
                echo "Thêm mới lớp học thất bại!";
                exit();
            }
        }
    }

    public function edit($id = null)
    {
        if ($id === null) {
            header("Location: /lophoc/index");
            exit();
        }

        $lophocModel = $this->model('lophocModel');
        $lophoc = $lophocModel->getLophocById($id);

        if (!$lophoc) {
            echo "Lớp học không tồn tại!";
            exit();
        }

        $this->view("layout/masterlayout", [
            'viewname' => 'lophoc/edit',
            'lophoc' => $lophoc,
            'title' => 'Chỉnh sửa lớp học'
        ]);
    }

    public function update($id = null)
    {
        if ($id === null || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /lophoc/index");
            exit();
        }

        $classid = $_POST['classid'];
        $classname = $_POST['classname'];
        $note = $_POST['note'];

        $lophocModel = $this->model('lophocModel');
        $result = $lophocModel->update($id, $classid, $classname, $note);

        if ($result) {
            header("Location: /lophoc/index");
            exit();
        } else {
            echo "Cập nhật lớp học thất bại!";
            exit();
        }
    }

    public function delete($id = null)
    {
        if ($id === null) {
            header("Location: /lophoc/index");
            exit();
        }

        $lophocModel = $this->model('lophocModel');
        $result = $lophocModel->deleteLophoc($id);

        if ($result) {
            header("Location: /lophoc/index");
            exit();
        } else {
            echo "Xóa lớp học thất bại!";
            exit();
        }
    }
}
?>
