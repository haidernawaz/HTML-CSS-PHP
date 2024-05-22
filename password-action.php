<?php
session_start();
include("includes/config.php");
include("includes/common.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    if (isset($_POST["ps1"]) && isset($_POST["ps2"])) {
        $ps1 = sanitizeInput($_POST["ps1"]);
        $ps2 = sanitizeInput($_POST["ps2"]);

        $id = 0;
        if (isset($_SESSION["id"]) && $_SESSION["id"]) {
            $id = $_SESSION["id"];
        }

        $pscorrect = false;

        if ($ps1 == $ps2) {
            $pscorrect = true;
        }

        if (!$pscorrect) {
            header("Location: password.php?msg=PWDNM");
            exit;
        }

        $hash = password_hash($ps1, PASSWORD_DEFAULT);

        $conn = connect($dbserver, $dbuser, $dbpassword, $dbname);
        // Update user table with new password
        $sql = "UPDATE users SET password=? WHERE id=?";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        }

        $stmt->bind_param('si', $hash, $id);
        $result = $stmt->execute();

        if ($result) {
            header("Location: password.php?msg=SUP");
            exit;
        } else {
            header("Location: password.php?msg=PWDNM");
        }

        $stmt->close();
        $conn->close();

    } else {
        header("Location: register.php?msg=UKERR");
        exit;
    }
} else {
    header("Location: index.php?msg=UAAA");
    exit;
}
?>
