<?php
session_start();
include("includes/config.php");
include("includes/common.php");
$cpage = "login";
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("Location: dashboard.php");
} else {
    $email = "";
    if (isset($_COOKIE["email"])) {
        $email = $_COOKIE["email"];
    }
    ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Book Store</title>
    <?php include 'includes/css-meta.php';?> 
    
</head>


    <header>


    </header>

    <?php
        if (isset($_GET["msg"])) {
            $msg = sanitizeInput($_GET["msg"]);

            if ($msg == "SRA") {
                echo '<div class="popup">SUCCESSFULL REGISTER</div>';
            }
            if ($msg == "IEA") {
                echo '<div class="popup">Failure: Incorrect Email Address</div>';
            }
            if ($msg == "IPW") {
                echo '<div class="popup">Failure: Incorrect Password</div>';
            }
            if ($msg == "UAAA") {
                echo '<div class="popup">Failure: Unauthorized attempt</div>';
            }
            if ($msg == "SLO") {
                echo '<div class="popup">SUCCESSFULLY LOGOFF</div>';
            }
        }
         include 'includes/nav.php';?> 

         
 <body class="backhand_imag">
  <h2 class="login_heading">Log In</h2>
  <div class="form_container">
  <form action="login.php" method="post">
    <label for="email" class="login_form_label">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
    
    <label for="password" class="login_form_label">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>
    
    <input type="submit" value="LogIn">
  </form>
</div>

</body>
 <footer>
 <?php include 'includes/footer.php';?> 
 </footer> 


</html>


<?php 
}
?>