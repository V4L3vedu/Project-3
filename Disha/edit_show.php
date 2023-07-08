<?php
include "./connector.php";

$id=$_POST["id"];

$query_main="SELECT * FROM student_data WHERE id=$id";
$result_main=mysqli_query($conn,$query_main) or die("Can't fetch data");

if($result_main){
    $data=mysqli_fetch_assoc($result_main);
    echo json_encode($data);  
    
}else{
    echo "No record found";
}



?>