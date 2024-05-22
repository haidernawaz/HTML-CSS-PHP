<?php
session_start();
include("includes/config.php");
include("includes/common.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("Location: dashboard.php");
} else {
    if (isset($_POST["email"]) && isset($_POST["password"])) {

        $email = sanitizeInput($_POST["email"]);
        $password = sanitizeInput($_POST["password"]);
        

        $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);
        
        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        }

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        $rowcounter = $stmt->num_rows;
        if ($rowcounter > 0) {
            $stmt->bind_result($id, $name, $email, $hpwd, $address, $phone, $type);
            $stmt->fetch();
            
            $stmt->free_result();
            $conn->close();

            if (password_verify($password, $hpwd)) {
                $_SESSION["loggedin"] = true;
                $_SESSION["type"] = $type;
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;
                $_SESSION["id"] = $id;

                setcookie("email", $email, time() + 60 * 60 * 24 * 30);
                header("Location: dashboard.php");
                exit;
            } else {
                header("Location: index.php?msg=IPW");
                exit;
            }

        } else {
            header("Location: index.php?msg=IEA");
            exit;
        }

    } else {
        header("Location: register.php?msg=UKERR");
        exit;
    }
}