<?php 
session_start();
include "../DB_connection.php";
include "data/group.php";

if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
    if (isset($_GET['code_gr'])) {
        $code_gr = $_GET['code_gr'];
        if (removeGroup($code_gr, $conn)) {
            $sm = "Successfully deleted!";
            header("Location: groups.php?success=$sm");
            exit;
        } else {
            $em = "Unknown error occurred";
            header("Location: groups.php?error=$em");
            exit;
        }
    } else {
        header("Location: groups.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
