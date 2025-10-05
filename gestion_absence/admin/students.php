<?php 
session_start();
include "../DB_connection.php";
include "data/students_func.php";

if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
    if(isset($_POST['submit'])) {
        if(!empty($_POST['sector']) && !empty($_POST['group'])){
            $selected_sector = $_POST['sector'];
            $selected_group = $_POST['group'];
            $students = getAllstudents($conn, $selected_sector, $selected_group);
        } else {
            $em = "Please select both sector and group.";
            header("Location: students.php?error=$em");
            exit;
        }
    } else {
        $sql = "SELECT * FROM students";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $students = $stmt->fetchAll();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Students</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/style.css">
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
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">

    <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger mt-3 n-table" role="alert">
                        <?= $_GET['error'] ?>
                    </div>
                <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-info mt-3 n-table" role="alert">
                        <?= $_GET['success'] ?>
                    </div>
                <?php } ?>
        <a href="student-add.php" class="btn btn-dark">Add New Student</a>
        <br><br><br>
        <div class="form-container d-flex align-items-center">
            <form method="post" class="w-100 d-flex">
                <label for="sector" class="me-2">Select Sector:</label>
                <select class="form-select me-2 w-50" name="sector" id="sector">
                    <option selected disabled>Select Sector</option>
                    <option value="DD">DD</option>
                    <option value="ID">ID</option>
                    <option value="GE">GE</option>
                </select>
                <label for="group" class="me-2">Select Group:</label>
                <select class="form-select me-2 w-50" name="group" id="group">
                    <option selected disabled>Select Group</option>
                    <option value="101">101</option>
                    <option value="102">102</option>
                    <option value="103">103</option>
                    <option value="104">104</option>
                </select>
                <button type="submit" name="submit" class="btn btn-primary">Show Students</button>
            </form>
        </div>

        <br>
        <?php if (isset($students)) { ?>
            <?php if ($students != 0) { ?>
                

                <div class="table-responsive">
                    <table class="table table-bordered mt-3 n-table">
                        <thead>
                            <tr>
                                <th scope="col">id_st</th>
                                <th scope="col">fname_st</th>
                                <th scope="col">lname_st</th>
                                <th scope="col">sector</th>
                                <th scope="col">group</th>
                                <th scope="col">mail</th>
                                <th scope="col">phone</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student) { ?>
                                <tr>
                                    <td><?= $student['id_st'] ?></td>
                                    <td><?= $student['fname_st'] ?></td>
                                    <td><?= $student['lname_st'] ?></td>
                                    <td><?= $student['sector_name'] ?></td>
                                    <td><?= $student['group_n'] ?></td>
                                    <td><?= $student['mail'] ?></td>
                                    <td><?= $student['phone_st'] ?></td>
                                    <td>
                                        <a href="student-edit.php?id_st=<?= $student['id_st'] ?>" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <a href="student-delete.php?id_st=<?= $student['id_st'] ?>" onclick="return confirm('Are you sure you want to delete this student?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="alert alert-info mt-3 n-table" role="alert">
                    No students found.
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(3) a").addClass('active');
        });
    </script>
</body>
</html>
<?php 
} else {
    header("Location: ../login.php");
    exit;
} 
?>
