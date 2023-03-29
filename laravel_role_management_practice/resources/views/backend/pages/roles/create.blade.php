@extends('backend.layouts.master')

@section('title')
    Role Create ~ Admin Panel
@endsection

@section('styles')
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
                        <h4 class="page-title pull-left">Role Create</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            <li><span>Create Role</span></li>
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
                            <h4 class="header-title">Create New Role</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{route('admin.roles.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input type="text" name="name" class="form-control" id="name"  placeholder="Enter a Role Name">
                                </div>

                                <div class="form-group">
                                    <label for="name">Permissions</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"  id="checkPermissionAll" value="1" >
                                            <label class="form-check-label" for="checkPermissionAll">All</label>
                                        </div>
                                </div>
                                <hr>
                                @php $i=1; @endphp
                                @foreach($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"  id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{$i}}-management-checkbox', this)">
                                                <label class="form-check-label" for="checkPermission">{{$group->name}}</label>
                                            </div>
                                        </div>
                                        <div class="col-9 role-{{$i}}-management-checkbox">
                                            <div class="form-inline">
                                                @php
                                                    $permissions = \App\Models\User::getPermissionByGroupName($group->name);
                                                    $j=1;
                                                @endphp
                                                @foreach($permissions as $permission)
                                                    <div class="form-check" style="margin-right: 10px;">
                                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" onclick="checkSinglePermission('role-{{$i}}-management-checkbox', '{{ $i }}Management', {{count($permissions)}})">
                                                        <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{$permission->name}}</label>
                                                    </div>
                                                    @php
                                                        $j++;
                                                    @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @php $i++; @endphp
                                @endforeach

                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Role</button>
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
    @include('backend.pages.roles.partials.scripts')
@endsection
