<?php
$servername = "localhost";  
$username = "root";         
$password = "Admin@123";             
$dbname = "expense_tracker";    


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
