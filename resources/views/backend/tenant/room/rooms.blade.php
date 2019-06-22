@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Room Info</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Room Info</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">

                            </div>

                            <h3 class="profile-username text-center">{{\Illuminate\Support\Facades\Auth::user()->name}}</h3>

                            <p class="text-muted text-center">Tenant</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Apartment Name</b> <a class="float-right">{{$tenant->room->building->apartment->apartment_name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Building Name</b> <a class="float-right">{{$tenant->room->building->name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Room Name</b> <a class="float-right">{{$tenant->room->name}}</a>
                                </li>


                                <li class="list-group-item">
                                    <b>Room Pricing</b> <a class="float-right">Ksh. {{$tenant->room->pricing}}</a>
                                </li>


                                <li class="list-group-item">
                                    <b>Room Type</b> <a class="float-right">

                                        @if($tenant->room->room_type==0)

                                            BedSitter
                                            @elseif($tenant->room->room_type==1)
                                            Single Room

                                            @elseif($tenant->room->room_type==2)

                                            One Bedroom
                                            @elseif($tenant->room->room_type==3)
                                            Two BedRoom

                                            @else
                                            Three BedRoom
                                            @endif

                                    </a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>

                <div class="col-md-6">
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fa fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>

                            <hr>

                            <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

                            <p class="text-muted">{{$tenant->room->building->apartment->location->name}}</p>

                            <hr>

                            <strong><i class="fa fa-pencil mr-1"></i> Skills</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p>

                            <hr>

                            <strong><i class="fa fa-file-text-o mr-1"></i> Notes</strong>

                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('script')

@endsection
