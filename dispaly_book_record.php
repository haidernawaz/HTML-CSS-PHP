<?php
// session_start();
// include("includes/config.php");
// include("includes/common.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Admin Panel</title>
    <?php include 'includes/css-meta.php';?> 
   
   
</head>
<?php //include 'includes/nav.php';?> 
<body class="body_book_record">
    <section>
        <div class="container_book_record">
            <h3 class="heading_book_record">Product Record</h3>

            <?php
           

            $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);

           
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $query = "SELECT * FROM bookdata";
            $result = $conn->query($query);

            
            if ($result->num_rows > 0) {
            
                echo '
                <table class="table_book_record">
                    <thead>
                        <tr>
                            
                            <th>Book Name</th>
                            <th>Book Author</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                        </tr>
                    </thead>
                    <tbody>';

                
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $author = $row['author'];
                    $price = $row['price'];
                    $salePrice = $row['sale_price'];

                    echo '
                    <tr>
                        
                        <td>' . $name . '</td>
                        <td>' . $author . '</td>
                        <td>' . $price . '</td>
                        <td>' . $salePrice . '</td>
                        
                        <td>
                            <a href="delete_book_record.php?id=' . $id . '" class="button_book_record red">Delete</a>
                            <a href="update_book_record.php?id=' . $id . '" class="button_book_record blue">Update</a>
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
    header("Location: index.php?msg=UAAA");
    exit;
}
?>