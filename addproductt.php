<?php
session_start();
include("includes/config.php");
include("includes/common.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && isset($_SESSION["type"]) && $_SESSION["type"] == 'A') {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>

<?php include ('includes/css-meta.php');?> 

    <title>Admin Panel</title>
</head>
<body>

        <!-- Navbar -->
        <?php include 'includes/nav.php';?> 


        <div class="container">
            <div>
                <h2 class="sub_heading_one">Upload New Products</h2>
            </div>
        </div>


        <?php
        if (isset($_GET["msg"])) {
            $msg = sanitizeInput($_GET["msg"]);

            if ($msg == "SAB") {
                echo '<div class="popup">SUCCESSFULL BOOK ADDDED</div>';
            }
            if ($msg == "error") {
                echo '<div class="popup">Sorry, there was an error uploading your file.</div>';
            }
            if ($msg == "NIU") {
                echo '<div class="popup">NO IMAGE UPLOAD.</div>';
            }}
            ?> 



    <section>
        <div class="container">
            <div >
                <div >
                    <div >
                        <div >
                        <form action="store_product.php" method="POST" enctype="multipart/form-data">
                                <div >
                                    <label for="image">Book Image</label>
                                    <input type="file" name="image" required />
                                </div>
                                <div >
                                    <label for="name">Book Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div >
                                    <label for="author">Book Author</label>
                                    <input type="text" class="form-control" id="author" name="author" required>
                                </div>
                                <div >
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                                </div>
                                <div >
                                    <label for="sale_price">Sale Price (optional)</label>
                                    <input type="number" class="form-control" id="sale_price" name="sale_price" step="0.01">
                                </div>
                                <div >
                                    <button type="submit" value="submit" class="button_Submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<footer>
  <?php include 'includes/footer.php';?> 
  </footer>
</html>


<?php 
}
else {
    header("Location: register.php?msg=UAAA");
    exit;
}
?>