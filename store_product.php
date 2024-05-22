<?php
session_start();
include("includes/config.php");
include("includes/common.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {


    $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = sanitizeInput($_POST["name"]);
    $author = sanitizeInput($_POST['author']);
    $price = sanitizeInput($_POST['price']);
    $sale_price =sanitizeInput ($_POST['sale_price']);

    
    $targetDirectory = "uploads/";

  
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

       
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit();
        }

       
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, the uploaded file is too large.";
            exit();
        }

        
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            exit();
        }

       
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        
            $stmt = $conn->prepare("INSERT INTO bookdata (image, name, author, price, sale_price) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $targetFile, $name, $author, $price, $sale_price);

            
            if ($stmt->execute()) {
                header("Location: addproductt.php?msg=SAB");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

          
            $stmt->close();
        } else {
            header("Location: addproductt.php?msg=error");
            exit();
        }
    } else {
        header("Location: addproductt.php?msg=NIU");
        exit();
    }
}

$conn->close();


} else {
    header("Location: index.php?msg=UAAA");

}
?>
