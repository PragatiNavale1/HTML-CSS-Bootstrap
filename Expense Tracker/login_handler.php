<?php
// Include database connection
include 'db_connection.php';

if (isset($_POST['login'])) {
    // Collect and sanitize form data
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Check if user exists
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            session_start();
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
             header("Location: dashboard.php");
             exit;
        } else {
            echo "<script>alert('Invalid email or password. Please try again.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
    }
}

// Close the connection
$conn->close();
?>
