<?php
include("config.php");

$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>

<h2>Kitchen Orders 🍳</h2>

<?php while($row = $result->fetch_assoc()){ ?>
    <div>
        <?php if($row['order_type']=="dine-in"){ ?>
            Table <?= $row['table_number'] ?>
        <?php } else { ?>
            Delivery - <?= $row['customer_name'] ?>
        <?php } ?>

        → <?= $row['product_name'] ?>
        (<?= $row['status'] ?>)
    </div>
<?php } ?>