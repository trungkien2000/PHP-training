# PHP-training report
Link demo: https://php-tranining.000webhostapp.com/
Người thực hiện: Trung Kiên
Ngày thực hiện: 18/3, 1/4 (update các hàm sử dụng)

-----------
## 1. Chức năng của website
* Đăng ký tài khoản
* Đăng nhập bằng tải khoản đã đăng ký
* Đăng xuất
* Upload file lên trang web
* Tải file có trên trang web (được người dùng upload)
* Tìm kiếm thông tin của người dùng của trang web

-----------
## 2. Mô tả xây dựng các chức năng, file:
* "connectDB.php": dùng để kết nối vào database khi cần
* "auth_session.php": dùng để lưu phiên đăng nhập
* Chức năng đăng ký: thực hiện request các thông tin người dùng nhập ở form đăng ký và lưu vào database. Dùng 2 lệnh <code>stripslashes, mysqli_real_escape_string</code> để loại bỏ dấu chéo ngược và các ký tự đặc biệt (tránh hệ thống bị tấn công). Trường password được mã hóa với thuật toán md5 và lưu chuỗi đã mã hóa vào database.
* Chức năng đăng nhập: request data người dùng nhâp ở form đăng nhập, so khớp với dữ liệu có trong database và chuyển hướng người dùng vào trang chủ nếu đúng thông tin.
* Chức năng upload file: cho phép người dùng đã đăng nhập upload file định dạng bất kì. Nếu là hình ảnh thì sẽ hiển thị trên trang chủ. Lưu tên file và tên người dùng upload vào database.
* Chức năng tải file: người dùng đã đăng nhập có thể tải file. 
* Chức năng tìm kiếm: người dùng có thể nhập tên hoặc tên đăng nhập của người dùng để tìm kiếm. Kết quả trả về sẽ hiển thị các thông tin của người dùng đó (không bao gồm password). Sử dụng lệnh <code>like</code> để truy vấn vào database tìm kiếm.

-----------
## 3. Mô tả một số hàm sử dụng trong code:
- <code>session_start</code>: khởi tạo và lưu 1 phiên của người dùng
- <code>session_destroy</code>:
- <code>mysqli_connect</code>: lệnh để kết nối vào database
- <code>stripslashes</code>: xóa dấu chéo ngược -> phòng tránh các tấn công injection
- <code>mysqli_real_escape_string</code>:
- <code>mysqli_query</code>: truy vấn vào database để thực hiện các thao tác thêm, sửa, xóa,...
- <code>htmlspecialchars</code>: chuyển một số ký tự đặc biệt, gồm: <code>&, ', ", <, > </code>thành dạng HTML entities.
- <code>fetch_assoc</code>:
- <code>addslashes</code>: thêm một dấu chéo ngược trước một số ký tự, gồm: <code> ', ", \, NUL </code>
