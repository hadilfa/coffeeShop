<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "coffee_shop"; // تأكدي من مطابقة هذا الاسم لقاعدتكِ في phpMyAdmin

// 1. الاتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. التحقق من وصول البيانات عبر POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // استقبال بيانات الزبون الشخصية وحمايتها من الثغرات
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);
    
    // استقبال نص الـ JSON الخاص بالسلة وتحويله لمصفوفة PHP
    $cart_data_raw = $_POST['cart_data'];
    $cart_items = json_decode($cart_data_raw, true);

    // 3. إدخال الطلب في جدول orders (الـ status سيأخذ قيمة 'Pending' تلقائياً)
    $sql_order = "INSERT INTO orders (firstname, lastname, address, phone) 
                  VALUES ('$firstname', '$lastname', '$address', '$phone')";

    if ($conn->query($sql_order) === TRUE) {
        // جلب رقم الـ ID الخاص بهذا الطلب الذي أُنشئ حالاً لربطه بالتفاصيل
        $order_id = $conn->insert_id; 

        // 4. إدخال المشروبات المرافقة داخل جدول order_details عبر حلقة تكرارية
        foreach ($cart_items as $item) {
            $product_name = $conn->real_escape_string($item['name']);
            $price = $item['price'];
            $quantity = $item['quantity'];

            $sql_details = "INSERT INTO order_details (order_id, product_name, price, quantity) 
                            VALUES ('$order_id', '$product_name', '$price', '$quantity')";
            $conn->query($sql_details);
        }

      
        // 5. إشعار المستخدم بالنجاح، حفظ رقم الطلب للتتبع، تصفير السلة والانتقال لصفحة التتبع
echo "<script>
        localStorage.setItem('last_order_id', '$order_id');
        localStorage.removeItem('ararat_cart');
        alert('Success! Your order has been placed and is now Pending. ☕');
        window.location.href = 'tracking.html';
      </script>";
    } else {
        echo "Error creating order: " . $conn->error;
    }
}

$conn->close();
?>