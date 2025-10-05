<!-- page de formule d ajouter -->

<?php 

session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../DB_connection.php";


       $code_gr = '';
      
       $group_n = '';



       if (isset($_GET['code_gr'])) $code_gr = $_GET['code_gr'];
       if (isset($_GET['group_n'])) $group_n = $_GET['group_n'];

       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Add group</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/back2.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <?php 
        include "inc/navbar.php";
     ?>
     <div class="container mt-5">
        <a href="groups.php"
           class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/grp-add.php">
              <!-- req/teacher-add.php -->
        <h3>Add New Group</h3><hr>

        <!-- mess de remplissage des case d'ajout -->
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
           <?=$_GET['error']?>
          </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
           <?=$_GET['success']?>
          </div>
        <?php } ?>

        <div class="mb-3">
          <label class="form-label">code_gr</label>
          <input type="number" 
                 class="form-control"
                 value="<?=$code_gr?>"
                 name="code_gr">
        </div>
        
        <div class="mb-3">
          <label class="form-label">group_n</label>
          <input type="number" 
                 class="form-control"
                 value="<?=$group_n?>"
                 name="group_n">
        </div>

       
        
      <button type="submit" class="btn btn-primary">Add</button>
     </form>
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(4) a").addClass('active');
        });

       
    </script>

</body>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>