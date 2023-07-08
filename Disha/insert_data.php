<?php 
include("connector.php");
   

if($_SERVER['REQUEST_METHOD']=='POST'){
// $name=$_POST["data"];
// echo $name;

$name=$_POST["sname"];  
$photo=$_FILES["photo"]; 
$photo_name=time().$photo["name"];

$age=$_POST["age"]; 
$gender=$_POST["gender"];
$number=$_POST["number"];  
$email=$_POST["email"];  
$city=$_POST["city"]; 
$id=$_POST["id"]; 
$photo_feild=$_POST["photo_feild"]; 






if($id==""){
    // echo "<pre>";
    // print_r($_POST);

   
    $query="INSERT INTO `student_data`(`sname`, `age`, `mobile`, `email`, `gender`, `photo_name`, `city`) VALUES ('$name','$age','$number','$email','$gender','$photo_name','$city')";
    $result=mysqli_query($conn,$query) or die("can'sert");
    move_uploaded_file($photo['tmp_name'],"p_photo/".$photo_name);  
    if($result){
        echo "2";
    }else{
        echo "4";
    
    }

}else{
    // echo "<pre>";
    // print_r($_POST);
    $id=$_POST["id"];
    $query_S="SELECT * FROM student_data WHERE id='$id'";
    $result_S=mysqli_query($conn,$query_S) or die("can'sert");
    $data=mysqli_fetch_assoc($result_S);


    if($data){

        $photo_name_old=$data["photo_name"];
    
      

     

            if($photo_feild==""){

                unlink("./p_photo/$photo_name_old");
                move_uploaded_file($photo['tmp_name'],"p_photo/".$photo_name); 

                $query="UPDATE `student_data` SET `sname`='$name', `age`='$age',`mobile`='$number',`gender`='$gender', `email`='$email', `photo_name`='$photo_name', `city`='$city' WHERE id='$id'";
            }else{
                $query="UPDATE `student_data` SET `sname`='$name', `age`='$age',`mobile`='$number',`gender`='$gender', `email`='$email',`city`='$city' WHERE id='$id'";

            }
            $result=mysqli_query($conn,$query) or die("can't update");

              
                
                if($result){
                    // echo $photo['tmp_name'];
                    echo "0";
                }else{
                    echo "1";
                
                }
            
           
       
    }
 
  

    
}



}

?>