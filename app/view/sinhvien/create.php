<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tạo sinh viên</title>
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

    input[type="text"],
    select {
      padding: 10px;
      margin-bottom: 15px;
      border: 2px solid #ffb3d9;
      border-radius: 8px;
      outline: none;
      transition: 0.3s;
      font-family: Arial, sans-serif;
    }

    input[type="text"]:focus,
    select:focus {
      border-color: #ff4d94;
      box-shadow: 0 0 8px rgba(255, 77, 148, 0.3);
    }

    input[type="submit"] {
      background: #ff4d94;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: 0.3s;
    }

    input[type="submit"]:hover {
      background: #e60073;
    }

    .back-link {
      text-align: center;
      margin-top: 15px;
    }

    .back-link a {
      color: #ff4d94;
      text-decoration: none;
      font-weight: bold;
    }

    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="container">
      <h1>Tạo sinh viên</h1>
      <form action="/sinhvien/store" method="post">
        <label for="hoten">Họ tên</label>
        <input type="text" name="hoten" id="hoten" required>
        
        <label for="sex">Giới tính</label>
        <input type="text" name="sex" id="sex" required>
        
        <label for="mssv">MSSV</label>
        <input type="text" name="mssv" id="mssv" required>

        <label for="classid">Lớp học</label>
        <select name="classid" id="classid" required>
          <option value="">-- Chọn lớp học --</option>
          <?php foreach ($lophocs as $lophoc): ?>
            <option value="<?php echo htmlspecialchars($lophoc['classid']); ?>">
              <?php echo htmlspecialchars($lophoc['classname']); ?>
            </option>
          <?php endforeach; ?>
        </select>
    
        <input type="submit" value="Tạo">

        <div class="back-link">
          <a href="/sinhvien/index">Quay lại danh sách</a>
        </div>
      </form>
  </div>
</body>

</html>