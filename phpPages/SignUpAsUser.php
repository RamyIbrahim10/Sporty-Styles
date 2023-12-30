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
        echo "<script>alert('Sign Up Successfully');</script>";
        header("Location: ../htmlPages/LoginUser.html");
    }

    $conn->close();
}
?>
