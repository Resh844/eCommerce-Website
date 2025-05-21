<?php
// DB connection - replace with your actual connection code or include your DBController here
$conn = new mysqli('localhost', 'root', '', 'shopee');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $register_date = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, register_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $first_name, $last_name, $register_date);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Registration successful!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Register Page</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <?php include('header.php'); ?>

    <div class="register-container" style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="first_name" placeholder="First Name" required style="width:100%; padding:10px; margin:10px 0;" />
            <input type="text" name="last_name" placeholder="Last Name" required style="width:100%; padding:10px; margin:10px 0;" />
            <button type="submit" style="width:100%; padding:10px; background:#007bff; color:#fff; border:none; cursor:pointer;">Register</button>
        </form>
    </div>

</body>

</html>