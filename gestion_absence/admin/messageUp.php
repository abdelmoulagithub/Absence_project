<?php
session_start();
include "../DB_connection.php";

if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
  echo 1;
    if (isset($_GET['code_message'])) {
        $code_message = $_GET['code_message'];

        // Vérifier que le message existe
        $sql = "SELECT statut FROM messages_clients WHERE code_message=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$code_message]);

        if ($stmt->rowCount() > 0) {
            $message = $stmt->fetch(PDO::FETCH_ASSOC);
            $current_statut = $message['statut'];

            // Logique de cycle des statuts
            if ($current_statut == 'non_lu') {
                $new_statut = 'lu';
            } elseif ($current_statut == 'lu') {
                $new_statut = 'traite';
            } else {
                $new_statut = 'non_lu';
            }

            // Mise à jour
            $sql = "UPDATE messages_clients SET statut=? WHERE code_message=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$new_statut, $code_message]);
echo 2;
            header("Location: messageAff.php?success=Statut changé en $new_statut");
            exit;
        } else {
            header("Location: messageAff.php?error=Message introuvable");
            exit;
        }
        echo 3;

    } else {
        header("Location: messageAff.php?error=Code message manquant");
        exit;
    }
echo 4;
} else {
    header("Location: ../logout.php");
    exit;
}
