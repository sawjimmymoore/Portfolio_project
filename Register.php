<?php
include 'db.php';

$message = ""; // Initialize a variable for error or success messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    // Check if the username already exists
    $checkSql = "SELECT * FROM users WHERE username = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Username already exists
        $message = "Username already taken. Please choose a different username.";
    } else {
        // Proceed with registration
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $password, $email);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: login.php?message=Successfully%20Registered!%20Please%20login.");
            exit();
        } else {
            $message = "Error: " . $stmt->error; // Error message
        }

        $stmt->close();
    }

    $checkStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>
    <header id="header">
        <div class="logo">
            <h1>WEB DEVELOPMENT TEAM</h1>
        </div>
    </header>
    
    <div class="main-content">
        <h2>Register</h2>
        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Register</button>
        </form>
        <a href="login.php">Already have an account? Login here.</a>
    </div>
   
</body>
</html>
