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
        // Verify the entered password with the hashed password in the database
        if ($password === $row['Password']) {
            // Password is correct, login successful
            $_SESSION['email'] = $username; // Store username in session for further use
            echo '<div class="alert alert-success" role="alert">
                    Login successful!
                </div>';
            // Redirect to a new page or set session variables for logged-in user
        } else {
            // Invalid password
            echo "Invalid Password";
        }
    } else {
        // User not found
        echo "User not found";
    }
}

$conn->close();
?>