<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tạo lớp học</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: #e0f0ff;
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
      box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
    }

    h1 {
      text-align: center;
      color: #4a90e2;
      margin-bottom: 25px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 5px;
      color: #2e5cc8;
      font-weight: bold;
    }

    input[type="text"],
    textarea {
      padding: 10px;
      margin-bottom: 15px;
      border: 2px solid #add8e6;
      border-radius: 8px;
      outline: none;
      transition: 0.3s;
      font-family: Arial, sans-serif;
    }

    input[type="text"]:focus,
    textarea:focus {
      border-color: #4a90e2;
      box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    input[type="submit"] {
      background: #4a90e2;
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
      background: #2e5cc8;
    }

    .back-link {
      text-align: center;
      margin-top: 15px;
    }

    .back-link a {
      color: #4a90e2;
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
      <h1>Tạo lớp học</h1>
      <form action="/lophoc/store" method="post">
        <label for="classid">Mã lớp</label>
        <input type="text" name="classid" id="classid" required>
        
        <label for="classname">Tên lớp</label>
        <input type="text" name="classname" id="classname" required>
        
        <label for="note">Ghi chú</label>
        <textarea name="note" id="note"></textarea>
    
        <input type="submit" value="Tạo">

        <div class="back-link">
          <a href="/lophoc/index">Quay lại danh sách</a>
        </div>
      </form>
  </div>
</body>

</html>
