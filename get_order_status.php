<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$password = "";
$dbname = "coffee_shop";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit();
}

// استقبال رقم الطلب القادم من الجافاسكريبت الممرر في الرابط
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id > 0) {
    // الاستعلام عن حالة هذا الطلب بالذات
    $sql = "SELECT status FROM orders WHERE id = $order_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(["success" => true, "status" => $row['status']]);
    } else {
        echo json_encode(["success" => false, "message" => "Order not found"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid Order ID"]);
}

$conn->close();
?>