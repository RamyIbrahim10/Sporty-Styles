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
    $itemId = $_POST['ID'];
    $itemName = $_POST['Name'];
    $price = $_POST['Price'];
    $afterDiscount = $_POST['AfterDiscount'];
    $productionDate = $_POST['PDate'];
    $manufacturingLocation = $_POST['MadeIn'];
    $theSection = $_POST['type'];

    // Check if an image is being updated
    $imagePath = '';
    if ($_FILES["image"]["size"] > 0) {
        $targetDir = "uploads/";
        $timestamp = time();
        $uniqueFileName = $timestamp . '_' . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $uniqueFileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
            $conn->close();
            exit();
        }
    }

    // Update data in the database using prepared statements
    $sql = "UPDATE items SET Name=?, Price=?, AfterDiscount=?, PDate=?, MadeIn=?, type=?";
    $params = array($itemName, $price, $afterDiscount, $productionDate, $manufacturingLocation, $theSection);

    if (!empty($imagePath)) {
        $sql .= ", image_path=?";
        $params[] = $imagePath;
    }

    $sql .= " WHERE ID=?";
    $params[] = $itemId;

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $types = str_repeat('s', count($params)); // Assuming all parameters are strings
        $stmt->bind_param($types, ...$params);
        if ($stmt->execute()) {
            echo "<script>alert('Item updated successfully.');</script>";
            echo "<script>window.location.href = 'allItems.php';</script>";
        } else {
            echo "Error updating item: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
