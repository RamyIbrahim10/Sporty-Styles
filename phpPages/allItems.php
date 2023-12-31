<?php
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

$sql = "SELECT * FROM items"; // Assuming 'items' is your table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="card mb-3">
            <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Item Image">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['Name']; ?></h5>
                <p class="card-text">Price: <?php echo $row['price']; ?></p>
                <p class="card-text">Price with Discount: <?php echo $row['AfterDiscount']; ?></p>
                <p class="card-text">Production Date: <?php echo $row['PDate']; ?></p>
                <p class="card-text">Manufacturing Location: <?php echo $row['MadeIn']; ?></p>
            </div>
        </div>
        <?php
    }
} else {
    echo "No items found";
}

$conn->close();
?>
