<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>View Suspect</title>
</head>
<body>
    <div class="content">

<div class="container-fluid pt-4 px-4"><div class="text-center"><h2 class="mb-4">View Suspect</h2></div>
    <div class="col">
        <div class="bg-light rounded h-100 p-4">

            <form action="{{url('/store-suspect') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">

                    <div class="col-sm-6">@foreach($suspect as $r)
                        @endforeach
                    <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Outlaw's First Name" value="{{$r->fname}}" disabled>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lname" name ="lname" placeholder="Enter Outlaw's Last Name" value="{{$r->lname}}" disabled>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-sm-6">
                        <label for="age" class="col-sm-2 col-form-label">Age</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter Outlaw's Age" min=10 max=80 required value="{{$r->age}}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="dob" class="col-sm-2 col-form-label">Date Of Birth</label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" id="dob" name="dob" value="{{$r->dob}}" disabled>
                        </div>
                    </div>
                </div>

                <fieldset class="row mb-4">
                    <div class="col-sm-4">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Male" <?php echo ($r->gender== 'Male') ?  "checked" : "" ; ?> disabled> Male
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo ($r->gender== 'Female') ?  "checked" : "" ; ?> disabled> Female
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Other" <?php echo ($r->gender== 'Other') ?  "checked" : "" ; ?> disabled> Other
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-4">
                        <legend class="col-form-label col-sm-2 pt-0">Alert Mode</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_mode" value="buzzer" <?php echo ($r->alert_mode== 'buzzer') ?  "checked" : "" ; ?> disabled> Buzzer
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_mode" value="silent" <?php echo ($r->alert_mode== 'silent') ?  "checked" : "" ; ?> disabled> Silent
                        </div>
                    </div>
                    </div>

                    <div class="col-sm-4">
                        Alert Admin Option
                    <div class="col-sm-10 pt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_admin" value="me" <?php echo ($r->alert_admin== 'me') ?  "checked" : "" ; ?> disabled> Just alert me
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_admin" value="all" <?php echo ($r->alert_admin== 'all') ?  "checked" : "" ; ?> disabled> Alert all admin
                        </div>
                    </div>
                    </div>
                </fieldset>

                <div class="row mb-3">
                    <div class="col-sm-4">
                            <label for="img" class="form-label">Choose Outlaw's Photo</label>
                            <div class="col-sm-10">
                                <img src ="{{URL('/storage/uploads/suspect/'.$r->image_name.'')}}" alt="img" width="150">
                            </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="detail" class="col-sm-6 col-form-label">Birth Mark (Identification)</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="detail" name="detail" value="{{$r->birth_mark}}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="aadhar" class="col-sm-4 col-form-label">Aadhar card</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="aadhar" name ="aadhar" placeholder="Enter Outlaw's Aadhar No" value="{{$r->aadhar_card}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Outlaw's Address" required value="{{$r->address}}" disabled>
                    </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-6 col-form-label">Outlaw's State</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="state" name="state" value="{{$r->state}}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-6 col-form-label">Select Outlaw's City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="city" name="city" value="{{$r->city}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="description" class="col-sm-1 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name ="description" value="{{$r->description}}" disabled>
                    </div>
                </div>
                    <div class="col-sm-4">
                        <label class="col-sm-6 col-form-label">Outlaw's Wanted States</label>
                        <div class="col-sm-10">
                            @foreach($states as $s)
                            <input type="text" class="form-control" id="wanted_states" name ="wanted_states" value="{{$s->state}}" disabled>

                        @endforeach
                        </div>
                    </div>
                    <div class="col-sm-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="all" id="all_state" name="all_state" <?php echo ($r->all_states == '1') ?  "checked" : "" ; ?> disabled>
                        <label class="form-check-label" for="all_state">
                          Wanted In All States
                        </label>
                      </div>
                    </div>
                </div>
            </div>

                <center><button type="button" class="btn btn-outline-success btn-lg" onclick="window.location='{{url("all-suspect")}}'">Back</button></center>
            </form>
        </div>
    </div>
</div>
    </div>
</body>
</html>
