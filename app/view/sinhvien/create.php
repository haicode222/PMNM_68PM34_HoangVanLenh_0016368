<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tạo sinh viên</title>
</head>

<body>
  <h1>Tạo sinh viên</h1>
  <form action="/sinhvien/store" method="post">
    <label for="hoten">Ho ten</label>
    <input type="text" name="hoten" id="hoten">
    <label for="sex">Gioi tinh</label>
    <input type="text" name="sex" id="sex">
    <label for="mssv">MSSV</label>
    <input type="text" name="mssv" id="mssv">

    <input type="submit" value="Tạo">
  </form>
</body>

</html>