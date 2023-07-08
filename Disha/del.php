<?php
 include "./connector.php";

 $id=$_POST["id"];



$query_show="SELECT * FROM `student_data` WHERE `id`='$id'";
$result_show=mysqli_query($conn,$query_show);
$data=mysqli_fetch_assoc($result_show);
$p_name=$data["photo_name"];

$query="DELETE FROM `student_data` WHERE `id`='$id'";
$result=mysqli_query($conn,$query);
 if($result){
   unlink("./p_photo/$p_name");
   
   echo "1";
 }else{
    echo "2";
 }


?>