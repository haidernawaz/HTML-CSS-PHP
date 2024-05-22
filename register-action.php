<?php
session_start();
include("includes/config.php");
include("includes/common.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("Location: dashboard.php");
} else {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["address"]) && isset($_POST["phone"])) {
        $name = sanitizeInput($_POST["name"]);
        $email = sanitizeInput($_POST["email"]);
        $password = sanitizeInput($_POST["password"]);
        $address = sanitizeInput($_POST["address"]);
        $phone = sanitizeInput($_POST["phone"]);
        $hpwd = password_hash($password, PASSWORD_DEFAULT);

        $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);
        //Insert in user table
        $sql = "INSERT INTO users (name, email, password, address, phone, type) VALUES (?,?,?,?,?,'U')";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        }

        $stmt->bind_param('sssss', $name, $email, $hpwd, $address, $phone);
        $stmt->execute();

        $conn->close();

        header("Location: index.php?msg=SRA");

    } else {
        header("Location: register.php?msg=UKERR");
    }

}