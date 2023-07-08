function load_city() {
  $.ajax({
    url: "load_data_city.php",
    type: "POST",
    success: function (city) {
      $("#city").html(city);

    }
  });
}
function loading(page) {
  $.ajax({
    url: "load_data.php",
    type: "POST",
    data: { page_no: page },
    success: function (data) {
      $(".table-responsive").html(data);


      // display city

      load_city();
    }
  });
}
$(document).ready(function () {


  loading();

  // pagination
  $(document).on("click", ".spacing_at_end a", function (e) {
    e.preventDefault();
    var page_id = $(this).attr("id");
    loading(page_id);
  });


  // delete data
  $(document).on("click", "#delet_data_btn", function () {
    var element = this;
    
    var id = $(element).data("id");

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
 
        $.ajax({
          url: "del.php",
          type: "POST",
          data: { 'id': id },
          success: function (option) {

            if (option == 1) {
              swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              $(element).animate({
                left:'  100px'           
              },"slow")
         
                $(element).animate({
                  opcity:'0'          
              },"slow")

              loading();
              $(element).closest("tr").fadeOut();



            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href="">Why do I have this issue?</a>'
              })
              loading();

            }
          }
        })


      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'Your imaginary file is safe:',
          'error'
        )
      }
    })
  })


  // sort id
  $(document).on("click", "#sort_id", function () {
    function sort_id() {
      var toggle = $(this);
      var mode = toggle.attr("sort");

      if (mode == "asc") {
        order = "ASC";
        toggle.removeAttr("asc");
        toggle.attr("sort", "desc");
      } else {
        order = "DESC";
        toggle.removeAttr("desc");
        toggle.attr("sort", "asc");
      }
         $.ajax({
        url: "load_data.php",
        type: "POST",
        data: { type_id: order },
        success: function (output) {
          $(".table").html(output);
        }
      });
    }
    sort_id();
  });


  // sort name
  $(document).on("click", "#sort_name", function () {
    function sort_name() {
      var toggle = $(this);
      var mode = toggle.attr("sortname");
      if (mode == "asc") {
        order_sn = "ASC";
        toggle.removeAttr("asc");
        toggle.attr("sortname", "desc");
      } else {
        order_sn = "DESC";
        toggle.removeAttr("desc");
        toggle.attr("sortname", "asc");
      }
      $.ajax({
        url: "load_data.php",
        type: "POST",
        data: { type_name: order_sn },
        success: function (output) {
          $(".table").html(output);



        }
      });
    }
    sort_name();
  });


  // search
  $(document).on("click", ".btn-search", function () {
    var search_val = $("#search").val();
    $("#cancel_btn").show();

    $.ajax({
      url: "search.php",
      type: "POST",
      data: { val: search_val },
      success: function (search) {
        $(".data").html(search);

      }

    })
  })
  $(document).on("click", "#edit_data_btn", function () {

    var element = this;
    var id = $(element).data("id");
    $("#id").val(id);


    $.ajax({
      url: "edit_show.php",
      type: "POST",
      data: { 'id': id },
      dataType: 'json',
      success: function (old_data) {

        $("#Modal1").show();

        $("#imgg").attr("src", "p_photo/" + old_data.photo_name);
        $("#photo_path").val(old_data.photo_name);
        $(document).on("change","#inp_photo",function(){
        $("#photo_path").val("");
          
        })
        $("#name").val(old_data.sname);
        $("#email").val(old_data.email);
        $("#age").val(old_data.age);
        $("#number").val(old_data.mobile);
       
          $("#ans").val(old_data.gender);
          if ($("#ans") == "Male"){
            $(".male").attr('checked', true);
          } else {
            $(".female").attr('checked', true);
  
          }

        $("#check").attr("checked", true)
        $("#submit").attr("disabled", false)
        load_city();
        $.ajax({
          url: "load_data_city.php",
          type: "POST",
          data: {'id': id},
          success: function (old_data) {
            $("#city").html(old_data);
          }
        })



      }
    })



  })

  // add field
  $(document).on("click", "#submit", function (e) {


    e.preventDefault();


    var data_js = new FormData($("#form_add")[0]);


    var name = $('#name').val();
    var age = $('#age').val();
    var contact = $('#number').val();
    var email = $('#email').val();
    var image = $('#inp_photo').val();
    var city = $('#city_name').val();
    var imageSize = $('#inp_photo')[0];
    var gender=$("#ans").val();




    // if(mode=="submit"){
    if(name=="" || email=="" || image=="" ||city=="" || age=="" ||  contact=="" || gender=="" || imageSize==""){
      if(imageSize==""){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Please insert your photo',
          footer: '<a href="">Why do I have this issue?</a>'
        })
      }
      if(name==""){
        $('#name').addClass("is-invalid");
      }
      if(email==""){
        $('#email').addClass("is-invalid");
      }
      if(image==""){
        $('#imgg').addClass("is-invalid");
      }
      if(city==""){
       $('#city_name').addClass("is-invalid");
      }
      if(age==""){
        $('#age').addClass("is-invalid");
      }
      if(contact==""){
        $('#number').addClass("is-invalid");
      }
       if(gender==""){
        $('.male').addClass("is-invalid");
        $('.female').addClass("is-invalid");
      }
      // addcladdx  
    } else if(contact.length != 10) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please enter number in 10 digit',
        footer: '<a href="">Why do I have this issue?</a>'
      })
      $("#number").addClass("is-invalid")

    }else if(age <= 6 || age >= 90 || age==""){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please enter in age Limit ',
        footer: 'Limit 90'
      })


    }
    else {

      $('#name').removeClass("is-invalid");
      $('#email').removeClass("is-invalid");
      $('#imgg').removeClass("is-invalid");
      $('#city_name').removeClass("is-invalid");
      $('#age').removeClass("is-invalid");
      $('#number').removeClass("is-invalid");
      $('.male').removeClass("is-invalid");
      $('.female').removeClass("is-invalid");
      $(".checkbox").removeClass("is-invalid");

      $.ajax({
        url: "insert_data.php",
        type: "POST",
        data: data_js,
        contentType: false,
        processData: false,
        success: function (data) {
          // alert(data)
          if (data == 0) {
            $('#name').addClass("is-valid");
            $('#email').addClass("is-valid");
            $('#imgg').addClass("is-valid");
            $('#city_name').addClass("is-valid");
            $('#age').addClass("is-valid");
            $('#number').addClass("is-valid");
            $('.male').addClass("is-valid");
            $('.female').addClass("is-valid");
            $(".checkbox").addClass("is-valid");

            let timerInterval
            Swal.fire({
              title: 'Updating Your data!',
              html: 'updating in <b></b> milliseconds.',
              timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft()
                }, 100)
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            }).then((result) => {

              $("#cancel_btn_modal").click();
              loading();
              $('#name').removeClass("is-valid");
              $('#email').removeClass("is-valid");
              $('#imgg').removeClass("is-valid");
              $('#city_name').removeClass("is-valid");
              $('#age').removeClass("is-valid");
              $('#number').removeClass("is-valid");
              $('.male').removeClass("is-valid");
              $('.female').removeClass("is-valid");
              $(".checkbox").removeClass("is-valid");

            })
          } else if (data == 1) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Can`t update',
              footer: '<a href="">Why do I have this issue?</a>'
            })
          } else if (data == 2) {
            
            $('#name').addClass("is-valid");
            $('#email').addClass("is-valid");
            $('#imgg').addClass("is-valid");
            $('#city_name').addClass("is-valid");
            $('#age').addClass("is-valid");
            $('#number').addClass("is-valid");
            $('.male').addClass("is-valid");
            $('.female').addClass("is-valid");
            $(".checkbox").addClass("is-valid");

            let timerInterval
            Swal.fire({
              title: 'Inserting Your data!',
              html: 'inserting in <b></b> milliseconds.',
              timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft()
                }, 100)
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            }).then((result) => {

              $("#cancel_btn_modal").click();
              loading();
              $('#name').removeClass("is-valid");
              $('#email').removeClass("is-valid");
              $('#imgg').removeClass("is-valid");
              $('#city_name').removeClass("is-valid");
              $('#age').removeClass("is-valid");
              $('#number').removeClass("is-valid");
              $('.male').removeClass("is-valid");
              $('.female').removeClass("is-valid");
              $(".checkbox").removeClass("is-valid");

            })
          } else if (data == 3) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Can`t insert',
              footer: '<a href="">Why do I have this issue?</a>'
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'There is some problem ',
              footer: 'Please refresh page'
            })
          }



        }
      });

    }

  })



  loading();
  









});
// function change_photo_place(){
  var height=window.height;
  var width=screen.width;
  // alert(width);
  if(width<=500){
    $(".form-column").addClass("form-row");
    $(".form-row").removeClass("form-column")
  }
