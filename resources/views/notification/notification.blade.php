<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>Found Suspect</title>
</head>
<body>
    <div class="content">

<div class="container-fluid pt-4 px-4"><div class="text-center"><h2 class="mb-4">Detected Suspects</h2></div>
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

            <div class="row">
                @foreach($result as $r)
                    <div class="col-md-4">
                        <br>
                        <div class="card">
                            <img class="card-top" src ="{{URL('/storage/uploads/found_suspect/'.$r->suspect_image_name.'')}}" alt="img" width="200">
                            <h3 class="card-title text-center">Suspect ID - {{$r->id}}</h3>
                            <div class="card-body">
                                <h4 class="card-title text-center">Full Name - {{$r->fname." ".$r->lname}}</h4>
                                <hr>
                                <p class="card-text">
                                    <b><i class="fa fa-address-card" aria-hidden="true"> </i>Airport Address:</b> {{'Device: '.$r->device_name.', '.$r->airport_name. ', '.$r->address. ', City: '.$r->city.', State: '.$r->state}}
                                </p>
                                <p class="card-text">
                                    <b><i class="fa fa-clock" aria-hidden="true"> </i>Found At:</b> {{$r->date_time}}
                                </p>
                                <p class="card-text">
                                    <b><i class="fa fa-phone" aria-hidden="true"> </i>Airport Contact No:</b> {{$r->contact_no}}
                                </p>
                                <p class="card-text">
                                    <b><i class="fa fa-user"> </i> Report to:</b> {{$r->first_name}}
                                </p>
                            </div>
                            <div class="col text-center">
                                <a href ='view-suspect/{{$r->id}}'<button type='button' id = 'view' class='btn btn-warning'><i class='fas fa-eye'></i></button></a>
                            </div>
                            <br>
                        </div>
                    </div>
                @endforeach
            </div>
</div>
    </div>
        </body>
        <script>
            $('div.alert').not('.alert-important').delay(3000).slideUp(300);
            setTimeout(function(){
   window.location.reload();
}, 10000);
            </script>

        </html>
