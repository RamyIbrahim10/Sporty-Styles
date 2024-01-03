<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "stylesports";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get item ID from the form
    $itemID = $_POST['ID'];

    // Query to fetch item details from the 'items' table based on the provided item ID
    $sql = "SELECT * FROM items WHERE ID = '$itemID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch item details
        $row = $result->fetch_assoc();

        // Get necessary item details
        $itemName = $row['Name'];
        $itemPrice = $row['Price'];
        $itemDiscount = $row['AfterDiscount'];
        $itemPDate = $row['PDate'];
        $itemMadeIn = $row['MadeIn'];
        $itemType = $row['type'];
        $itemImagePath = $row['image_path'];

        // Insert item into the 'Basket' table
        $insertSQL = "INSERT INTO Basket (Name, Price, AfterDiscount, PDate, MadeIn, type, image_path) VALUES ('$itemName', '$itemPrice', '$itemDiscount', '$itemPDate', '$itemMadeIn', '$itemType', '$itemImagePath')";

        if ($conn->query($insertSQL) === TRUE) {
            echo "<script>alert('Item added to the Basket successfully!');</script>";
            echo "<script>window.location.href = 'Basket.php';</script>"; 
        } else {
            echo "Error: " . $insertSQL . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('No item found with the provided ID');</script>";
    }

    $conn->close();
}
?>
