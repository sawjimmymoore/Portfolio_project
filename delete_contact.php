<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
