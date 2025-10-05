<?php
session_start();

if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['id_st']) &&
    isset($_POST['sector_name']) &&
    isset($_POST['mail']) &&
    isset($_POST['phone']) &&
    isset($_POST['group_n'])) { // Ajout de group_n
    
    include '../../DB_connection.php';
    include "../data/students_func.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $id_st = $_POST['id_st'];
    $sector_name = $_POST['sector_name'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $group_n = $_POST['group_n']; // Ajout de group_n
    
    $data = 'id_st='.$id_st.'&fname='.$fname.'&lname='.$lname.'&sector_name='.$sector_name.'&mail='.$mail.'&phone='.$phone.'&group_n='.$group_n;

    if (empty($id_st)) {
		$em  = "id is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($fname)) {
		$em  = "First name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Last name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	
	}else if (empty($sector_name)) {
		$em  = "sector_name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
    }else if (empty($mail)) {
		$em  = "mail is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
    }else if (empty($phone)) {
		$em  = "phone is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($group_n)) {
        $em  = "group is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else {
        // Générer le username et le mot de passe
        $username = strtolower(trim($fname) . '.' . trim($lname));
        $standard_password = 'student2025';
        $hashed_password = password_hash($standard_password, PASSWORD_DEFAULT);

        $sql  = "INSERT INTO students(username, password, fname_st, lname_st, sector_name, mail, phone_st, group_n)
                 VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $hashed_password, $fname, $lname, $sector_name, $mail, $phone, $group_n]);

        $sm = "New student registered successfully";
        header("Location: ../student-add.php?success=$sm");
        exit;
    }
    
  }else {
  	$em = "An error occurred";
    header("Location: ../student-add.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
	header("Location: ../../logout.php");
	exit;
}

$fname_st = isset($_POST['fname_st']) ? $_POST['fname_st'] : '';
$lname_st = isset($_POST['lname_st']) ? $_POST['lname_st'] : '';
$group_n = isset($_POST['group_n']) ? $_POST['group_n'] : '';
$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$phone_st = isset($_POST['phone_st']) ? $_POST['phone_st'] : '';
$sector_name = isset($_POST['sector_name']) ? $_POST['sector_name'] : '';

// Générer le username
$username = strtolower(trim($fname_st) . '.' . trim($lname_st));

// Pour debug : afficher le username et stopper le script
// echo $username;
// exit;

// Mot de passe standard hashé
$standard_password = 'student2025';
$hashed_password = password_hash($standard_password, PASSWORD_DEFAULT);

$sql  = "INSERT INTO students(username, password, fname_st, lname_st, sector_name, mail, phone_st)
         VALUES(?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$username, $hashed_password, $fname_st, $lname_st, $sector_name, $mail, $phone_st]);
