<?php
session_start();
include("includes/config.php");
include("includes/common.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Book App</title>

        <?php
        include("includes/css-meta.php");
        ?>
    </head>

    <body>

        <?php
        include("includes/nav.php");
        ?>

        <main>
            <h2 class="sub_heading_one">Change Password </h2>
            <?php


        if (isset($_GET["msg"])) {
            $msg = sanitizeInput($_GET["msg"]);

            if ($msg == "SUP") {
                echo '<div class="popup">SUCCESSFULL UPDATE PASSWORD </div>';
            }
            if ($msg == "PWDNM") {
                echo '<div class="popup">PASSWORD NOT MATCH </div>';
            }
            if ($msg == "UKERR") {
                echo '<div class="popup">Failure: UNKNOWN ERROR</div>';
            }
            if ($msg == "UAAA") {
                echo '<div class="popup">Failure: Unauthorized attempt</div>';
            }
        }
        ?> 

            <form method="post" action="password-action.php">
                <div>
                    <label>New Password</label>
                    <input type="password" name="ps1" placeholder="Password" required>
                </div>
                <div>
                    <label>Confirm Password</label>
                    <input type="password" name="ps2" placeholder="Password" required>
                </div>
                <div>
                    <input type="submit" value="Change Password">
                </div>
            </form>


        </main>

        <?php
        include("includes/footer.php");
        ?>
    </body>

    </html>
    <?php
} else {
    header("Location: index.php");
}
?>