<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>Add Suspect</title>
</head>
<body>
    <div class="content">

<div class="container-fluid pt-4 px-4"><div class="text-center"><h2 class="mb-4">Add Suspect</h2></div>
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
    <div class="col">
        <div class="bg-light rounded h-100 p-4">

            <form action="{{url('/store-suspect') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-6">
                    <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Outlaw's First Name" onkeydown="return /[a-z]/i.test(event.key)" minlength="3" required>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lname" name ="lname" placeholder="Enter Outlaw's Last Name">
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-sm-6">
                        <label for="age" class="col-sm-2 col-form-label">Age</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter Outlaw's Age" min=10 max=80 required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="dob" class="col-sm-2 col-form-label">Date Of Birth</label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" id="dob" name="dob">
                        </div>
                    </div>
                </div>

                <fieldset class="row mb-4">
                    <div class="col-sm-4">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Male" checked> Male
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Female"> Female
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Other"> Other
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-4">
                        <legend class="col-form-label col-sm-2 pt-0">Alert Mode</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_mode" value="buzzer" checked> Buzzer
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_mode" value="silent"> Silent
                        </div>
                    </div>
                    </div>

                    <div class="col-sm-4">
                        Alert Admin Option
                    <div class="col-sm-10 pt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_admin" value="me" checked> Just alert me
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_admin" value="all"> Alert all admin
                        </div>
                    </div>
                    </div>
                </fieldset>

                <div class="row mb-3">
                    <div class="col-sm-4">
                            <label for="img" class="form-label">Choose Outlaw's Photo</label>
                            <div class="col-sm-10">
                            <input type="file" class="form-control" name="img" value="" required>
                            </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="detail" class="col-sm-6 col-form-label">Birth Mark (Identification)</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="detail" name="detail">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="aadhar" class="col-sm-4 col-form-label">Aadhar card</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="aadhar" name ="aadhar" placeholder="Enter Outlaw's Aadhar No">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Outlaw's Address" required>
                    </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-6 col-form-label">Select Outlaw's State</label>
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
                        <label class="col-sm-6 col-form-label">Select Outlaw's City</label>
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
                    <label for="description" class="col-sm-1 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name ="description">
                    </div>
                </div>
                    <div class="col-sm-4">
                        <label class="col-sm-6 col-form-label">Select Outlaw's Wanted States</label>
                        <div class="col-sm-10">
                        <select id="wanted_state" name="wanted_state[]" class="form-control" multiple>
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
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="all" id="all_state" name="all_state">
                        <label class="form-check-label" for="all_state">
                          Wanted In All States
                        </label>
                      </div>
                    </div>
                </div>
            </div>

                <center><button type="submit" class="btn btn-outline-success btn-lg">Submit</button></center>
            </form>
        </div>
    </div>
</div>
    </div>
</body>
<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    dob.max = new Date().toISOString().split("T")[0];
    $(document).ready(function () {

        $("#all_state").on("change", function () {
            var c=document.getElementById('all_state');
        if(c.checked){
            $('#wanted_state').attr('disabled',true);
            $("#wanted_state").val("");
        }else{
            $('#wanted_state').attr('disabled',false);

        }
        });
  $("#state").on("change", function () {
    var iso2ID = $(this).val();
    if (iso2ID) {
      $.ajax({
        type: "POST",
        headers: {
    'X-CSRF-Token': '{{ csrf_token() }}',
    },
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
});

</script>
</html>
