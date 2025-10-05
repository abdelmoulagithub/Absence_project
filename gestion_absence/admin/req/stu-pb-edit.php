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
    isset($_POST['group_n']) &&
    isset($_POST['phone'])) {
    	

      
    include '../../DB_connection.php';
    include "../data/students_func.php";
    // include "../student-edit.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $id_st = $_POST['id_st'];
    $sector_name = $_POST['sector_name'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $group_n = $_POST['group_n'];
    
    $id_st = $_POST['id_st'];
    
   
      $data = 'id_st='.$id_st.'&fname='.$fname.'&lname='.$lname.'&sector_name='.$sector_name.'&mail='.$mail.'&phone='.$phone.'&group_n='.$group_n;


    
      if (empty($id_st)) {
		$em  = "id is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
      }else  if (empty($fname)) {
		$em  = "First name is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Last name is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
	}else if (empty($sector_name)) {
		$em  = "sector_name is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
  }else if (empty($group_n)) {
		$em  = "group_n is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
    }else if (empty($mail)) {
		$em  = "mail is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
    }else if (empty($phone)) {
		$em  = "phone is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
	
	}else {
        $sql = "UPDATE students SET
        fname_st=?, lname_st=?, sector_name=?, mail=?, phone_st=? , group_n=?
        WHERE id_st=?";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$fname, $lname, $sector_name,$mail, $phone, $group_n, $id_st ])){
        $sm = "successfully updated!";
        header("Location: ../student-edit.php?success=$sm&$data");
        exit;
      }else{
      
        $em = "Failed to execute the update.";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
      }


      //   UPDATE students SET
      //   fname_st=?, lname_st=?, sector_name=?, mail=? , phone_st=?
      //  WHERE id_st=?





	}
    
  }else {
    	
echo "else";

  	$em = "An error occurred";
    header("Location: ../student-edit.php?error=$em");
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
