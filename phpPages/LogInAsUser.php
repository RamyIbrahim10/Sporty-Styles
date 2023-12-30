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
        if (password_verify($password, $row['Password'])) {
            // Password is correct, login successful
            $_SESSION['email'] = $username; // Store username in session for further use
            echo "Login successful!";
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