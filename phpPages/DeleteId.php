<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "stylesports";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $itemIdToDelete = $_POST['delete_id'];

    // Delete the item from the database
    $sql = "DELETE FROM items WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $itemIdToDelete);

    if ($stmt->execute()) {
        echo "<script>alert('Item deleted successfully.');</script>";
        echo "<script>window.location.href = 'allItems.php';</script>"; // Redirect to your previous page
    } else {
        echo "Error deleting item: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Your HTML code -->
<!-- Assuming you have the previous HTML code here -->

