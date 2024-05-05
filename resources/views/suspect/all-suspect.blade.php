<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>All Suspect</title>
</head>
<body>
    <div class="content">

<div class="container-fluid pt-4 px-4"><div class="text-center"><h2 class="mb-4">All Suspects</h2></div>
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
                            <img class="card-top" src ="{{URL('/storage/uploads/suspect/'.$r->image_name.'')}}" alt="img" width="200">
                            <h3 class="card-title text-center">ID - {{$r->id}}</h3>
                            <div class="card-body">
                                <h4 class="card-title text-center">Full Name - {{$r->fname." ".$r->lname}}</h4>
                                <hr>
                                <p class="card-text">
                                    <b><i class="fa fa-venus-mars" aria-hidden="true"> </i>Gender:</b> {{$r->gender}}
                                </p>
                                <p class="card-text">
                                    <b><i class="fa fa-address-card" aria-hidden="true"> </i>Address:</b> {{$r->address. ', City: '.$r->city.', State: '.$r->state}}
                                </p>
                                <p class="card-text">
                                    <b><i class="fa fa-user"> </i> Created By:</b> {{$r->first_name}}
                                </p>
                            </div>
                            <div class="col text-center">
                                <a href ='view-suspect/{{$r->id}}'<button type='button' id = 'view' class='btn btn-warning'><i class='fas fa-eye'></i></button></a>
                                <?php if(session('role') =="admin"){ ?>
                                <a href ='edit-suspect/{{$r->id}}'<button type='button' id = 'edit' class='btn btn-success'><i class='fas fa-edit'></i></button></a>
                                <a href ='delete-suspect/{{$r->id}}'<button type='button' id = 'delete' class='btn btn-danger'><i class='fas fa-trash-alt'></i></button></a>
                                <?php } ?>
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
            </script>
        </html>
