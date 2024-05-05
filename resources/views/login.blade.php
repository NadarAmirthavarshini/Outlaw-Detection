<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
</head>
<style>
body{
background-color: #ebf2fa;
}
a{
  text-decoration: none;
}</style>
<body>

<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">


        <h2 class="text-center text-dark mt-5">Login Form</h2>
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Success!</h4>
            <span>{{ Session::get('success') }}</span>
        </div>
    @endif

    @if (Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p>{{ Session::get('errors') }}</p>
        </div>
    @endif
        <div class="card my-5" style="border-radius: 1rem;">

          <form class="card-body-color p-lg-5" id="dataform">
            @csrf
            <div class="text-center"> <img src="{{URL('/images/security.jpg')}}" width="550px"/>
            </div><br>

            <div class="mb-3">
              <input type="email" class="form-control form-control-lg" id="username" name="username" placeholder="Enter Email">
              <span id="username_err" style="color:red;display:none">Email is required</span>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter Password">
              <span id="password_err" style="color:red;display:none">Password is required</span>
            </div>
            <div class="text-center"><button type="submit" class="btn btn-outline-secondary px-5 mb-5 w-100" name="submit">Login</button></div>
          </form>
        </div>

      </div>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(300);
$(document).ready(function(){
function checkValidation(){
var chk=0;
 name = $('#username').val();
password = $('#password').val();
if(name==''||name==null){
  document.getElementById("username_err").style.display = "block";
 chk++;
  }else{
  document.getElementById("username_err").style.display = "none";
  }
if(password==''){
chk++;
document.getElementById("password_err").style.display = "block";
}else{
document.getElementById("password_err").style.display = "none";
}
if(chk==0){
return true;}
return false;
}

$( "#dataform" ).on( "submit", function( event ) {
  event.preventDefault();
  var frm = checkValidation();
  var form = document.getElementById('dataform');
  var formData = new FormData(form);
  if(frm){
  $.ajax({
  type: "POST",
  headers: {
    'X-CSRF-Token': '{{ csrf_token() }}',
},
url:"{{url('/auth') }}",
  data: formData,
  processData: false,
  contentType: false,
  success: function (response) {
    if(response){
        //redirect
        window.location = "{{url('/all-suspect') }}";
    }
    else{
        window.location = "{{url('/login') }}";

    }
        console.log(response);
  },
  error: function (xhr, status, error) {
   }
});

  }
});

});

</script>
</html>
