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
     $theSection = $_POST['type'];

     // Check if the file field is set and not empty
     if(isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
         $targetDir = "uploads/";
         $timestamp = time();
         $uniqueFileName = $timestamp . '_' . basename($_FILES["image"]["name"]);
         $targetFile = $targetDir . $uniqueFileName;

         if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
             $imagePath = $targetFile;

             $sql = "INSERT INTO items (image_path, Name, price, AfterDiscount, PDate, MadeIn, type) VALUES ('$imagePath', '$itemName', '$price', '$afterDiscount', '$productionDate', '$manufacturingLocation', '$theSection')";
             if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Image uploaded and saved in the database successfully.');</script>";
                echo "<script>window.location.href = 'AddItem.php';</script>";
             } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
             }
         } else {
             echo "Sorry, there was an error uploading your file.";
         }
     } else {
         echo "No file uploaded or an error occurred with the file upload.";
     }

    $conn->close();
}
?>