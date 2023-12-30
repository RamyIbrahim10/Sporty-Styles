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

    <div class="container">
        <h2>All Items</h2>
        <div class="row">
          <?php
            // Replace with your database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "items";
      
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
      
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
      
            // Fetch items from the database
            $sql = "SELECT * FROM items";
            $result = $conn->query($sql);
      
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                // Display each item
                echo '<div class="col-md-4 mb-3">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['item_name'] . '</h5>';
                echo '<p class="card-text">Description: ' . $row['description'] . '</p>';
                echo '<p class="card-text">Price: $' . $row['price'] . '</p>';
                // Add more fields as needed
                echo '</div></div></div>';
              }
            } else {
              echo "No items found";
            }
      
            // Close connection
            $conn->close();
          ?>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>