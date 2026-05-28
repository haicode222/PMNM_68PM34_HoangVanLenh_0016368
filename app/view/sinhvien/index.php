<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <style>
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
  </style>
</head>

<body>
  <h1><?php echo $title; ?></h1>
  <table class="table-pink">
    <tr>
      <th>STT</th>
      <th>Ten</th>
      <th>gioi tinh</th>
      <th>msv</th>
    </tr>
    <?php foreach ($sinhviens as $index => $sinhvien): ?>
      <tr>
        <th><?php echo $index +1; ?></th>
        <th><?php echo $sinhvien['fullname']; ?></th>
        <th><?php echo $sinhvien['sex']; ?></th>
        <th><?php echo $sinhvien['mssv']; ?></th>
      </tr>
      <?php endforeach; ?>
  </table>
</body>

</html>