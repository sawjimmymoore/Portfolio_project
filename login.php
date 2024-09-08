<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            // Redirect to home page after successful login
            header("Location: index.html");
            exit();
        } else {
            $message = "Invalid credentials.";
        }
    } else {
        $message = "No such user found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>
    <header id="header">
        <div class="logo">
            <h1>WEB DEVELOPMENT TEAM</h1>
        </div>
    </header>
    
    <div class="main-content">
        <h2>Login</h2>
        <?php if (isset($message)): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <a href="register.php">Don't have an account? Register here.</a>
    </div>
    
</body>
</html>
