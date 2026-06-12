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

    h1 {
      color: #ff4d94;
      margin-bottom: 20px;
    }

    /* Tổng thể bảng */
.table-pink {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #ffffff;
    box-shadow: 0 4px 15px rgba(255, 182, 193, 0.4);
    border-radius: 8px; 
    overflow: hidden; 
}

/* KHOANH VÙNG HÀNG 1: Nền hồng, chữ đen đậm */
.table-pink tr:first-child {
    background-color: #ffb6c1 !important; 
}
.table-pink tr:first-child th {
    color: #000000 !important;
    font-weight: bold !important;
}

/* Khoảng cách ô và kẻ chỉ mỏng */
.table-pink th, 
.table-pink td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ffe4e1;
}

/* CÁC HÀNG DỮ LIỆU BÊN DƯỚI: Chữ mỏng bình thường, xóa nền hồng dư thừa */
.table-pink tr:not(:first-child) th {
    background-color: transparent !important;
    font-weight: normal !important; 
    color: #333333;
}

/* Hiệu ứng vằn (dòng trắng - dòng hồng nhạt) */
.table-pink tr:nth-child(even):not(:first-child) th {
    background-color: #fff0f5 !important; 
}

/* Hiệu ứng lướt chuột */
.table-pink tr:not(:first-child):hover th {
    background-color: #ffdde1 !important;
    cursor: default;
    transition: background-color 0.2s ease-in-out;
}
/* Pagination CSS */
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
    border: 1px solid #ffb6c1;
    border-radius: 6px;
    transition: all 0.2s ease;
}
.pagination a:hover {
    background-color: #ffdde1; /* Đổi màu khi lướt chuột */
}
.pagination a.active {
    background-color: #ffb6c1; /* Màu nổi bật cho trang hiện tại */
    color: #000000;
    font-weight: bold;
    pointer-events: none; /* Khóa nút trang hiện tại, không cho click lại */
}
.btn-create {
    display: inline-block;
    margin-bottom: 15px;
    margin-right: 10px;
    padding: 10px 20px;
    background-color: #ff4d94;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    transition: background-color 0.3s ease;
}
.btn-create:hover {
    background-color: #ff1493;
}

/* Action Buttons Styling */
.btn-action {
    padding: 6px 12px;
    margin: 0 4px;
    text-decoration: none;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.2s ease;
    display: inline-block;
}

.btn-edit {
    background-color: #4CAF50;
    color: white;
}

.btn-edit:hover {
    background-color: #45a049;
}

.btn-delete {
    background-color: #f44336;
    color: white;
}

.btn-delete:hover {
    background-color: #da190b;
}

