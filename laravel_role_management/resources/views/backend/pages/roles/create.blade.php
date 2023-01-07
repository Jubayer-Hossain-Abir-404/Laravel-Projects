@extends('backend.layouts.master')

@section('title')
    Role Create ~ Admin Panel
@endsection

@section('styles')

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
                            <li><span>All Roles</span></li>
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
    <script>

    </script>
@endsection
