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

        // Prepare the delete statement
        $stmt = $conn->prepare("DELETE FROM bookdata WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        if ($result) {
            header("Location: dispaly_book_record.php");
            exit();
        } else {
            echo "Error deleting product: " . $stmt->error;
        }
        
        $stmt->close();
    }

    $conn->close();
} else {
    header("Location: index.php?msg=UAAA");
}
?>
