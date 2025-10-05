<?php 


session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

 if (isset($_POST['code_gr']) &&
    isset($_POST['group_n']) 

    ) {
    	echo "1";

      
    include '../../DB_connection.php';
    include "../data/group.php";
    // include "../sector-edit.php";

    $code_gr = $_POST['code_gr'];
    $group_n = $_POST['group_n'];

      $data = 'code_gr='.$code_gr.'&group_n='.$group_n;

      if (empty($code_gr)) {
		$em  = "code_gr is required";
		header("Location: ../group-edit.php?error=$em&$data");
        echo "2";
		exit;
      }else  if (empty($group_n)) {
		$em  = "group_n is required";
		header("Location: ../group-edit.php?error=$em&$data");
		echo "3";
        exit;
	
		
  echo "11";
	
	}else {
        echo "4";
        $sql = "UPDATE group_ SET
        code_gr=?, group_n=?
        WHERE code_gr=?";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$code_gr, $group_n,$code_gr ])){
        $sm = "successfully updated!";
        header("Location: ../group-edit.php?success=$sm&$data");
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
    header("Location: ../group-edit.php?error=$em");
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
