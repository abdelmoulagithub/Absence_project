<?php

// Get sector by ID
function getsectorById($id, $conn){
    $sql = "SELECT * FROM sector
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() == 1) {
      $sector = $stmt->fetch();
      return $sector;
    }else {
     return 0;
    }
 }


 function getsectors($conn){
    $sql = "SELECT * FROM sector";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
 
    if ($stmt->rowCount() >= 1) {
      $sectors = $stmt->fetchAll();
      return $sectors;
    }else {
     return 0;
    }
 }
 

 function removeSector($id, $conn){
  $sql  = "DELETE FROM sector
          WHERE id=?";
  $stmt = $conn->prepare($sql);
  $re   = $stmt->execute([$id]);
  if ($re) {
    return 1;
  }else {
   return 0;
  }
}
 ?>


