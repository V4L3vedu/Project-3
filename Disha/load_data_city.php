<?php
include ("connector.php");

if(isset($_POST["id"])){
  $id=$_POST["id"];
  $query="SELECT city FROM student_data WHERE id=$id";
  $result=mysqli_query($conn,$query);
  $data=mysqli_fetch_assoc($result);
  $city=$data["city"];


  
  $query_city="SELECT * FROM city WHERE `c_name`='$city'";  
  $result_city=mysqli_query($conn,$query_city);
  $city_data=mysqli_fetch_assoc($result_city);  

  $query_c="SELECT * FROM city";
  $result_c=mysqli_query($conn,$query_c);


  // echo $id;

  $output2='<select class="form-select" aria-label="Default select example" id="city_name" name="city">';

  $output2.="<option value='{$city_data["c_name"]}'>{$city_data["c_name"]}</option>";
  
  while($city_d=mysqli_fetch_assoc($result_c)){  
    $output2.="<option value='{$city_d["c_name"]}'>{$city_d["c_name"]}</option>";
  }
  $output2.="</select>";

  echo $output2;


}else{
  $query_city="SELECT * FROM city";


$result_city=mysqli_query($conn,$query_city);
$output2='<select class="form-select inp-size" aria-label="Default select example" id="city_name" name="city">
<option selected value="selected">Open this select menu</option>';

while($city=mysqli_fetch_assoc($result_city)){
  $output2.="<option value='{$city["c_name"]}'>{$city["c_name"]}</option>";
}
$output2.="</select>";
echo $output2;
}
?>