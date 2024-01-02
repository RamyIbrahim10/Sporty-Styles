<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Fork</title>
    <style>
        body {
            background: #F2F2F2;
            color: #282828;
        }

        .navbar {
            background-color: #282828;
            color: #FFCF01;
        }

        #nav .navbar-brand,
        #nav .offcanvas-title,
        #nav .navbar-nav .nav-link {
            color: #FFCF01;
        }

        .custom-toggler .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 16 16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%23FFCF01' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M1 4h14M1 8h14M1 12h14'/%3E%3C/svg%3E");
        }

        .container-500 {
            max-width: 500px;
        }
    </style>
</head>

<body>

    <nav id="nav" class="navbar navbar-expand-lg">
        <div class="container">
            <a id="MainLogo" class="navbar-brand fs-4" href="../index.html">Sporty Styles</a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="sidebar offcanvas offcanvas-end" id="offcanvasNavbar">
                <div class="offcanvas-header" style="background-color: #282828;">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Sporty Styles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3"
                        style="font-size: 20px; color: #141414; font-weight: bold;">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="../index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../FAQ.html">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Contact.html">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Update Item</h2>
        <form method="post" action="../phpPages/updateItem.php" enctype="multipart/form-data">
            <!-- ID selection dropdown -->
            <div class="mb-3">
                <label for="ID" class="form-label">Select Item ID</label>
                <select class="form-select" id="ID" name="ID">
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
                
                    $sql = "SELECT ID FROM items"; // Assuming 'items' is your table name
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['ID'] . '">' . $row['ID'] . '</option>';
                        }
                    } else {
                        echo '<option value="">No items found</option>';
                    }
                
                    $conn->close();
                    ?>
                </select>
            </div>

            <!-- Other input fields -->
            <div class="mb-3">
                <label for="image" class="form-label">Item Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="Name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter item name">
            </div>

            <div class="mb-3">
                <label for="Price" class="form-label">Price</label>
                <input type="text" class="form-control" id="Price" name="Price" placeholder="Enter price">
            </div>

            <div class="mb-3">
                <label for="AfterDiscount" class="form-label">Price with Discount</label>
                <input type="text" class="form-control" id="AfterDiscount" name="AfterDiscount" placeholder="Enter price">
            </div>

            <div class="mb-3">
                <label for="PDate" class="form-label">Production Date</label>
                <input type="date" class="form-control" id="PDate" name="PDate">
            </div>

            <div class="mb-3">
                <label for="MadeIn" class="form-label">Manufacturing Location</label>
                <input type="text" class="form-control" id="MadeIn" name="MadeIn" placeholder="Enter manufacturing location">
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">The Section</label>
                <input type="text" class="form-control" id="type" name="type" placeholder="Enter The Section">
            </div>

            <!-- Submit button -->
            <div class="mb-3">
                <p style="text-align:center;"><input type="submit" class="btn btn-warning" value="Update"></p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>
