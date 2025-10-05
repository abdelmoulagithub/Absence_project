<?php 
// All group
// All group
function getAllgroup($conn){
   $sql = "SELECT * FROM group_";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   return $stmt->fetchAll();
}

// Get Group by ID
function getgroupById($code_gr, $conn){
   $sql = "SELECT * FROM group_
           WHERE code_gr=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$code_gr]);

   if ($stmt->rowCount() == 1) {
     $group = $stmt->fetch();
     return $group;
   }else {
    return 0;
   }
}



 function removeGroup($code_gr, $conn){
  $sql  = "DELETE FROM group_
          WHERE code_gr=?";
  $stmt = $conn->prepare($sql);
  $re   = $stmt->execute([$code_gr]);
  if ($re) {
    return 1;
  }else {
   return 0;
  }
}




