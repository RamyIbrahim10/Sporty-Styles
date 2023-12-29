<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stylesports";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Function to safely escape input values
function clean_input($value)
{
    global $conn;
    return mysqli_real_escape_string($conn, stripslashes($value));
}

// Handle form submission
if (isset($_POST["submit"])) {
    // Fetch user input
    $username = clean_input($_POST["fullName"]);
    $email = clean_input($_POST["email1"]);
    $password = clean_input($_POST["pass"]);
    $dob = clean_input($_POST["dob"]);
    $gender = clean_input($_POST["gender"]);

    // Insert user details into the database
    $sql = "INSERT INTO signupasuser (fullName, email, Password, DateofBirth, Gender) VALUES ('$username', '$email', '$password', '$dob', '$gender')";
    if ($conn->query($sql) === true) {
        header("Location: ../ShoppingCenterManagement/fork.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
