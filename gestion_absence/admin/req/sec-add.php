<?php
session_start();

if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['code_sec']) &&
    isset($_POST['id']) &&
    isset($_POST['sector_name'])) {
        
    }
   
    
    include '../../DB_connection.php';
    include "../data/sector.php";

    $code_sec = $_POST['code_sec'];
    $id = $_POST['id'];
    $sector_name = $_POST['sector_name'];

    $data = 'code_sec='.$code_sec.'&id='.$id.'&sector_name='.$sector_name;
    
    if (empty($code_sec)) {
        $em  = "code_sec is required";
        header("Location: ../sector-add.php?error=$em&$data");
        exit;
    }else if (empty($id)) {
        $em  = "id is required";
        header("Location: ../sector-add.php?error=$em&$data");
        exit;
    }else if (empty($sector_name)) {
        $em  = "sector_name is required";
        header("Location: ../sector-add.php?error=$em&$data");
        exit;
    } else {
        $sql  = "INSERT INTO sector(code_sec,  sector_name ,id)
                 VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        $re   = $stmt->execute([$code_sec, $sector_name, $id]);
        if ($re) {
            $sm = "New sector registered successfully";
            header("Location: ../sector-add.php?success=$sm");
            exit;
        }else {
            $em = "An error occurred";
            header("Location: ../sector-add.php?error=$em");
            exit;
        }
    }
        
 

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
	header("Location: ../../logout.php");
	exit;
}
?>