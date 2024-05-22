<?php
session_start();
include("includes/config.php");
include("includes/common.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {

    $id = 0;
    if (isset($_SESSION["id"]) && $_SESSION["id"]) {
        $id = $_SESSION["id"];
    }

    $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);

    $sql = "SELECT * FROM users WHERE id=?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();

    $stmt->bind_result($uid, $uname, $email, $uhpwd, $address, $phone, $utype);
    $stmt->fetch();

   
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Book Store</title>
    <?php include('includes/css-meta.php');?>

</head>

<body class="backhand_imag">

<?php
 include 'includes/nav.php';


        if (isset($_GET["msg"])) {
            $msg = sanitizeInput($_GET["msg"]);

            if ($msg == "SUP") {
                echo '<div class="popup">SUCCESSFULL UPDATE PROFILE</div>';
            }
            if ($msg == "UKERR") {
                echo '<div class="popup">Failure: UNKNOWN ERROR</div>';
            }
            if ($msg == "UAAA") {
                echo '<div class="popup">Failure: Unauthorized attempt</div>';
            }
        }
        ?> 

    <div class="form_container">
        <h2 class="login_heading ">Sign Up</h2>
        <form action="profile-action.php" method="post">
            <label class="login_form_label">Name:</label>
            <input type="text"  name="name" value="<?php echo $uname; ?>" required><br><br>

            <label for="email" class="login_form_label">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>


            <label for="address" class="login_form_label">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>"><br><br>

            <label for="phone" class="login_form_label">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="+92 300 9809077" pattern="\+92\s[0-9]{3}\s[0-9]{7}"><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>

<footer>
    <?php include('includes/footer.php');?>
</footer>

</html>

<?php

} else {
    header("Location: dashboard.php");
    exit;
}
?>
