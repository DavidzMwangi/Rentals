<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('uploads/rentals.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @role('Admin')
            <li class="nav-item">
                <a href="{{route('admin.index')}}" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        DashBoard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.roles_permissions.index')}}" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        Roles and Permissions
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.users.all_users')}}" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        User Management
                    </p>
                </a>
            </li>
            @endrole

            @role('Landlord')
            <li class="nav-item">
                <a href="{{route('landlord.dashboard')}}" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        DashBoard
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{route('landlord.apartments')}}" class="nav-link">
                    <i class="nav-icon fa fa-building-o"></i>
                    <p>
                        Apartments
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{route('landlord.building')}}" class="nav-link">
                    <i class="nav-icon fa fa-building"></i>
                    <p>
                        Buildings
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('landlord.rooms')}}" class="nav-link">
                    <i class="nav-icon fa fa-home"></i>
                    <p>
                        Rooms
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('landlord.tenants')}}" class="nav-link">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                        Tenants
                    </p>
                </a>
            </li>



            <li class="nav-item">
                <a href="{{route('landlord.new_damage')}}" class="nav-link">
                    <i class="nav-icon fa fa-warning"></i>
                    <p>
                        Damages
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('landlord.all_complaints')}}" class="nav-link">
                    <i class="nav-icon fa fa-question"></i>
                    <p>
                        Complaints
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fa fa-pie-chart"></i>
                    <p>
                        Maintenance
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('landlord.new_maintenance')}}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>New Maintenance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('landlord.all_maintenance')}}" class="nav-link ">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Existing Maintenance</p>
                        </a>
                    </li>

                </ul>
            </li>


            <li class="nav-item">
                <a href="{{route('landlord.vacations')}}" class="nav-link">
                    <i class="nav-icon fa fa-object-group"></i>
                    <p>
                        Vacation
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('landlord.all_rents')}}" class="nav-link">
                    <i class="nav-icon fa fa-money"></i>
                    <p>
                        Rent
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{route('landlord.report_preview')}}" class="nav-link">
                    <i class="nav-icon fa fa-book"></i>
                    <p>
                        Reports
                    </p>
                </a>
            </li>



            @endrole


            @role('Tenant')
            <li class="nav-item">
                <a href="{{route('tenant.dashboard')}}" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        DashBoard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('tenant.room.room_info')}}" class="nav-link">
                    <i class="nav-icon fa fa-home"></i>
                    <p>
                        Room Details
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('tenant.room.damages')}}" class="nav-link">
                    <i class="nav-icon fa fa-warning"></i>
                    <p>
                        Damages
                    </p>
                </a>
            </li>


            <li class="nav-item has-treeview">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fa fa-pie-chart"></i>
                    <p>
                       Complaints
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('tenant.complaint.new_complaint')}}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>New Complaints</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tenant.complaint.all_complaints')}}" class="nav-link ">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Existing Complaints</p>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a href="{{route('tenant.vacate.vacation')}}" class="nav-link">
                    <i class="nav-icon fa fa-user"></i>
                    <p>
                      Vacation
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('tenant.rent.index')}}" class="nav-link">
                    <i class="nav-icon fa fa-money"></i>
                    <p>
                        Rent
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('tenant.profile')}}" class="nav-link">
                    <i class="nav-icon fa fa-user"></i>
                    <p>
                      Profile
                    </p>
                </a>
            </li>
            @endrole

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
