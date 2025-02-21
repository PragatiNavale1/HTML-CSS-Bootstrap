<?php
$servername = "localhost";
$username = "root";
$password = "Admin@123";
$dbname = "chatbot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user message
$userMessage = strtolower($_POST['message']);
$userMessage = mysqli_real_escape_string($conn, $userMessage); // Prevent SQL Injection

// Define responses
$responses = [
    "hello" => "Hi there! How can I help you?",
    "services" => "Help to manage expense.",
    "refund policy" => "Our refund policy allows refunds within 30 days."
];

$botResponse = "Sorry, I didn't understand that.";
foreach ($responses as $key => $value) {
    if (strpos($userMessage, $key) !== false) {
        $botResponse = $value;
        break;
    }
}

// Escape the bot response to prevent SQL errors
$botResponse = mysqli_real_escape_string($conn, $botResponse);

// Insert into database
$sql = "INSERT INTO messages (user_message, bot_response) VALUES ('$userMessage', '$botResponse')";
$conn->query($sql);

// Return bot response
echo $botResponse;

// Close connection
$conn->close();
?>
