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
                    <h1>Room Vacation</h1>
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



        <div class="card">

            <div class="card-body">


                <form  method="post" action="{{route('tenant.vacate.save_new_vacation')}}">
                    {{csrf_field()}}



        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Vacation Date</label>

                    <input type="date" name="vacate_date" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">

                    <button class="btn btn-primary" {{$vacation!=null && $vacation->is_active==true?'disabled':''}}>Submit</button>
                </div>
            </div>

        </div>

                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Current Active Vacation</h3>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Apartment Name </th>
                                <th>Building</th>
                                <th>Room Number</th>
                                <th>Vacation Date</th>

                            </tr>
                            </thead>
                            <tbody>


                            @if($vacation!=null)
                            <tr >
                                    <td>{{ $vacation->room->building->apartment->apartment_name }}</td>
                                    <td>{{ $vacation->room->building->name }}</td>
                                    <td>{{ $vacation->room->name }}</td>
                                    <td>{{ $vacation->vacate_date }}</td>


                                </tr>

                                @endif

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
    <script>
        $(function () {
            $("#example1e").DataTable();
            $("#permission_table").DataTable();
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endsection