<?php
// Connect to the database
$host = 'localhost';
$db = 'franchise_db';
$user = 'root';
$pass = 'password';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$type = $_POST['type'];
$price = $_POST['price'];
$manager = $_POST['manager'];
$email = $_POST['email'];
$location = $_POST['location'];

// Handle image upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

// Insert into the database
$sql = "INSERT INTO franchises (name, type, price, manager, email, location, image) 
        VALUES ('$name', '$type', '$price', '$manager', '$email', '$location', '$target_file')";

if ($conn->query($sql) === TRUE) {
    echo "Franchise saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
