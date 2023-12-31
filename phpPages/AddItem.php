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

    // Check if file input 'itemImage' exists in the form submission
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";

        // Create the directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $absoluteTargetFile = __DIR__ . '/' . $targetFile; // Use absolute path

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $absoluteTargetFile)) {
            $itemImage = $targetFile;

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO items (image, Name, Price, AfterDiscount, PDate , MadeIn) VALUES (?, ?, ?, ?, ?, ?)");

            if ($stmt) {
                // Bind parameters to the prepared statement
                $stmt->bind_param("ssssss", $itemImage, $itemName, $itemPrice, $productionDate, $manufacturingLocation);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "Data stored successfully!";
                } else {
                    echo "Error executing the statement: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error preparing the statement: " . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No file uploaded or an error occurred with the file.";
    }

    $conn->close();
}
?>
