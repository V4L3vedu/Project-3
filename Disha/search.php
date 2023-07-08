<?php
 include ("connector.php");

 $limit=10;
 $page="";
 if(isset($_POST["page_no"])){
     $page=$_POST["page_no"];
 }else{
     $page=1;
 }
 $offset=($page - 1) * $limit;
 $search=$_POST['val'];

$query_main="SELECT * FROM student_data WHERE sname LIKE '%$search%' OR email LIKE '%$search%' OR city LIKE '%$search%' OR mobile LIKE '%$search%' OR id LIKE '%$search%' LIMIT $offset,$limit";
$result_main=mysqli_query($conn,$query_main) or die("Can't fetch data");



 $output="";  
 


if(mysqli_num_rows($result_main) > 0){
    
        
    $output.='<table class="table  adjustment size">
    <thead>
      <tr>
        <th scope="col">Id &ensp;
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16" id="sort_id">
          <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
          <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
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
        <th scope="col">Operation</th>

        
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
                    <td><img src='p_photo/{$data["photo_name"]}' alt='example placeholder' id='photo_size'/></td>
                    <td>
                    <button type='button' class='btn btn-outline-danger ' id='delet_data_btn' data-id='{$data['id']}'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                                    <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
                                    </svg>
                                    Delete record
                    </button>
                    <button type='button' class='btn btn-outline-success' id='edit_data_btn'>
                  
                    <svg aria-hidden='true' height='16' viewBox='0 0 16 16' version='1.1' width='16' fill='currentColor'   id='edit_data_btn' class='octicon octicon-pencil'>
                      <path d='M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z'></path>
                  </svg>
                    Edit record
                  </button>
                    </td>
                </tr>
        ";
    }
   
    
  $query="SELECT * FROM student_data ";
  $result=mysqli_query($conn,$query) or die("Cant fetch no of rows");
  $row_value=mysqli_num_rows($result);
  $total=ceil($row_value/$limit);

  $output.='<select class="form-select hidden" aria-label="Default select example">
  <option selected>Open this select menu</option>';
while($data_id=mysqli_fetch_assoc($result)){
  
 $output.="<option value='{$data_id['id']}'>{$data_id['id']}</option>";
}
$output.='</select>';
        
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
       
    
}else{
    echo "<h1 id='nodata'>Can't see data</h1>";
}



?>