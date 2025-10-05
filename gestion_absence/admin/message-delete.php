<?php
session_start();
include "../DB_connection.php";

if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../logout.php");
    exit;
}

if (!isset($_GET['code_message'])) {
    header("Location: messageAff.php?error=Code message manquant");
    exit;
}

$code_message = $_GET['code_message'];

// Supprimer le message
$sql = "DELETE FROM messages_clients WHERE code_message=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$code_message]);

header("Location: messageAff.php?success=Message supprimé avec succès");
exit;
