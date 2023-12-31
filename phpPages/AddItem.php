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

    // Collect form data
    $itemName = $_POST['Name'];
    $price = $_POST['Price'];
    $afterDiscount = $_POST['AfterDiscount'];
    $productionDate = $_POST['PDate'];
    $manufacturingLocation = $_POST['MadeIn'];

    
    // Generate a unique filename
    $targetDir = "uploads/"; // Directory where images will be stored
    $timestamp = time(); // Get current timestamp
    $uniqueFileName = $timestamp . '_' . basename($_FILES["itemImage"]["name"]);
    $targetFile = $targetDir . $uniqueFileName;

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, a file with the same name already exists.";
        } else {
        // Try to upload the file
        if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, save the file name or path to the database
            $imagePath = $targetFile;
    
            $sql = "INSERT INTO items ( image_path, Name, price, AfterDiscount, PDate, MadeIn) VALUES ('$imagePath', '$itemName', '$price', '$afterDiscount', '$productionDate', '$manufacturingLocation')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Image uploaded and saved in the database successfully.');</script>";
                echo "<script>window.location.href = '../htmlPages/insertItem.html';</script>";
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