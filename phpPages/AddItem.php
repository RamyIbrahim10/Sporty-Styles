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

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO items (item_image, item_name, item_price, production_date, manufacturing_location) VALUES (?, ?, ?, ?, ?)");

            if ($stmt) {
                // Bind parameters to the prepared statement
                $stmt->bind_param("sssss", $itemImage, $itemName, $itemPrice, $productionDate, $manufacturingLocation);

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
        // Check specific errors in $_FILES['itemImage']['error']
        switch ($_FILES['itemImage']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "A PHP extension stopped the file upload";
                break;
            default:
                echo "Unknown error occurred with the file upload";
                break;
        }
    }

    $conn->close();
}
?>
