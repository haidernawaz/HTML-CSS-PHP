<?php
// session_start();
// include("includes/config.php");
// include("includes/common.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && isset($_SESSION["type"]) && $_SESSION["type"] == 'U') {
    ?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Admin Panel</title>
    <?php include 'includes/css-meta.php';?> 
    
</head>
<body>

<section>
    <div class="container">
        <div class="product-container">

            <?php

$conn = connect($dbserver, $dbuser, $dbpassword, $dbname);

            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $query = "SELECT * FROM bookdata";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
               
                while ($row = $result->fetch_assoc()) {
                    $imagePath = $row['image'];
                    $name = $row['name'];
                    $author = $row['author'];
                    $price = $row['price'];
                    $salePrice = $row['sale_price'];

                    echo '
                    <div class="productcard">
                        <div class="card">
                            
                            <img class="cardimg" src="' . $imagePath . '" alt="Product Image">
                           
                            <div class="cardbody">
                                <div class="text_center">

                                    <h3 class="bold_text">' . $name . '</h3>
                                    
                                    <p class="bold_text">' . $author . '</p>';

                    
                    if (!empty($salePrice)) {
                        echo '<span class="saleprice">$' . $price . '</span>';
                        echo '<div class="bold">$' . $salePrice . '</div>';
                    } else {
                        echo '<div class="bold">$' . $price . '</div>';
                    }

                    echo '  </div>
                            </div>
                            <div class="card_bottom">
                                <div class="text_center"><a class="btncard" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "No products found.";
            }

            $stmt->close();
            $conn->close();
            ?>

        </div>
    </div>
</section>

</body>
</html>

<?php 
}
else {
    header("Location: register.php?msg=UAAA");
    exit;
}
?>
