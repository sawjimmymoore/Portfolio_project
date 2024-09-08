<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM contacts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: list_users.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
