<?php
// Nếu không phải là sự kiện đăng ký thì không xử lý
if (!isset($_POST['username'])) {
    die('');
}

//Nhúng file kết nối với database
include('connectDB.php');

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Lấy dữ liệu từ file dangky.php
$username   = addslashes($_POST['username']);
$password   = addslashes($_POST['password']);
$fullname   = addslashes($_POST['fullname']);
$email      = addslashes($_POST['email']);
$birthday   = addslashes($_POST['birthday']);
$gender     = addslashes($_POST['gender']);

//Kiểm tra người dùng đã nhập liệu đầy đủ chưa
if (!$username || !$password || !$fullname || !$email  || !$birthday || !$gender) {
    echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

// Mã khóa mật khẩu
$password = md5($password);

//Kiểm tra tên đăng nhập này đã có người dùng chưa
if (mysqli_num_rows(mysqli_query($conn, "SELECT username FROM user_info WHERE username='$username'")) > 0) {
    echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

//Kiểm tra email có đúng định dạng hay không
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email này không hợp lệ. Vui long nhập email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

//Kiểm tra email đã có người dùng chưa
if (mysqli_num_rows(mysqli_query($conn, "SELECT email FROM user_info WHERE email='$email'")) > 0) {
    echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

//Lưu thông tin thành viên vào bảng
@$adduser = mysqli_query($conn, "
        INSERT INTO user_info (
            username,
            password,
            fullname,
            email,
            birthday,
            gender
        )
        VALUE (
            '{$username}',
            '{$password}',
            '{$fullname}',
            '{$email}',
            '{$birthday}',
            '{$gender}'
        )
    ");

//Thông báo quá trình lưu
if ($adduser)
    echo "Quá trình đăng ký thành công. <a href='/'>Về trang chủ</a>";
else
    echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='dangky.php'>Thử lại</a>";
