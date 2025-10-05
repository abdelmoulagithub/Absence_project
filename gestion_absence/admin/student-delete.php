<?php 
session_start();
include "../DB_connection.php";
include "data/students_func.php";

if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
    if (isset($_GET['id_st'])) {
        $id_st = $_GET['id_st'];
        if (removeStudent($id_st, $conn)) {
            $sm = "Successfully deleted!";
            header("Location: students.php?success=$sm");
            exit;
        } else {
            $em = "Unknown error occurred";
            header("Location: students.php?error=$em");
            exit;
        }
    } else {
        header("Location: students.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
