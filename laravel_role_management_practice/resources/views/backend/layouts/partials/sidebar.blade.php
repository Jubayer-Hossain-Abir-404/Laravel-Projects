{{-- sidebar menu area right --}}
@php 
    $usr = Auth::guard('admin')->user();
@endphp
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2>Admin</h2>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    @if ($usr->can('dashboard.view'))
                        <li class="active">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                            <ul class="collapse">
                                <li class="{{\Illuminate\Support\Facades\Route::is('admin.dashboard') ? 'active' : ''}}"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            </ul>
                        </li>
                    @endif
                    @if ($usr->can('role.view') || $usr->can('role.create') || $usr->can('role.edit') ||  $usr->can('role.delete'))
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                                            Roles & Permissions
                                        </span></a>
                            <ul class="collapse {{\Illuminate\Support\Facades\Route::is('admin.roles.create') || \Illuminate\Support\Facades\Route::is('admin.roles.index') || \Illuminate\Support\Facades\Route::is('admin.roles.edit') || \Illuminate\Support\Facades\Route::is('admin.roles.show') ? 'in' : ''}}">
                                @if ($usr->can('role.view'))
                                    <li class="{{\Illuminate\Support\Facades\Route::is('admin.roles.index') || \Illuminate\Support\Facades\Route::is('admin.roles.edit') || \Illuminate\Support\Facades\Route::is('admin.roles.show') ? 'active' : ''}}"><a href="{{route('admin.roles.index')}}">All Roles</a></li>
                                @endif
                                @if ($usr->can('role.create'))
                                    <li class="{{\Illuminate\Support\Facades\Route::is('admin.roles.create') ? 'active' : ''}}"><a href="{{route('admin.roles.create')}}">Create Role</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if ($usr->can('admin.view') || $usr->can('admin.create') || $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                                            Admins
                                        </span></a>
                            <ul class="collapse {{\Illuminate\Support\Facades\Route::is('admin.admins.create') || \Illuminate\Support\Facades\Route::is('admin.admins.index') || \Illuminate\Support\Facades\Route::is('admin.admins.edit') || \Illuminate\Support\Facades\Route::is('admin.admins.show') ? 'in' : ''}}">
                                @if ($usr->can('admin.view'))
                                    <li class="{{\Illuminate\Support\Facades\Route::is('admin.admins.index') || \Illuminate\Support\Facades\Route::is('admin.admins.edit') || \Illuminate\Support\Facades\Route::is('admin.admins.show') ? 'active' : ''}}"><a href="{{route('admin.admins.index')}}">All Admins</a></li>
                                @endif
                                @if ($usr->can('admin.create'))
                                    <li class="{{\Illuminate\Support\Facades\Route::is('admin.admins.create') ? 'active' : ''}}"><a href="{{route('admin.admins.create')}}">Create Admin</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
