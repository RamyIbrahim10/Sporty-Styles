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
    $password = $_POST['password'];

    // SQL query to retrieve user from the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    // Prepare and bind the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found
        $row = $result->fetch_assoc();
        // Verify the entered password with the hashed password in the database
        if (password_verify($password, $row['password'])) {
            // Password is correct, login successful
            $_SESSION['username'] = $username; // Store username in session for further use
            echo "Login successful!";
            // Redirect to a new page or set session variables for logged-in user
        } else {
            // Invalid password
            echo "Invalid password";
        }
    } else {
        // User not found
        echo "User not found";
    }
    
    $stmt->close();
}

$conn->close();
?>