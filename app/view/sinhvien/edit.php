<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chỉnh sửa sinh viên</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: #ffe6f0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      background: white;
      padding: 30px;
      width: 400px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
    }

    h1 {
      text-align: center;
      color: #ff4d94;
      margin-bottom: 25px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 5px;
      color: #cc0066;
      font-weight: bold;
    }

    input[type="text"] {
      padding: 10px;
      margin-bottom: 15px;
      border: 2px solid #ffb3d9;
      border-radius: 8px;
      outline: none;
      transition: 0.3s;
    }

    input[type="text"]:focus {
      border-color: #ff4d94;
      box-shadow: 0 0 8px rgba(255, 77, 148, 0.3);
    }

    .button-group {
      display: flex;
      gap: 10px;
      margin-top: 15px;
    }

    input[type="submit"],
    .btn-cancel {
      flex: 1;
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: 0.3s;
      border: none;
      text-decoration: none;
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    input[type="submit"] {
      background: #ff4d94;
      color: white;
    }

    input[type="submit"]:hover {
      background: #e60073;
    }

    .btn-cancel {
      background: #999;
      color: white;
    }

    .btn-cancel:hover {
      background: #666;
    }
  </style>
</head>

<body>
  <div class="container">
      <h1>Chỉnh sửa sinh viên</h1>
      <form action="/sinhvien/update/<?php echo $sinhvien['id']; ?>" method="post">
        <label for="hoten">Họ tên</label>
        <input type="text" name="hoten" id="hoten" value="<?php echo htmlspecialchars($sinhvien['fullname']); ?>" required>
        
        <label for="sex">Giới tính</label>
        <input type="text" name="sex" id="sex" value="<?php echo htmlspecialchars($sinhvien['sex']); ?>" required>
        
        <label for="mssv">MSSV</label>
        <input type="text" name="mssv" id="mssv" value="<?php echo htmlspecialchars($sinhvien['mssv']); ?>" required>
    
        <div class="button-group">
          <input type="submit" value="Cập nhật">
          <a href="/sinhvien/index" class="btn-cancel">Hủy</a>
        </div>
      </form>
  </div>
</body>

</html>
