<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();

// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stylesports";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['Password'];

    // SQL query to retrieve user from the database
    $sql = "SELECT * FROM signupasuser WHERE email = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found
        $row = $result->fetch_assoc();
        if ($password === $row['Password']) {
            // Password is correct, login successful
            $_SESSION['email'] = $username;
            echo "<script>alert('Login successful!');</script>";
            echo "<script>window.location.href = '../htmlPages/LoginUser.html';</script>"; // Redirect to a dashboard page
            exit();
        } else {
            // Invalid password
            echo "<script>alert('Invalid Password');</script>";
            echo "<script>window.location.href = 'LoginAsUser.php;</script>"; // Redirect back to login page with error message
            exit();
        }
    } else {
        // User not found
        echo "User not found";
    }
}

$conn->close();
?>