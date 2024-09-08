<?php
// Include the database connection
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Message sent successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
