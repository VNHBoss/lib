<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết sách</title>
</head>
<body>
    <h1>Chi tiết sách</h1>
    <?php
    if(isset($_GET["id"])) {
        $book_id = $_GET["id"];

        // Kết nối đến cơ sở dữ liệu và truy vấn thông tin sách
        $conn = new mysqli("localhost", "id19768936_lib", "Lib12345@", "id19768936_library");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM books WHERE id = $book_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h2>" . $row["title"] . "</h2>";
            echo "<p>Tác giả: " . $row["author"] . "</p>";
            echo "<p>Mô tả: " . $row["description"] . "</p>";
            echo "<a href='download.php?id=" . $row["id"] . "'>Tải về</a>";
        } else {
            echo "Không tìm thấy sách.";
        }

        $conn->close();
    } else {
        echo "Không có thông tin sách.";
    }
    ?>
</body>
</html>
