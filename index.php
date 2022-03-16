<?php
//Khai báo sử dụng session
session_start();

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Xử lý đăng nhập
if (isset($_POST['login'])) {
  //Kết nối tới database
  include('connectDB.php');

  //Lấy dữ liệu nhập vào
  $username = addslashes($_POST['username']);
  $password = addslashes($_POST['password']);

  //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
  if (!$username || !$password) {
    echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
  }

  // mã hóa pasword
  $password = md5($password);

  //Kiểm tra tên đăng nhập có tồn tại không
  $query = mysqli_query($conn, "SELECT username, password FROM user_info WHERE username='$username'");
  if (mysqli_num_rows($query) == 0) {
    echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
  }

  //Lấy mật khẩu trong database ra
  $row = mysqli_fetch_array($query);

  //So sánh 2 mật khẩu có trùng khớp hay không
  if ($password != $row['password']) {
    echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
  }

  //Lưu tên đăng nhập
  $_SESSION['username'] = $username;
  echo "Xin chào " . $username . ". Bạn đã đăng nhập thành công. <a href='/'>Về trang chủ</a>";
  die();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <title>Welcome</title>
</head>


<body>
  <div class="container" style="width:50% ;margin-top:2em">
    <h2>Welcome back</h2>
    <h3>Login to your account</h3>
    <form action="" method="POST" style="width: 50%">

      <label for="username">Username</label>
      <input type="text" name="username" class="form-control">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control">

      <button class="btn btn-primary" style="margin:10px 0 10px 0" name="login">Login</button>
    </form>

    <span>Don't have account? <a href=" register.php">Register</a></span>
  </div>
</body>


</html>