<?php 


session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    
 if (isset($_POST['id']) &&
    isset($_POST['sector_name']) &&
    isset($_POST['code_sec']) 
  
    ) {
    	

      
    include '../../DB_connection.php';
    include "../data/sector.php";
    // include "../sector-edit.php";

    $code_sec = $_POST['code_sec'];
    $sector_name = $_POST['sector_name'];
    $id = $_POST['id'];
    
   
      $data = 'id='.$id.'&sector_name='.$sector_name.'&code_sec='.$code_sec;
    
   

    
      if (empty($id)) {
		$em  = "id is required";
		header("Location: ../sector-edit.php?error=$em&$data");
		exit;
      }else  if (empty($code_sec)) {
		$em  = "code_sec is required";
		header("Location: ../sector-edit.php?error=$em&$data");
		exit;
	}else if (empty($id)) {
		$em  = "id is required";
		header("Location: ../sector-edit.php?error=$em&$data");
		exit;
	}else if (empty($sector_name)) {
		$em  = "sector_name is required";
		header("Location: ../sector-edit.php?error=$em&$data");
		exit;
  
	
	}else {
        $sql = "UPDATE sector SET
        code_sec=?, sector_name=?
        WHERE id=?";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$code_sec, $sector_name, $id ])){
        $sm = "successfully updated!";
        header("Location: ../sector-edit.php?success=$sm&$data");
        exit;
      }else{
      
        $em = "Failed to execute the update.";
        header("Location: ../sector-edit.php?error=$em&$data");
        exit;
      }


      //   UPDATE students SET
      //   fname_st=?, lname_st=?, sector_name=?, mail=? , phone_st=?
      //  WHERE id_st=?





	}
    
  }else {
    	
echo "else";

  	$em = "An error occurred";
    header("Location: ../sector-edit.php?error=$em");
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
