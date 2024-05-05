<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>Edit Airport</title>
</head>
<body>
    <div class="content">

<div class="container-fluid pt-4 px-4"><div class="text-center"><h2 class="mb-4">Edit Airport</h2></div>
    <div class="col">
        <div class="bg-light rounded h-100 p-4">
            @foreach($airport as $r)
            <form method="POST" enctype="multipart/form-data" id="dataform">
                @csrf
                <input type="hidden" id="id" name="id" value="{{$r->id}}">
                <div class="row mb-3">
                    <div class="col-sm-6">
                    <label for="fname" class="col-sm-3 col-form-label">Airport Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Airport Name" value="{{$r->airport_name}}" required>
                    </div>
                </div>
                    <div class="col-sm-6">
                        <label for="contact" class="col-sm-3 col-form-label">Contact Number</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter Phone No." value="{{$r->contact_no}}"required>
                            <span id="contact_err" style="color:red;display:none">Please Enter Valid Contact Number</span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Airport's Address" value="{{$r->address}}" required>
                    </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-6 col-form-label">Select Airport's State</label>
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
                        <label class="col-sm-6 col-form-label">Select Airport's City</label>
                        <div class="col-sm-10">
                            <select id="city" name="city" class="btn btn-primary dropdown-toggle" required>
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="email" class="col-sm-6 col-form-label">Email ID</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name ="email" value="{{$r->email_id}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

                <center><button type="submit" class="btn btn-outline-success btn-lg">Submit</button></center>
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
 contact = $('#contact').val();
  if(contact.length != 10){
  document.getElementById("contact_err").style.display = "block";
 chk++;
  }else{
  document.getElementById("contact_err").style.display = "none";
  }
  if(chk==0){
    return true;
  }
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
url:"{{url('/update-airport') }}",
  data: formData,
  processData: false,
  contentType: false,
  success: function (response) {
    if(response){
        //redirect
        window.location = "{{url('/all-airport') }}";
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
