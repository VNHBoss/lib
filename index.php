<!DOCTYPE html>
<html>
<head>
    <title>Thư viện sách</title>
</head>
<body>
    <h1>Thư viện sách</h1>
    <ul>
        <?php
        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli("localhost", "id19768936_lib", "Lib12345@", "id19768936_library");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Truy vấn dữ liệu sách
        $sql = "SELECT id, title FROM books";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li><a href='detail.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></li>";
            }
        } else {
            echo "Không có sách nào trong thư viện.";
        }

        $conn->close();
        ?>
    </ul>
</body>
</html>
