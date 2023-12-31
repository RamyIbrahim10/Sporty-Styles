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
    
    if(isset($_POST['itemImage'])) {
        $itemName = $_POST['itemImage'];
    }
    
    if(isset($_POST['Name'])) {
        $itemName = $_POST['Name'];
    }

    if(isset($_POST['Price'])) {
        $itemPrice = $_POST['Price'];
    }

    if(isset($_POST['AfterDiscount'])) {
        $productionDate = $_POST['AfterDiscount'];
    }

    if(isset($_POST['PDate'])) {
        $productionDate = $_POST['PDate'];
    }

    if(isset($_POST['MadeIn'])) {
        $manufacturingLocation = $_POST['MadeIn'];
    }
    // Generate a unique filename
    $timestamp = time(); // Get current timestamp
    $uniqueFileName = $timestamp . '_' . basename($_FILES["itemImage"]["name"]);
    $targetFile = $targetDir . $uniqueFileName;

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, a file with the same name already exists.";
        } else {
        // Try to upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, save the file name or path to the database
            $imagePath = $targetFile;

            // Insert image path into the database
            $sql = "INSERT INTO images (image_path) VALUES ('$imagePath')";
            if ($conn->query($sql) === TRUE) {
                echo "Image uploaded and saved in the database successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
}
?>
