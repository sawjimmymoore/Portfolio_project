<?php
include 'db.php';

$sql = "SELECT id, name, email, message, reg_date FROM contacts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. " - Message: " . $row["message"]. " - Date: " . $row["reg_date"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
