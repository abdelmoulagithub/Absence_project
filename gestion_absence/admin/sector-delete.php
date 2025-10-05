<?php 
session_start();
include "../DB_connection.php";
include "data/sector.php";

if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (removeSector($id, $conn)) {
            $sm = "Successfully deleted!";
            header("Location: sectors.php?success=$sm");
            exit;
        } else {
            $em = "Unknown error occurred";
            header("Location: sectors.php?error=$em");
            exit;
        }
    } else {
        header("Location: sectors.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