// }


function male() {
  var male = "Male"
  document.getElementById('ans').value = male;
}
function female() {
  var male = "Female"
  document.getElementById('ans').value = male;
}

function accept() {
  if (document.getElementById("check").checked) {
    document.getElementById("submit").disabled = false;
  }
}
function decline() {
  if (document.getElementById("check").checked == false) {
    document.getElementById("submit").disabled = true;
  }
}

function i(event) {

  var myFrame = document.getElementById("imgg");
  myFrame.src = URL.createObjectURL(event.target.files[0]);
}
var cancel_btn=$("#cancel_btn").hide();
$(cancel_btn).click(function(){
cancel_btn.hide();
$("#search").val("");
loading();

})
$(document).on("click","#add",function(){
  $("#Modal1").show();
})
var modal = document.getElementById("Modal1");
var cancel_btn_modal=document.getElementById("cancel_btn_modal");

var btn = document.getElementById("display_modal_btn");



// // When the user clicks on <span> (x), close the modal
cancel_btn_modal.onclick=function() {
  modal.style.display="none";
  document.getElementById("name").value="";
  document.getElementById("age").value="";
  document.getElementById("number").value="";
  document.getElementById("email").value="";
  document.getElementById("city_name").value="selected"

  var photo_src=document.getElementById("imgg")
  photo_src.setAttribute("src","insert.png");
  
  document.getElementById("check").checked=false
  document.getElementById("submit").setAttribute("disabled",true);

  
}

