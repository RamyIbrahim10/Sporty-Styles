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
    
    $itemName = $_POST['Name'];
    $price = $_POST['Price'];
    $afterDiscount = $_POST['AfterDiscount'];
    $productionDate = $_POST['PDate'];
    $manufacturingLocation = $_POST['MadeIn'];

    $targetDir = "uploads/";
    $timestamp = time();

    if(isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        $uniqueFileName = $timestamp . '_' . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $uniqueFileName;

        if ($_FILES["image"]["tmp_name"]) {
            $imagePath = $targetFile;

            $formattedProductionDate = date('Y-m-d', strtotime($productionDate));

            $sql = "INSERT INTO items (image_path, Name, price, AfterDiscount, PDate, MadeIn) VALUES ('$imagePath', '$itemName', '$price', '$afterDiscount', '$formattedProductionDate', '$manufacturingLocation')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Image uploaded and saved in the database successfully.');</script>";
                echo "<script>window.location.href = '../htmlPages/insertItem.html';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file uploaded or file field name is incorrect.";
    }

    $conn->close();
}
?>