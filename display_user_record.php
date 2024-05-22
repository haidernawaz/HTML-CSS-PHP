<?php
session_start();
include("includes/config.php");
include("includes/common.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Admin Panel</title>
    <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
    <?php include 'includes/css-meta.php';?> 
    
</head>
<body class="body_user_record">
    <!-- Nav Bar -->

    <section>
        <div class="container_user_record">
        <h3 class="heading_user_record"> Users Record</h3>

            <?php
            // Database connection

            $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);


            // Check for connection errors
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch product data from the database
            $query = "SELECT * FROM users";
            $result = $conn->query($query);

            // Check if there are products in the database
            if ($result->num_rows > 0) {
                // Display table to show product data
                echo '
                <table class="table_user_record">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>';

                // Loop through the product data and generate table rows
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $address = $row['address'];
                    $phone = $row['phone'];
                    $email = $row['email'];

                    echo '
                    <tr>
                        <td>' . $id . '</td>
                        <td>' . $name . '</td>
                        <td>' . $address . '</td>
                        <td>' . $phone . '</td>
                        <td>' . $email . '</td>
                        
                        <td>
                            <a href="delete_user_record.php?id=' . $id . '" class="button_user_record">Delete</a>
                        </td>
                    </tr>';
                }

                echo '
                    </tbody>
                </table>';
            } else {
                echo "No products found.";
            }

            $conn->close();
            ?>

        </div>
    </section>
</body>
</html>
<?php 
}
else {
    header("Location: register.php?msg=UKERR");
    exit;
}
?>