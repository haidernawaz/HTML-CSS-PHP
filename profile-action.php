<?php
session_start();
include("includes/config.php");
include("includes/common.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["address"]) && isset($_POST["phone"])) {
        $name = sanitizeInput($_POST["name"]);
        $email = sanitizeInput($_POST["email"]);
        $address = sanitizeInput($_POST["address"]);
        $phone = sanitizeInput($_POST["phone"]);

        $id = 0;
        if (isset($_SESSION["id"]) && $_SESSION["id"]) {
            $id = $_SESSION["id"];
        }


        $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);
        //Insert in user table
        $sql = "UPDATE users SET name=?, email=?, address=?, phone=? WHERE id=?";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        }

        $stmt->bind_param('ssssi', $name, $email, $address, $phone, $id);
        $stmt->execute();

        $conn->close();


        $_SESSION["fn"] = $fn;

        header("Location: profile.php?msg=SUP");
        exit;

    } else {
        header("Location: register.php?msg=UKERR");
        exit;
    }

} else {
    header("Location: index.php?msg=UAAA");
    exit;
}