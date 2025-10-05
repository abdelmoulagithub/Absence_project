<?php
session_start();
include "../DB_connection.php";

if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../logout.php");
    exit;
}

// Charger les réglages existants
$stmt = $conn->query("SELECT * FROM settings WHERE id=1 LIMIT 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Site Settings</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<link rel="icon" href="../img/back2.png">
<style>
        /* --- Design Modern Admin Dashboard --- */
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Container principale */
        .container {
            margin-top: 60px;
        }

        /* Les cartes principales (boutons) */
        a.btn {
            border-radius: 16px !important;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            border: none !important;
        }

        /* Icônes */
        a.btn i {
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        /* Effet hover */
        a.btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        a.btn:hover i {
            transform: scale(1.2);
        }

        /* Couleurs personnalisées */
        .btn-dark {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: #fff;
        }

        .btn-dark:hover {
            background: linear-gradient(135deg, #1e2a36, #2c3e50);
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056d2);
            color: #fff;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: #fff;
        }

        /* Barre de navigation */
        .navbar {
            background: #2c3e50 !important;
            padding: 12px 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .navbar a {
            color: #ecf0f1 !important;
            font-weight: 500;
            margin-right: 15px;
            transition: color 0.3s;
        }

        .navbar a:hover, 
        .navbar a.active {
            color: #3498db !important;
        }
    </style>
</head>
<body>
<?php include "inc/navbar.php"; ?>
<div class="container mt-5">
    <h3> Paramètres du site</h3>
    <form action="settings-save.php" method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nom du site</label>
                <input type="text" name="site_name" class="form-control" value="<?= $settings['site_name'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label>Email de contact</label>
                <input type="email" name="site_email" class="form-control" value="<?= $settings['site_email'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label>Téléphone</label>
                <input type="text" name="site_phone" class="form-control" value="<?= $settings['site_phone'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label>Adresse</label>
                <input type="text" name="site_address" class="form-control" value="<?= $settings['site_address'] ?? '' ?>">
            </div>
            <div class="col-12 mb-3">
                <label>Description du site</label>
                <textarea name="site_description" class="form-control" rows="3"><?= $settings['site_description'] ?? '' ?></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
                <?php if (!empty($settings['logo'])): ?>
                    <img src="../uploads/<?= $settings['logo'] ?>" height="50" class="mt-2">
                <?php endif; ?>
            </div>
            <div class="col-md-6 mb-3">
                <label>Favicon</label>
                <input type="file" name="favicon" class="form-control">
                <?php if (!empty($settings['favicon'])): ?>
                    <img src="../uploads/<?= $settings['favicon'] ?>" height="30" class="mt-2">
                <?php endif; ?>
            </div>
            <div class="col-md-4 mb-3">
                <label>Facebook</label>
                <input type="text" name="facebook" class="form-control" value="<?= $settings['facebook'] ?? '' ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label>Instagram</label>
                <input type="text" name="instagram" class="form-control" value="<?= $settings['instagram'] ?? '' ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label>LinkedIn</label>
                <input type="text" name="linkedin" class="form-control" value="<?= $settings['linkedin'] ?? '' ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary"> Sauvegarder</button>
    </form>
</div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(7) a").addClass('active');
        });
    </script>
</body>
</html>
