<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "stylesports";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define variables and initialize them
    $itemName = $itemPrice = $productionDate = $manufacturingLocation = $itemImage = "";

    // Check if the form fields are set before accessing them
    if(isset($_POST['itemName'])) {
        $itemName = $_POST['itemName'];
    }

    if(isset($_POST['price'])) {
        $itemPrice = $_POST['price'];
    }

    if(isset($_POST['productionDate'])) {
        $productionDate = $_POST['productionDate'];
    }

    if(isset($_POST['manufacturingLocation'])) {
        $manufacturingLocation = $_POST['manufacturingLocation'];
    }

    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["itemImage"]["name"]);

    if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $targetFile)) {
        $itemImage = $targetFile;

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("INSERT INTO items (item_image, item_name, item_price, production_date, manufacturing_location) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $itemImage, $itemName, $itemPrice, $productionDate, $manufacturingLocation);

        if ($stmt->execute()) {
            echo "Data stored successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
}
?>
