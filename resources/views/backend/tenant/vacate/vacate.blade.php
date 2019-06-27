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

                    <input  name="vacate_date" id="vacate_date" class="form-control">
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
                                <th>Vacate</th>

                            </tr>
                            </thead>
                            <tbody>


                            @if($vacation!=null)
                            <tr >
                                    <td>{{ $vacation->room->building->apartment->apartment_name }}</td>
                                    <td>{{ $vacation->room->building->name }}</td>
                                    <td>{{ $vacation->room->name }}</td>
                                    <td>{{ $vacation->vacate_date }}</td>
                                <td>

                                    @if($vacation->is_active)
                                        <a href="#"  onclick="approveVacation()">Approve Vacation</a>
                                    @else
                                        <span class="badge badge-success">Vacation Approved</span>

                                    @endif
                                </td>

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

        function approveVacation() {
            let abr='{{route('tenant.vacate.approve_vacation',['id'=>$vacation])}}';
            axios.get(abr)
                .then(res=>{
                console.log(res.data);

                if (res.data.status==1){

                    swal("Success", "You have vacated the room", "success");

                } else{
                    swal("Warning!", res.data.rer, "warning");

                }


                })
                .catch(err=>{

                })
        }

    </script>

    <script>


        $(function () {


            var d=new Date();
           //  var currMonth=d.getMonth();
           //  var curYear=d.getFullYear();
           //  var startDate=new Date(curYear,currMonth,6);
           //  var endDate=new Date(curYear,currMonth+1,5);
           //
           //
           //  console.log(curYear+"/"+currMonth+"/"+6)
           //  $('#vacate_date').datepicker({
           //     format:"yyyy-mm-dd",
           //     startDate:startDate,
           //     // onSelect:function (selected) {
           //     //     $('#vacate_date').datepicker("option","minDate",startDate);
           //     // }
           //
           // });

            $('#vacate_date').datepicker({
                defaultDate: "+1w",
                changeMonth: true
            });
            // $('#vacate_date').datepicker("setStartDate",startDate);
            // $('#vacate_date').datepicker("setEndDate",endDate);
        })
    </script>
@endsection