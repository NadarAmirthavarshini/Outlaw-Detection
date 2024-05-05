<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>All Admin</title>
    <style>
        .container {
            padding: 2rem 0rem;
        }

        h4 {
            margin: 2rem 0rem 1rem;
        }

        .table-image {

            td,
            th {
                vertical-align: middle;
            }
        }

        .container {
            position: relative;
        }

        .topright {
            position: absolute;
            top: 8px;
            right: 16px;
            font-size: 18px;
        }

        img {
            width: 100%;
            height: auto;
            opacity: 0.3;
        }
    </style>
</head>
<body>
    <div class="content">

<div class="container-fluid pt-4 px-4"><div class="text-center"><h2 class="mb-4">All Admins</h2></div>
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
            <table class="table">
                <thead class="thead-dark table-primary">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($result as $r )
                  <tr>
                    <th scope="row"> {{$r->id}}</th>
                    <td> {{$r->first_name}}</td>
                    <td> {{$r->last_name}}</td>
                    <td> {{$r->age}}</td>
                    <td> {{$r->gender}}</td>
                    <td> {{$r->contact_no}}</td>
                    <td> {{$r->address}}</td>
                    <td> {{$r->city}}</td>
                    <td> {{$r->state}}</td>
                    <td>
                        <a href ='edit-admin/{{$r->id}}'<button type='button' id = 'edit' class='btn btn-success'><i class='fas fa-edit'></i></button></a>
                        <a href ='delete-admin/{{$r->user_id}}'<button type='button' id = 'delete' class='btn btn-danger'><i class='fas fa-trash-alt'></i></button></a>
                    </td>

                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</body>
<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>
</html>
