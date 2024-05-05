<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>Add Device</title>
</head>
<body>
    <div class="content">

<div class="container-fluid pt-4 px-4"><div class="text-center"><h2 class="mb-4">Add Devices</h2></div>
    <div class="col">
        <div class="bg-light rounded h-100 p-4">

            <form method="POST" enctype="multipart/form-data" id="dataform" action="{{url('/store-device') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-6">
                    <label for="fname" class="col-sm-3 col-form-label">Device Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Device Name" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="col-sm-6 col-form-label">Select Airport's Name</label>
                    <div class="col-sm-10">
                    <select id="airport" name="airport" class="btn btn-primary dropdown-toggle" required>
                        <option value="">Select Airport</option>
                        <?php
                        $link = new mysqli('localhost', 'root', '', 'outlaws_detection');

                        // Check connection
                        if ($link->connect_error) {
                          die("Connection failed: " . $link->connect_error);
                        }
                        $query = "SELECT * FROM airport";
                        $result = $link->query($query);
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . $row['airport_name'] . '</option>';
                          }
                        } else {
                          echo '<option value="">Airport not available</option>';
                        }
                        ?>
                      </select>
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

</html>
