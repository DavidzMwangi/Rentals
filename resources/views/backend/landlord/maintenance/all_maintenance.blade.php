@extends('backend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap4.css')}}">

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Maintenance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Maintenance</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="building_id">




        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Maintenances</h3>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Apartment Name </th>
                                <th>Building</th>
                                <th>Room Number</th>
                                <th>Description</th>
                                <th>Maintenance Date & Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($maintenances as $maintenance)
                                <tr >


                                    <td>{{ $maintenance->room->building->apartment->apartment_name }}</td>
                                    <td>{{ $maintenance->room->building->name }}</td>
                                    <td>{{ $maintenance->room->name }}</td>
                                    <td>{{ $maintenance->description }}</td>
                                    <td>{{ $maintenance->maintenance_date_time }}</td>
                                    <td>
                                        @if($maintenance->is_completed)
                                            <span class="badge badge-success">Completed</span>
                                            @else

                                        <span class=" badge badge-danger">Incompleted</span>
                                        @endif

                                    </td>


                                    <td>
                                        @if($maintenance->is_completed)
                                        @else

                                            <a href="{{route('landlord.mark_maintenance_complete',['id'=>$maintenance->id])}}" class=" fa fa-check">Mark Complete</a>
                                        @endif

                                    </td>
{{--                                    <td>{{ $maintenance->created_at->toDayDateTimeString() }}</td>--}}

                                </tr>


                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->



    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>

@endsection