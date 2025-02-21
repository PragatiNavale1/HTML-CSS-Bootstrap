<?php
// Include database connection
include 'db_connection.php';

if (isset($_POST['register'])) {
    // Collect and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']); 
    $mob = $conn->real_escape_string($_POST['mob']);
    $occu = $conn->real_escape_string($_POST['occu']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $sal = $conn->real_escape_string($_POST['sal']);
    
    if (!empty($name) && !empty($email) && !empty($password) && !empty($mob) && !empty($occu) && !empty($gender) && !empty($sal)) {
        
        // Check if the email or username already exists
        $checkQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkQuery);
        
        if ($result->num_rows > 0) {
            echo "<script>alert('Email or Username already exists. Please try another.'); window.history.back();</script>";
        } else {
            // Insert data into the users table
            $sql = "INSERT INTO users (name, email, password,mob, occu, gender, sal)
                    VALUES ('$name', '$email',  '$password', '$mob', '$occu', '$gender','$sal')";
            
            if ($conn->query($sql) === TRUE) {
                // Success alert and redirect
                echo "<script>alert('Registration successful!'); window.location.href = 'index.php';</script>";
            } else {
                // Alert for SQL error
                echo "<script>alert('Error: Could not complete registration.'); window.history.back();</script>";
            }
        }
    } else {
        // Alert for empty fields
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
    }
}

// Close the connection
$conn->close();
?>