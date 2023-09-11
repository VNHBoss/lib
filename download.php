<?php
if(isset($_GET["id"])) {
    $book_id = $_GET["id"];

    // Kết nối đến cơ sở dữ liệu và truy vấn thông tin sách
    $conn = new mysqli("localhost", "username", "password", "database_name");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $sql = "SELECT file_path FROM books WHERE id = $book_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row["file_path"];

        // Tải file về máy
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename($file_path));
        readfile($file_path);
    } else {
        echo "Không tìm thấy sách.";
    }

    $conn->close();
} else {
    echo "Không có thông tin sách.";
}
?>
