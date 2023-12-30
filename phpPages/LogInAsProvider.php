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

    // Check if the user is blocked
    if (isUserBlocked($username)) {
        echo "Sorry, your account is blocked. Please contact support for assistance.";
        exit();
    }

    // SQL query to retrieve user from the database
    $sql = "SELECT * FROM signupasprovider WHERE email = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found
        $row = $result->fetch_assoc();
        if ($password === $row['Password']) {
            // Password is correct, login successful
            $_SESSION['email'] = $username;
            echo "<script>alert('Login successful!');</script>";
            echo "<script>window.location.href = '../htmlPages/fork.html';</script>"; // Redirect to a dashboard page
            resetLoginAttempts($username); // Reset login attempts on successful login
            exit();
        } else {
            // Invalid password
            incrementLoginAttempts($username); // Increment login attempts for this user
            if (loginAttemptsExceeded($username)) {
                blockUser($username); // Block the user if login attempts exceed the threshold
                echo "<script>alert('Sorry, your account has been blocked due to multiple failed login attempts. Please contact support for assistance.');</script>";
                exit();
            } else {
                echo "<script>alert('Invalid Password');</script>";
                echo "<script>window.location.href = '../htmlPages/LoginUser.html';</script>";
                exit();
            }
        }
    } else {
        // User not found
        // Handle user not found scenario if needed
    }
}

$conn->close();

// Functions for login attempt limit
function isUserBlocked($username) {
    // Implement logic to check if the user is blocked in the database
    // Return true if the user is blocked, false otherwise
}

function resetLoginAttempts($username) {
    // Implement logic to reset login attempts for the user in the database
}

function incrementLoginAttempts($username) {
    // Implement logic to increment login attempts for the user in the database
}

function loginAttemptsExceeded($username) {
    // Implement logic to check if login attempts exceed the threshold
    // Return true if exceeded, false otherwise
}

function blockUser($username) {
    // Implement logic to block the user in the database
}
?>
