<?php
// DB connection
$conn = new mysqli('localhost', 'root', '', 'shopee');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);

    // Simple login: check if user exists with matching first_name and last_name
    $stmt = $conn->prepare("SELECT user_id FROM user WHERE first_name = ? AND last_name = ?");
    $stmt->bind_param("ss", $first_name, $last_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // User found, login success
        $_SESSION['user'] = $first_name . " " . $last_name;
        echo "<p style='color:green;'>Login successful! Welcome, " . htmlspecialchars($_SESSION['user']) . ".</p>";
        // Redirect to a dashboard or homepage if you want
        // header('Location: dashboard.php'); exit;
    } else {
        echo "<p style='color:red;'>Invalid credentials. Please try again.</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <?php include('header.php'); ?>

    <div class="login-container" style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="text" name="first_name" placeholder="First Name" required style="width:100%; padding:10px; margin:10px 0;" />
            <input type="text" name="last_name" placeholder="Last Name" required style="width:100%; padding:10px; margin:10px 0;" />
            <button type="submit" style="width:100%; padding:10px; background:#007bff; color:#fff; border:none; cursor:pointer;">Login</button>
        </form>
    </div>

</body>

</html>