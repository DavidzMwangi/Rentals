@extends('backend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datepicker/datepicker3.css')}}">

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rent</h1>
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


                <form  method="post" action="{{route('tenant.rent.save_new_rent')}}">
                    {{csrf_field()}}



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rent Amount</label>

                                <input  name="amount" type="number"  class="form-control" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirmation Code</label>

                                <input  name="confirmation_code" id="confirmation_code" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rent Year</label>

                                <input  name="year"  type="number" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rent Month</label>

                                <input  name="month" id="month"  type="number" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">

                                <button class="btn btn-primary" >Submit</button>
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
                                <th>Amount </th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Confirmation Code</th>
                                <th>Is Verified</th>

                            </tr>
                            </thead>
                            <tbody>


                          @foreach($rents as $rent)
                                <tr >
                                    <td>{{ $rent->amount }}</td>
                                    <td>{{ $rent->month }}</td>
                                    <td>{{ $rent->year }}</td>
                                    <td>{{ $rent->confirmation_code }}</td>
                                    <td>

                                        @if($rent->is_verified)
                                            <span class="badge badge-success">Verified</span>

                                        @else

                                            <span class="badge badge-danger">Not Verified</span>

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
    <script src="{{asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
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