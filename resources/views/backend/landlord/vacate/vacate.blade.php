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
                    <h1>Vacation Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vacation</li>
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
                        <h3 class="card-title">Vacation Management</h3>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>

                                <th> Apartment Name </th>
                                <th>Building</th>
                                <th>Room Number</th>
                                <th>Vacation Date</th>
                                <th>Action</th>

{{--                                <th>View Responses</th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($vacations as $vacation)
                                <tr >


                                    <td>{{ $vacation->room->building->apartment->apartment_name }}</td>
                                    <td>{{ $vacation->room->building->name }}</td>
                                    <td>{{ $vacation->room->name }}</td>
                                    <td>{{ $vacation->vacate_date }}</td>
                                    <td>

                                        @if($vacation->is_active)
                                            <a href="{{route('landlord.approve_vacation',['id'=>$vacation->id])}}" >Approve Vacation</a>
                                            @else
                                        <span class="badge badge-success">Vacation Approved</span>

                                        @endif
                                    </td>


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