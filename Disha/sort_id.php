<?php
 include ("connector.php");

$order=$_POST["type"];
// if($order=="ASC"){
//   $order="DESC";
// }else{
//   $order="ASC";

// }


 $limit=10;
 $page="";
 if(isset($_POST["page_no"])){
     $page=$_POST["page_no"];
 }else{
     $page=1;
 }
 $offset=($page - 1) * $limit;

$query_main="SELECT * FROM student_data ORDER BY id $order LIMIT $offset,$limit";
$result_main=mysqli_query($conn,$query_main) or die("Can't fetch data");



 $output="";
 


if(mysqli_num_rows($result_main) > 0){
    
        
    $output.='<table class="table  adjustment size">
    <thead>
      <tr>
        <th scope="col">Id &ensp;
     
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sort-numeric-up-alt" viewBox="0 0 16 16" id="sort_id" data-sort="asc">
      <path fill-rule="evenodd" d="M11.36 7.098c-1.137 0-1.708-.657-1.762-1.278h1.004c.058.223.343.45.773.45.824 0 1.164-.829 1.133-1.856h-.059c-.148.39-.57.742-1.261.742-.91 0-1.72-.613-1.72-1.758 0-1.148.848-1.836 1.973-1.836 1.09 0 2.063.637 2.063 2.688 0 1.867-.723 2.848-2.145 2.848zm.062-2.735c.504 0 .933-.336.933-.972 0-.633-.398-1.008-.94-1.008-.52 0-.927.375-.927 1 0 .64.418.98.934.98z"/>
      <path d="M12.438 8.668V14H11.39V9.684h-.051l-1.211.859v-.969l1.262-.906h1.046zM4.5 13.5a.5.5 0 0 1-1 0V3.707L2.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L4.5 3.707V13.5z"/>
    </svg>
        </th>

        <th scope="col">Name &ensp;
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16" id="sort_name">
        <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
        <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
      </svg>
        </th>
        <th scope="col">Age</th>
        <th scope="col">Mobile no</th>
        <th scope="col">Email</th>
        <th scope="col">Gender</th>
        <th scope="col">City</th>
        <th scope="col">Photo</th>
        
      </tr>
    </thead>
    <tbody>';
  while($data=mysqli_fetch_assoc($result_main)){

        $output.="<tr>
                    <td>{$data['id']}</td>
                    <td>{$data['sname']}</td>
                    <td>{$data['age']}</td>
                    <td>{$data['mobile']}</td>
                    <td>{$data['email']}</td>
                    <td>{$data['gender']}</td>
                    <td>{$data['city']}</td>
                    <td>{$data['photo_name']}</td>
                </tr>
        ";
    }
    
  $query="SELECT * FROM student_data";
  $result=mysqli_query($conn,$query) or die("Cant fetch no of rows");
  $row_value=mysqli_num_rows($result);
  $total=ceil($row_value/$limit);
        
    $output.="</tbody>
  </table>
<div class='spacing_at_end'>
  <nav aria-label='Page navigation example change'>
    <ul class='pagination justify-content-end'>";
    
   
 
    $sub=$page-1; 
    if($offset>=1){
      $output.="<li class='page-item'>
      <a class='page-link' tabindex='-1' id='$sub'>Previous</a>";
  }else{
      $output.=' <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>';
  }

      for($i=1;$i<=$total;$i++){
        if($i == $page){
            $class="active";
        }else{
            $class="";
        }
        $output.="<li class='page-item'><a class='page-link $class' href='$i' id='$i'>$i</a></li>";
      }

      $add=$page+1;

                              
     if($total == $page){
      $output.='<li class="page-item disabled">
      <a class="page-link">Next</a>';
       }else{
      $output.="<a class='page-link'  id='$add' href='$add'>Next</a>";
   }

     $output.="</li>
    </ul>
  </nav>
  </div>";

echo $output;
echo "<input type='text' value='ASC' class='hidden order'>";       
    
}



?>