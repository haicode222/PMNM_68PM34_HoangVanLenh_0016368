<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>

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

    .login-container {
      width: 380px;
      background: #ffb3d9;
      padding: 35px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(255, 105, 180, 0.3);
    }

    h1 {
      text-align: center;
      color: white;
      margin-bottom: 25px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      color: white;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      padding: 12px;
      border: none;
      border-radius: 10px;
      margin-bottom: 15px;
      outline: none;
      font-size: 14px;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
    }

    input[type="submit"] {
      background: #ff4d94;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: 0.3s;
      margin-top: 10px;
    }

    input[type="submit"]:hover {
      background: #e60073;
      transform: translateY(-2px);
    }

    .login-title {
      text-align: center;
      color: #fff;
      margin-bottom: 20px;
      font-size: 15px;
    }
  </style>
</head>

<body>

  <div class="login-container">
    <h1>🌸 Đăng nhập</h1>

    <p class="login-title">
      Hệ thống quản lý sinh viên
    </p>

    <form action="/auth/login" method="post">
      <label for="username">Tên đăng nhập</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Mật khẩu</label>
      <input type="password" id="password" name="password" required>

      <input type="submit" value="Đăng nhập">
    </form>
  </div>

</body>

</html>