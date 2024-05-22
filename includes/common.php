<?php

function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function connect($DBServer, $DBUser, $DBPass, $DBName)
{

    $connect = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
    if ($connect->connect_error) {
        trigger_error('Database connection failed: ' .
            $connect->connect_error, E_USER_ERROR);
    }
    return $connect;
}

function getFullName()
{
    if (isset($_SESSION["name"])) {
        return $_SESSION["name"];
    } else {
        return "Guest";
    }
}

function getUserType()
{
    if (isset($_SESSION["type"])) {
        if ($_SESSION["type"] == 'U')
            return "User";
        if ($_SESSION["type"] == 'A')
            return "Admin";
    } else {
        return "UnAuthorized";
    }
}