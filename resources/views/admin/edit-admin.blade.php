<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>Edit Admin</title>
</head>
<body>
    <div class="content">

<div class="container-fluid pt-4 px-4"><div class="text-center"><h2 class="mb-4">Edit Admin</h2></div>
    <div class="col">
        <div class="bg-light rounded h-100 p-4">
            @foreach($admin as $r)
            <form method="POST" enctype="multipart/form-data" id="dataform">
                @csrf
                <input type="hidden" id="id" name="id" value="{{$r->id}}">
                <div class="row mb-3">
                    <div class="col-sm-6">
                    <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Admin's First Name" onkeydown="return /[a-z]/i.test(event.key)" value ="{{$r->first_name}}" minlength="3" required>

                        <span id="name_err" style="color:red;display:none">Name is too short</span></div>
                    </div>
                    <div class="col-sm-6">
                        <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lname" name ="lname" value ="{{$r->last_name}}" placeholder="Enter Admin's Last Name">
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-sm-6">
                        <label for="age" class="col-sm-2 col-form-label">Age</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter Admin's Age" min=18 max=80 value ="{{$r->age}}"required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="contact" class="col-sm-2 col-form-label">Contact Number</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter Admin's Phone No." minlength="10" maxlength="10" value ="{{$r->contact_no}}" required>
                            <span id="contact_err" style="color:red;display:none">Please Enter Valid Contact Number</span></div>
                        </div>
                    </div>
                </div>
                <fieldset class="row mb-4">
                    <div class="col-sm-6">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Male" <?php echo ($r->gender== 'Male') ?  "checked" : "" ; ?> > Male
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo ($r->gender== 'Female') ?  "checked" : "" ; ?> > Female
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Other" <?php echo ($r->gender== 'Other') ?  "checked" : "" ; ?> > Other
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="aadhar" class="col-sm-4 col-form-label">Admin's Aadhar Number</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="aadhar" name ="aadhar" placeholder="Enter Admin's Aadhar No" value ="{{$r->aadhar_card}}" required>
                            <span id="aadhar_err" style="color:red;display:none">Please Enter Valid Aadhar Number</span></div>
                        </div>
                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-sm-4">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Admin's Address" value ="{{$r->address}}" required>
                    </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-6 col-form-label">Select Admin's State</label>
                        <div class="col-sm-10">
                        <select id="state" name="state" class="btn btn-primary dropdown-toggle" required>
                            <option value="">Select State</option>
                            <?php
                            $link = new mysqli('localhost', 'root', '', 'outlaws_detection');

                            // Check connection
                            if ($link->connect_error) {
                              die("Connection failed: " . $link->connect_error);
                            }
                            $query = "SELECT * FROM states ORDER BY state ASC";
                            $result = $link->query($query);
                            if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['state'] . '</option>';
                              }
                            } else {
                              echo '<option value="">State not available</option>';
                            }
                            ?>
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-6 col-form-label">Select Admin's City</label>
                        <div class="col-sm-10">
                            <select id="city" name="city" class="btn btn-primary dropdown-toggle" required>
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="email" class="col-sm-6 col-form-label">Email ID</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name ="email" value ="{{$r->email_id}}" disabled>
                    </div>
                </div>
                {{-- <div class="col-sm-4">
                    <label for="password" class="col-sm-1 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name ="password" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="cpassword" class="col-sm-6 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="cpassword" name ="cpassword" required>
                        <span id="password_err" style="color:red;display:none">Password is not matched</span>
                    </div>
                </div> --}}
                </div>@endforeach
            </div>
            <center><button type="submit" class="btn btn-outline-success btn-lg">Update</button><button type="button" class="btn btn-outline-success btn-lg" onclick="window.location='{{url("all-admin")}}'">Back</button></center>

            </form>
        </div>
    </div>
</div>
    </div>
</body>
<script>

    $(document).ready(function () {
  $("#state").on("change", function () {
    var iso2ID = $(this).val();
    if (iso2ID) {
      $.ajax({
        type: "POST",
        headers: {
    'X-CSRF-Token': '{{ csrf_token() }}',
    },
        // url: "getAjaxData.php",
        url : '{{url("get-city")}}',
        data: "iso2_val=" + iso2ID,

        success: function (city) {
            var s = "";
            for (var i = 0; i < city.length; i++) {
               s += '<option value="' + city[i].id + '">' + city[i].city + '</option>';
               }
               $("#city").html(s);
            },
        });
    } else {
      $("#city").html('<option value="">Select state first</option>');
    }
  });
function checkValidation(){
var chk=0;
 name = $('#fname').val();
 contact = $('#contact').val();
 aadhar = $('#aadhar').val();
//  console.log(name.length);

if(name.length < 3){
  document.getElementById("name_err").style.display = "block";
 chk++;
  }else{
  document.getElementById("name_err").style.display = "none";
  }
  if(contact.length != 10){
  document.getElementById("contact_err").style.display = "block";
 chk++;
  }else{
  document.getElementById("contact_err").style.display = "none";
  }
  if(aadhar.length != 12){
  document.getElementById("aadhar_err").style.display = "block";
 chk++;
  }else{
  document.getElementById("aadhar_err").style.display = "none";
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
url:"{{url('/update-admin') }}",
  data: formData,
  processData: false,
  contentType: false,
  success: function (response) {
    if(response){
        //redirect
        window.location = "{{url('/all-admin') }}";
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
