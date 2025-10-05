<?php
session_start();
include "../DB_connection.php";

if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../logout.php");
    exit;
}

// Récupération et nettoyage des données
$site_name        = trim($_POST['site_name'] ?? '');
$site_email       = trim($_POST['site_email'] ?? '');
$site_phone       = trim($_POST['site_phone'] ?? '');
$site_address     = trim($_POST['site_address'] ?? '');
$site_description = trim($_POST['site_description'] ?? '');
$facebook         = trim($_POST['facebook'] ?? '');
$instagram        = trim($_POST['instagram'] ?? '');
$linkedin         = trim($_POST['linkedin'] ?? '');

// Dossier uploads
$uploadDir = "../uploads/";

// Vérification et upload du logo
$logo = null;
if (!empty($_FILES['logo']['name'])) {
    $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    if (in_array($ext, $allowed)) {
        $logo = "logo_" . time() . "." . $ext;
        move_uploaded_file($_FILES['logo']['tmp_name'], $uploadDir . $logo);
    }
}

// Vérification et upload du favicon
$favicon = null;
if (!empty($_FILES['favicon']['name'])) {
    $ext = strtolower(pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION));
    $allowed = ['ico', 'png'];
    if (in_array($ext, $allowed)) {
        $favicon = "favicon_" . time() . "." . $ext;
        move_uploaded_file($_FILES['favicon']['tmp_name'], $uploadDir . $favicon);
    }
}

// Vérifier si la table a déjà une entrée
$stmt = $conn->query("SELECT COUNT(*) FROM settings WHERE id = 1");
$exists = $stmt->fetchColumn();

if ($exists) {
    $sql = "UPDATE settings 
            SET site_name=?, site_email=?, site_phone=?, site_address=?, site_description=?, 
                facebook=?, instagram=?, linkedin=?, 
                logo = IFNULL(?, logo), 
                favicon = IFNULL(?, favicon) 
            WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $site_name, $site_email, $site_phone, $site_address, $site_description,
        $facebook, $instagram, $linkedin, $logo, $favicon
    ]);
} else {
    $sql = "INSERT INTO settings 
            (id, site_name, site_email, site_phone, site_address, site_description, facebook, instagram, linkedin, logo, favicon) 
            VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $site_name, $site_email, $site_phone, $site_address, $site_description,
        $facebook, $instagram, $linkedin, $logo, $favicon
    ]);
}

header("Location: settings.php?success=Paramètres mis à jour avec succès");
exit;
