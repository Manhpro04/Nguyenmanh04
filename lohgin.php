<?php
define('HOST', 'localhost');
define('DATABASE', 'quanlysinhvien');
define('USERNAME', 'root');
define('PASSWORD', '');

// Hàm kiểm tra đăng nhập
function checkLogin($username, $password)
{
    // Thiết lập kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    // Kiểm tra kết nối
    if (!$conn) {
        die("Lỗi kết nối cơ sở dữ liệu: " . mysqli_connect_error());
    }

    // Truy vấn kiểm tra tài khoản
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Kiểm tra kết quả truy vấn
    if (mysqli_num_rows($result) > 0) {
        return true; // Đăng nhập thành công
    } else {
        return false; // Đăng nhập thất bại
    }

    // Đóng kết nối
    mysqli_close($conn);
}

// Xử lý đăng nhập khi người dùng nhấn nút "Đăng nhập"
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (checkLogin($username, $password)) {
        echo "Đăng nhập thành công!";
        // Thực hiện các tác vụ sau khi đăng nhập thành công
    } else {
        echo "Đăng nhập thất bại! Vui lòng kiểm tra lại tên đăng nhập và mật khẩu.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <form method="POST" action="">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" name="login" value="Đăng nhập">
    </form>
</body>
</html>