<?php
include('db.php');

// Fetch the existing data for the user based on their ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM contacts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
}

// Update the user information when the form is submitted
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $sql = "UPDATE contacts SET username = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $email, $id);
    if ($stmt->execute()) {
        header("Location: list_users.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <!-- One form for editing user details -->
    <form action="edit_user.php?id=<?php echo $id; ?>" method="POST">
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
