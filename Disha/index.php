<?php include("connector.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Resigration</title>
 
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />    
   
    
</head>
<body>
      <!-- add rec -->
      <button type="button" class="btn btn-outline-primary add_record" id="add">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
          </svg>
          Add recorde 
        </button>
 
      </div>
      <!-- /add rec -->
      <!-- search -->
      <div class="search">
        <div class="form-group mx-sm-3 mb-2">
            <label for="inputPassword2" class="sr-only"></label>
            <input type="text" class="form-control" id="search" placeholder="Search" name="search">
        </div>
        <div class="mb-3">
          <span class="cancel_btn" id="cancel_btn">&times;</span>
            <button type="button" class="btn btn-primary btn-search">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                </svg>
                Search
              </button>  
            </div>
          </div>         
          <!-- /search -->
          
          
          <!-- table -->
          <div class="table table-responsive margin">
            </div>
            <!-- /table -->
            
            
            <!-- modal -->
      <div class="modal" id="Modal1">
        <span class="cancel_btn_modal text-end" id="cancel_btn_modal" >&times;</span>
        <div class="" role="document">
     
            <form id="form_add" class="adjust"> <br>
                    <p class="text-center"><b>Insert your Record</b></p>
                                  <input type="text" id="ans" class="none" name="gender"/>
                                  <input type="text" id="id" class="none" name="id"/>
                                  <input type="text" id="photo_path" class="none" name="photo_feild"/>
              
              
                                  <div class="form-row">
                                      <img src="insert.png" alt="example placeholder" class="pic-size is-valid" id="imgg" onclick="document.getElementById('inp_photo').click()"/>
                                      <div class="d-flex justify-content-center" style="display: none;">
                                          <label class="form-label text-white m-1" id="custom" for="custom" style="display: none;">Choose file</label>
                                          <input type="file" class="form-control" id="inp_photo" onchange="i(event)" name="photo" style="display: none;" required/>              
                                      </div>
                                  </div>
                                  <div class="col-md-4 mb-3">
                                        <label for="name">Student name</label>
                                        <input type="text" class="form-control inp-size" id="name" placeholder="Student name" name="sname" required>
                                        <div class="valid-feedback">
                                          Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                          Please choose a name.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                      <label for="email">Email</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                        </div>
                                        <input type="email" class="form-control inp-size" id="email" aria-describedby="emailHelp" name="email" placeholder="Enter email">

                                        <div class="invalid-feedback">
                                          Please insert valid  email.
                                        </div>
                                        <div class="valid-feedback">
                                          Looks good!
                                        </div>
                                      </div>
                                    </div>
                                
                                
                                    <div class="col-md-6 mb-3">
                                    <label for="city_name" class="col-sm-2 col-form-label">City</label>
                                    <div id="city"></div>
                                      <div class="invalid-feedback">
                                        Please provide a valid city.
                                      </div>
                                      <div class="valid-feedback">
                                          Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="age">Age</label>
                                        <input type="number" class="form-control inp-size" id="age" placeholder="Age" name="age"  required>
                                      <div class="invalid-feedback">
                                        Please provide a valid Age.
                                      </div>
                                      <div class="valid-feedback">
                                          Looks good!
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3 ">
                                      <label for="number">Number</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroupPrepend3" >+91</span>
                                        </div>
                                        <input type="number" class="form-control" id="number" placeholder="Number"  name="number" required>
                                        <div class="invalid-feedback">
                                          Please write a number.
                                        </div>
                                        <div class="valid-feedback">
                                          Looks good!
                                        </div>
                                      </div>
                                    </div>
                                    <label for="validationServer04">Gender</label><br>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input male" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" onclick="male()">
                                      <label class="form-check-label" for="inlineRadio1">Male</label>
                                      
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input female" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" onclick="female()">
                                      <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                      <div class="valid-feedback">
                                          Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                          Please write a number.
                                        </div>
                                  <br>
                                    <div class="form-group">
                                      <div class="form-check " onclick="accept()" onchange="decline()">
                                        <input class="form-check-input checkbox " type="checkbox" id="check" required>
                                        <label class="form-check-label" for="check">
                                          Agree to terms and conditions
                                        </label>
                                        <div class="invalid-feedback">
                                          You must agree before submitting.
                                        </div>
                                      </div>
                                    </div>
                                    <button type="button" class="btn btn-primary submit" id="submit" data-data="submit" disabled>Submit form</button>
                   </form>
            </div>
        </div>
      
      <!--/ modal -->



      <script src="jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
      <script src="http://localhost/project/Disha/script.js"></script>
      <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        

 
</body>
</html>