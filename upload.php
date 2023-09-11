<!DOCTYPE html>
<html>
<head>
    <title>Upload sách</title>
</head>
<body>
    <h1>Upload sách</h1>
   
    <?php
    error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Kiểm tra xem có mật mã đã nhập hay chưa
    if(isset($_POST["password"])) {
        $password = $_POST["password"];

        // Kiểm tra mật mã
        if($password === "Nthh8124") { // Thay "your_secret_password" bằng mật mã thực tế
            if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                // Xử lý việc upload sách
                $file_name = $_FILES["file"]["name"];
                $file_tmp = $_FILES["file"]["tmp_name"];
                $file_path = "uploads/" . $file_name; // Thư mục lưu trữ sách

                if(move_uploaded_file($file_tmp, $file_path)) {
                    // Lưu thông tin sách vào cơ sở dữ liệu (ví dụ)
                    $title = $_POST["title"];
                    $author = $_POST["author"];
                    $description = $_POST["description"];

                    // Kết nối đến cơ sở dữ liệu và thêm thông tin sách
                    $conn = new mysqli("localhost", "id19768936_lib", "Lib12345@", "id19768936_library");
                    if ($conn->connect_error) {
                        die("Kết nối thất bại: " . $conn->connect_error);
                    }

                    $sql = "INSERT INTO books (title, author, description, file_path) VALUES ('$title', '$author', '$description', '$file_path')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Upload sách thành công!";
                    } else {
                        echo "Lỗi: " . $conn->error;
                    }

                    $conn->close();
                } else {
                    echo "Lỗi khi tải lên sách.";
                }
            } else {
                echo "Vui lòng chọn một tệp sách để tải lên.";
            }
        } else {
            echo "Mật mã không đúng.";
        }
    }
    ?>
     <form method="POST" enctype="multipart/form-data">
        <label for="password">Nhập mật mã:</label>
        <input type="password" name="password" required>
        <br>
        <label for="title">Tiêu đề sách:</label>
        <input type="text" name="title" required>
        <br>
        <label for="author">Tác giả:</label>
        <input type="text" name="author">
        <br>
        <label for="description">Mô tả:</label>
        <textarea name="description"></textarea>
        <br>
        <label for="file">Chọn tệp sách:</label>
        <input type="file" name="file" required>
        <br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
