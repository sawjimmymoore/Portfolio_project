<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE contacts SET name=?, email=?, message=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $message, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
