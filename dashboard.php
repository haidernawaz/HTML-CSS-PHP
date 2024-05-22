<?php
session_start();
include("includes/config.php");
include("includes/common.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("includes/css-meta.php"); ?>
        <title>Dashboard</title>
    </head>

    <body>
        <?php
        // include("includes/header.php");
        include("includes/nav.php");
        ?>
    <main>
            <?php
            if (isset($_SESSION["type"]) && $_SESSION["type"] == 'A'){
             include("dispaly_book_record.php");
            }

            if (isset($_SESSION["type"]) && $_SESSION["type"] == 'U'){
                include("display_product_user_mode.php");
               }
            
            ?>
    </main>


    </body>

    </html>

    <?php

} else {
    header("Location: index.php?msg=UAAA");

}
?>
<footer>
    <?php
include("includes/footer.php");
?>
</footer>