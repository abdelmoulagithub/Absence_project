<?php
// All students 
function getAllStudents($conn,$selected_sector, $selected_group ){
    $sql = "SELECT students.id_st, students.fname_st, students.lname_st, students.mail, students.phone_st, sector.sector_name, group_.group_n
    FROM students
    JOIN sector ON students.sector_name = sector.code_sec
    JOIN group_ ON students.group_n = group_.code_gr
    WHERE sector.sector_name = ? AND group_.group_n = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$selected_sector,$selected_group]);
 
    if ($stmt->rowCount() >= 1) {
      $students = $stmt->fetchAll();
      return $students;
    }else {
        return 0;
    }
 }

 

//edit student by id

function StudentByid($conn,$id_st){
  $sql = "select * from students where id_st=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id_st]);

  if($stmt->rowcount()==1){
    $student=$stmt->fetch();

    return $student;

  } else{
    return 0;
  }
}





 // DELETE
function removeStudent($id_st, $conn){
  $sql  = "DELETE FROM students
          WHERE id_st=?";
  $stmt = $conn->prepare($sql);
  $re   = $stmt->execute([$id_st]);
  if ($re) {
    return 1;
  }else {
   return 0;
  }
}