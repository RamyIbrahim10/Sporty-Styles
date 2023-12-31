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

    // Check if file input 'itemImage' exists in the form submission
    if(isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";

        // Create the directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($_FILES["itemImage"]["name"]);
        $absoluteTargetFile = __DIR__ . '/' . $targetFile; // Use absolute path

        if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $absoluteTargetFile)) {
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
    } else {
        echo "No file uploaded or an error occurred with the file.";
    }

    $conn->close();
}
?>