/* Actions column styling */
.actions-column {
    text-align: center;
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

/* Filter Form Styling */
.filter-form {
    background-color: #fff5f9;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 2px solid #ffb6c1;
}

.filter-form form {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}

.filter-form .form-group {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-width: 200px;
}

.filter-form label {
    margin-bottom: 5px;
    color: #cc0066;
    font-weight: bold;
    font-size: 14px;
}

.filter-form input[type="text"],
.filter-form select {
    padding: 8px 10px;
    border: 1px solid #ffb3d9;
    border-radius: 5px;
    font-size: 14px;
    font-family: Arial, sans-serif;
}

.filter-form input[type="text"]:focus,
.filter-form select:focus {
    outline: none;
    border-color: #ff4d94;
    box-shadow: 0 0 5px rgba(255, 77, 148, 0.3);
}

.filter-form .btn-group {
    display: flex;
    gap: 8px;
    align-self: flex-end;
}

.filter-form button {
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    font-size: 14px;
    transition: 0.3s;
}

.filter-form .btn-search {
    background-color: #ff4d94;
    color: white;
}

.filter-form .btn-search:hover {
    background-color: #ff1493;
}

.filter-form .btn-clear {
    background-color: #999;
    color: white;
}

.filter-form .btn-clear:hover {
    background-color: #666;
}
  </style>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <h1><?php echo $title; ?></h1>
  
  <!-- Filter Form -->
  <div class="filter-form">
    <form method="GET" action="/sinhvien/index/1">
      <div class="form-group">
        <label for="mssv">Tìm kiếm MSSV:</label>
        <input type="text" id="mssv" name="mssv" value="<?php echo htmlspecialchars($mssv); ?>" placeholder="Nhập MSSV...">
      </div>
      
      <div class="form-group">
        <label for="fullname">Tìm kiếm Tên:</label>
        <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" placeholder="Nhập tên sinh viên...">
      </div>
      
      <div class="form-group">
        <label for="classid">Lọc theo lớp:</label>
        <select id="classid" name="classid">
          <option value="">-- Tất cả lớp --</option>
          <?php if (!empty($lophocs)): ?>
            <?php foreach ($lophocs as $lophoc): ?>
              <option value="<?php echo htmlspecialchars($lophoc['classid']); ?>" <?php echo ($classid === $lophoc['classid']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($lophoc['classname']); ?>
              </option>
            <?php endforeach; ?>
          <?php else: ?>
            <option value="">Không có lớp học</option>
          <?php endif; ?>
        </select>
      </div>
      
      <div class="form-group">
        <label for="pageSize">Số bản ghi / trang:</label>
        <input type="number" id="pageSize" name="pageSize" min="1" max="100" value="<?php echo isset($pageSize) ? htmlspecialchars($pageSize) : 10; ?>" />
      </div>
      
      <div class="form-group">
        <label for="sort">Sắp xếp</label>
        <select id="sort" name="sort">
          <option value="">-- Mặc định --</option>
          <option value="mssv_asc" <?php echo (isset($sort) && $sort === 'mssv_asc') ? 'selected' : ''; ?>>MSSV ↑ (số chữ số ↑, giá trị ↑)</option>
          <option value="mssv_desc" <?php echo (isset($sort) && $sort === 'mssv_desc') ? 'selected' : ''; ?>>MSSV ↓ (số chữ số ↓, giá trị ↓)</option>
          <option value="name_asc" <?php echo (isset($sort) && $sort === 'name_asc') ? 'selected' : ''; ?>>Tên ↑ (từ cuối A→Z)</option>
          <option value="name_desc" <?php echo (isset($sort) && $sort === 'name_desc') ? 'selected' : ''; ?>>Tên ↓ (từ cuối Z→A)</option>
        </select>
      </div>
      
      <div class="btn-group">
        <button type="submit" class="btn-search">🔍 Tìm kiếm</button>
        <a href="/sinhvien/index/1" class="btn-clear" style="padding: 8px 16px; border-radius: 5px; text-decoration: none; text-align: center;">✕ Xóa bộ lọc</a>
      </div>
    </form>
  </div>
  
  <table class="table-pink">
    <tr>
      <th>STT</th>
      <th>Tên</th>
      <th>Giới tính</th>
      <th>MSSV</th>
      <th>Tên lớp</th>
      <th class="actions-column">Hành động</th>
    </tr>
    <?php 
      $pageSize = isset($pageSize) ? (int)$pageSize : 10;
      $currentPage = isset($currentPage) ? (int)$currentPage : 1;
      $startIndex = ($currentPage - 1) * $pageSize;
    ?>
    <?php foreach ($sinhviens as $index => $sinhvien): ?>
      <tr>
        <th><?php echo $startIndex + $index + 1; ?></th>
        <th><?php echo htmlspecialchars($sinhvien['fullname']); ?></th>
        <th><?php echo htmlspecialchars($sinhvien['sex']); ?></th>
        <th><?php echo htmlspecialchars($sinhvien['mssv']); ?></th>
        <th><?php echo htmlspecialchars($sinhvien['classname']); ?></th>
        <th class="actions-column">
          <a href="/sinhvien/edit/<?php echo $sinhvien['id']; ?>" class="btn-action btn-edit">Sửa</a>
          <a href="/sinhvien/delete/<?php echo $sinhvien['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xóa</a>
        </th>
      </tr>
      <?php endforeach; ?>
  </table>
  <div class="pagination">
    <?php 
      // Build query string to preserve filters during pagination
      $queryParams = [];
      if (!empty($mssv)) $queryParams[] = 'mssv=' . urlencode($mssv);
      if (!empty($fullname)) $queryParams[] = 'fullname=' . urlencode($fullname);
      if (!empty($classid)) $queryParams[] = 'classid=' . urlencode($classid);
      if (!empty($sort)) $queryParams[] = 'sort=' . urlencode($sort);
      if (!empty($pageSize)) $queryParams[] = 'pageSize=' . urlencode($pageSize);
      $queryString = !empty($queryParams) ? '?' . implode('&', $queryParams) : '';
    ?>
    <?php if ($currentPage > 1): ?>
        <a href="/sinhvien/index/<?php echo $currentPage - 1; ?><?php echo $queryString; ?>">&laquo; Trước</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="/sinhvien/index/<?php echo $i; ?><?php echo $queryString; ?>" class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
        <a href="/sinhvien/index/<?php echo $currentPage + 1; ?><?php echo $queryString; ?>">Sau &raquo;</a>
    <?php endif; ?>
</div>
<a href="/sinhvien/create" class="btn-create">Thêm Sinh Viên</a>
<a href="/lophoc/index" class="btn-nav">📚 Danh sách lớp học</a>

</body>

</html>