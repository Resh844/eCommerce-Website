<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login_register.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Your Profile</title>
</head>

<body>

    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h1>
    <p>This is your profile page.</p>

    <a href="logout.php">Logout</a>

</body>

</html>