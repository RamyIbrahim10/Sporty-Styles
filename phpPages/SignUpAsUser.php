<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stylesports";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected Successfully";
}

// Function to safely escape input values
function clean_input($value) {
    global $conn;
    return mysqli_real_escape_string($conn, stripslashes($value));
}

// Handle form submission
if (isset($_POST["submit"])) {
    // Fetch user input
    $username = clean_input($_POST["email"]);
    $password = clean_input($_POST["password"]);

    // Insert user details into the database
    $sql = "INSERT INTO signupasuser (email, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === true) {
        echo "Sign-up successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>