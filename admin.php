<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
</head>
<body>

<h1>Admin Dashboard</h1>

<a href="logout.php">Logout</a>

</body>
</html>