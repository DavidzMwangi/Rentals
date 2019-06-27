@extends('backend.layouts.master')
@section('style')


@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fa fa-globe"></i> Rentals System
                                    <small class="float-right"> Date: {{now()->toDayDateTimeString()}}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <u>   <strong>  Apartments</strong></u>
                                <br>
                                <b> Number of Apartments:</b> {{count($apartments)}}<br>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <u> <strong>  Buildings</strong></u>
                                <br>
                                <b> Number of Buildings:</b> {{count($buildings)}}<br>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <u>  <strong> Rooms</strong></u>
                                <br>
                                <b>Number of Rooms: </b> {{count($rooms)}}<br>
                                <b>Un Occupied Rooms:</b> {{count($empty)}}<br>
                                <b>Occupied:</b> {{count($rooms)- count($empty)}}
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <h4>
                                <strong> All Tenants</strong>
                            </h4>
                        </div>
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Apartment Name</th>
                                        <th>Building Name</th>
                                        <th>Room Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($tenants as $tenant)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$tenant->user->name}}</td>
                                            <td>{{$tenant->room->building->apartment->apartment_name}}</td>
                                            <td>{{$tenant->room->building->name}}</td>
                                            <td>{{$tenant->room->name}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{route('landlord.print_report')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>


                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('script')


@endsection