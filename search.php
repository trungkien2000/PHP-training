<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Search page</title>
</head>

<body>
    <div class="container">
        <?php
        // Nếu người dùng submit form thì thực hiện
        if (isset($_REQUEST['submit'])) {
            // Gán hàm addslashes để chống sql injection
            $search = addslashes($_GET['search']);

            // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
            if (empty($search)) {
                echo "Please enter require data!";
            } else {
                // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
                $query = "SELECT * FROM user_info WHERE username like '%$search%' or fullname like '%$search'";

                // Kết nối sql
                include("connectDB.php");

                // Thực thi câu truy vấn
                $sql = mysqli_query($conn, $query);

                // Đếm số đong trả về trong sql.
                $num = mysqli_num_rows($sql);

                // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
                if ($num > 0 && $search != "") {
                    // Dùng $num để đếm số dòng trả về.
                    echo "$num results with <b>$search</b>";

                    // Vòng lặp while & mysql_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
                    echo '<table border="1" cellspacing="0" cellpadding="10" class="table">';
                    echo '<tr>';
                    echo '<th>Username</th>';
                    echo '<th>Fullname</th>';
                    echo '<th>Email</th>';
                    echo '<th>Birthday</th>';
                    echo '<th>Gender</th>';
                    while ($row = mysqli_fetch_assoc($sql)) {
                        echo '<tr>';
                        echo "<td>{$row['username']}</td>";
                        echo "<td>{$row['fullname']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['birthday']}</td>";
                        echo "<td>{$row['gender']}</td>";
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo "No result!";
                }
            }
        }
        ?>
    </div>
</body>

</html>