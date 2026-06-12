<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <style>
    /* Body and page layout */
    body {
      margin: 0;
      padding: 20px;
      padding-bottom: 150px;
      min-height: 100vh;
    }

    /* Overall table styling */
    .table-blue {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #ffffff;
        box-shadow: 0 4px 15px rgba(173, 216, 230, 0.4);
        border-radius: 8px; 
        overflow: hidden; 
    }

    /* Header row: Light blue background, black bold text */
    .table-blue tr:first-child {
        background-color: #add8e6 !important; 
    }
    .table-blue tr:first-child th {
        color: #000000 !important;
        font-weight: bold !important;
    }

    /* Cell spacing and borders */
    .table-blue th, 
    .table-blue td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0f0ff;
    }

    /* Data rows: normal font weight, transparent background */
    .table-blue tr:not(:first-child) th {
        background-color: transparent !important;
        font-weight: normal !important; 
        color: #333333;
    }

    /* Alternating row colors: white - light blue */
    .table-blue tr:nth-child(even):not(:first-child) th {
        background-color: #f0f8ff !important; 
    }

    /* Hover effect */
    .table-blue tr:not(:first-child):hover th {
        background-color: #d0e8f5 !important;
        cursor: default;
        transition: background-color 0.2s ease-in-out;
    }

    /* Pagination styling */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        margin-bottom: 30px;
        gap: 8px;
    }
    .pagination a {
        padding: 8px 16px;
        text-decoration: none;
        color: #4a4a4a;
        background-color: #ffffff;
        border: 1px solid #add8e6;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    .pagination a:hover {
        background-color: #d0e8f5; 
    }
    .pagination a.active {
        background-color: #add8e6; 
        color: #000000;
        font-weight: bold;
        pointer-events: none; 
    }

    /* Create button */
    .btn-create {
        display: inline-block;
        margin-bottom: 15px;
        margin-right: 10px;
        padding: 10px 20px;
        background-color: #4a90e2;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }
    .btn-create:hover {
        background-color: #2e5cc8;
    }

    /* Action buttons */
    .btn-action {
        padding: 6px 12px;
        margin: 0 4px;
        text-decoration: none;
        border-radius: 4px;
        color: white;
        font-weight: bold;
        transition: 0.3s;
        display: inline-block;
    }

    .btn-edit {
        background-color: #f39c12;
    }
    .btn-edit:hover {
        background-color: #e67e22;
    }

    .btn-delete {
        background-color: #e74c3c;
    }
    .btn-delete:hover {
        background-color: #c0392b;
    }

    h1 {
        color: #4a90e2;
        margin-bottom: 20px;
    }

    /* Navigation buttons */
    .btn-nav {
        display: inline-block;
        padding: 10px 20px;
        margin-top: 15px;
        margin-right: 10px;
        background-color: #2196F3;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-nav:hover {
        background-color: #0b7dda;
    }
  </style>
</head>

<body>
  <div style="padding: 20px;">
    <h1><?php echo $title; ?></h1>
    
    <a href="/lophoc/create" class="btn-create">+ Thêm lớp học</a>

    <table class="table-blue">
      <tr>
        <th>ID</th>
        <th>Mã lớp</th>
        <th>Tên lớp</th>
        <th>Ghi chú</th>
        <th>Hành động</th>
      </tr>
      <?php foreach ($lophocs as $lophoc): ?>
      <tr>
        <th><?php echo htmlspecialchars($lophoc['id']); ?></th>
        <th><?php echo htmlspecialchars($lophoc['classid']); ?></th>
        <th><?php echo htmlspecialchars($lophoc['classname']); ?></th>
        <th><?php echo htmlspecialchars($lophoc['note']); ?></th>
        <th>
          <a href="/lophoc/edit/<?php echo $lophoc['id']; ?>" class="btn-action btn-edit">Sửa</a>
          <a href="/lophoc/delete/<?php echo $lophoc['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
        </th>
      </tr>
      <?php endforeach; ?>
    </table>

    <!-- Pagination -->
    <div class="pagination">
      <?php if ($currentPage > 1): ?>
        <a href="/lophoc/index/1">Đầu</a>
        <a href="/lophoc/index/<?php echo $currentPage - 1; ?>">Trước</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == $currentPage): ?>
          <a href="#" class="active"><?php echo $i; ?></a>
        <?php else: ?>
          <a href="/lophoc/index/<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if ($currentPage < $totalPages): ?>
        <a href="/lophoc/index/<?php echo $currentPage + 1; ?>">Tiếp</a>
        <a href="/lophoc/index/<?php echo $totalPages; ?>">Cuối</a>
      <?php endif; ?>
    </div>
  </div>
  <a href="/sinhvien/index" class="btn-nav">👥 Danh sách sinh viên</a>
</body>

</html>
