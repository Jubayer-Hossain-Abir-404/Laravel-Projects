@extends('backend.layouts.master')

@section('title')
    Admin Edit ~ Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection

@section('admin-content')
    <div>
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Admin Edit</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                            <li><span>Edit Admin - {{ $admin->name }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    @include('backend.layouts.partials.logout')
                </div>
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="row">
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Edit Admin - {{ $admin->name }}</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{route('admin.admins.update', $admin->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="name">Admin Name</label>
                                        <input type="text" name="name" class="form-control" id="name"  placeholder="Enter a Name" value="{{ $admin->name }}">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="email">Admin Email</label>
                                        <input type="text" name="email" class="form-control" id="email"  placeholder="Enter Email" value="{{ $admin->email }}">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"  placeholder="Password">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"  placeholder="Confirm Password">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="roles">Assign Roles</label>
                                        <select name="roles[]" id="roles" class="select2 col-md-12 col-sm-6" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="username">Admin Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="{{ $admin->username }}"/>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Admin</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- data table end -->
                <!-- Primary table start -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
