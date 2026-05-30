<?php

$conn = new mysqli("localhost", "root", "", "coffee_shop");

if($conn->connect_error){
    die("Connection failed");
}

?>