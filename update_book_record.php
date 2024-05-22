<?php
session_start();
include("includes/config.php");
include("includes/common.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {

    $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = sanitizeInput($_POST['id']);
        $name = sanitizeInput($_POST['name']);
        $author = sanitizeInput($_POST['author']);
        $price = sanitizeInput($_POST['price']);
        $salePrice = sanitizeInput($_POST['sale_price']);

        // Prepare the update statement
        $stmt = $conn->prepare("UPDATE bookdata SET name = ?, author = ?, price = ?, sale_price = ? WHERE id = ?");
        $stmt->bind_param("ssddi", $name, $author, $price, $salePrice, $id);
        $result = $stmt->execute();

        if ($result) {
            header("Location: dispaly_book_record.php");
            exit();
        } else {
            echo "Error updating product: " . $stmt->error;
        }
    } else {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Prepare the select statement
            $stmt = $conn->prepare("SELECT * FROM bookdata WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $name = $row['name'];
                $author = $row['author'];
                $price = $row['price'];
                $salePrice = $row['sale_price'];
            } else {
                echo "Product not found.";
                exit();
            }
        } else {
            echo "Invalid request.";
            exit();
        }
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php?msg=UAAA");
}
?>

<!-- HTML form for updating product -->
<!DOCTYPE html>
<html>
<head>
    <title>Update Book</title>
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        /* Mobile-first styles */
    </style>
</head>
<body class="body_update_action">
    <div class="container_update_action">
        <h2 class="update_action">Update Book</h2>
        <form method="post" action="update_book_record.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        
            <div class="form_update_action">
                <label for="name">Book Name:</label>
                <input type="text" id="name" class="form_update_action_input" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form_update_action">
                <label for="author">Author Name:</label>
                <input type="text" id="author" class="form_update_action_input" name="author" value="<?php echo $author; ?>" required>
            </div>
            <div class="form_update_action">
                <label for="price">Price:</label>
                <input type="number" id="price" class="form_update_action_input" name="price" value="<?php echo $price; ?>" required>
            </div>
            <div class="form_update_action">
                <label for="sale_price">Sale Price:</label>
                <input type="number" id="sale_price" class="form_update_action_input" name="sale_price" value="<?php echo $salePrice; ?>">
            </div>
            <button type="submit" class="btn_update_action">Update</button>
        </form>
    </div>
</body>
</html>
