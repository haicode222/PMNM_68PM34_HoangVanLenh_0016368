<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>-----</title>
  <style>
    *{
        margin: 0;
        padding: 0;
    }

    .content{
        width: 60%;
        margin: 0 auto;
        
    }
  </style>
</head>

<body>
    <div>
        <?php require_once '../app/view/layout/partial/header.php'; ?>
    </div>
    <div class="content">
        <?php
            // if (isset($data['sinhviens'])) {
                require_once '../app/view/' .$viewname . '.php';
            // } else {
            //     // Nếu không có dữ liệu sinh viên, bạn có thể hiển thị một thông báo hoặc nội dung mặc định
            //     echo "<h2>Chào mừng đến với trang quản lý sinh viên!</h2>";
            // }
        ?>
    </div>
    <div>
        <?php require_once '../app/view/layout/partial/footer.php'; ?>
    </div>
    
</body>
</html>