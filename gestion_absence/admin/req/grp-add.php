<?php
session_start();

if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['code_gr']) &&

    isset($_POST['group_n'])) {

    }
   
    
    include '../../DB_connection.php';
    include "../data/group.php";

    $code_gr = $_POST['code_gr'];
    $group_n = $_POST['group_n'];

    $data = 'code_gr='.$code_gr.'&group_n='.$group_n;

    if (empty($code_gr)) {
        $em  = "code_gr is required";
        header("Location: ../group-add.php?error=$em&$data");
        exit;
   
    }else if (empty($group_n)) {
        $em  = "group name is required";
        header("Location: ../group-add.php?error=$em&$data");
        exit;
    } else {
        $sql  = "INSERT INTO group_(code_gr,  group_n )
                 VALUES(?,?)";
        $stmt = $conn->prepare($sql);
        $re   = $stmt->execute([$code_gr, $group_n]);
        if ($re) {
            $sm = "New sector registered successfully";
            header("Location: ../group-add.php?success=$sm");
            exit;
        }else {
            $em = "An error occurred";
            header("Location: ../group-add.php?error=$em");
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