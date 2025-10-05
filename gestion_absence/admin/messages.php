<?php 
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    include "../DB_connection.php";

    $data = 'email='.$email.'&name='.$name.'&message='.$message;

    if (empty($email)) {
        $em  = "Email is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else if (empty($name)) {
        $em  = "Name is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else if (empty($message)) {
        $em  = "Message is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else {
        try {
            $sql = "INSERT INTO messages_clients (email, name, message, statut) 
                    VALUES (?, ?, ?, 'non_lu')";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email, $name, $message]);

            $sm = "Message envoyé avec succès !";
            header("Location: ../index.php?success=$sm");
            exit;
        } catch (PDOException $e) {
            $em = "Erreur lors de l'enregistrement : ".$e->getMessage();
            header("Location: ../index.php?error=$em&$data");
            exit;
        }
    }
} else {
    header("Location: ../index.php?error=Veuillez remplir tous les champs");
    exit;
}
