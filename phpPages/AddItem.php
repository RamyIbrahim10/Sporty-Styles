<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to your MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "stylesprots";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['price'];
    $productionDate = $_POST['productionDate'];
    $manufacturingLocation = $_POST['manufacturingLocation'];

    // Handle file upload
    $targetDir = "uploads/"; // Directory where uploaded images will be stored
    $targetFile = $targetDir . basename($_FILES["itemImage"]["name"]);

    if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $targetFile)) {
        // File uploaded successfully, proceed to store data in the database
        $itemImage = $targetFile;

        // SQL to insert data into the database
        $sql = "INSERT INTO items (item_image, item_name, item_price, production_date, manufacturing_location)
                VALUES ('$itemImage', '$itemName', '$itemPrice', '$productionDate', '$manufacturingLocation')";

        if ($conn->query($sql) === TRUE) {
            echo "Data stored successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
}
?>
