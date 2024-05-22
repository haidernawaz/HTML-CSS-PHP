<?php
session_start();
include("includes/config.php");
include("includes/common.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {

    $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM users WHERE id = $id";
    $result = $conn->query($query);

    if ($result) {
        
        header("Location: display_user_record.php");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$conn->close();

} else {
    header("Location: index.php?msg=UAAA");

}
?>
