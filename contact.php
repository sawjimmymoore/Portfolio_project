<?php
// Include the database connection
include 'db.php';

// Check if the form fields are set and not empty
if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO contacts (username, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the query
    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $stmt->error; // Get the specific error for the statement
    }

    // Close the statement and the connection
    $stmt->close();
} else {
    echo "All form fields are required.";
}

$conn->close();
?>
