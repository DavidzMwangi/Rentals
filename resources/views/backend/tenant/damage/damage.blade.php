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
                    <h1>Damages Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Damage</li>
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
                        <h3 class="card-title">Unresolved Damage</h3>


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
                                <th>Price</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($damages as $damage)
                            <tr >


                                <td>{{ $damage->room->building->apartment->apartment_name }}</td>
                                <td>{{ $damage->room->building->name }}</td>
                                <td>{{ $damage->room->name }}</td>
                                <td>{{ $damage->description }}</td>
                                <td>{{ $damage->price }}</td>
                                <td>{{ $damage->created_at->toDayDateTimeString() }}</td>

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
    <script>



        let abs=new Vue({

            el: '#building_id',
            data: {
                selected: '',
                selected_building: '',
                apartment_selected: '',
                buildings: [],
               damages:[],
                buildings_arr:[],

            },
            created: function () {

            },
            methods: {
                getData: function () {

                    let url = '{{url('tenant/room/get_building_apartments')}}' + '/' + this.selected;
                    let me = this;
                    axios.get(url)
                        .then(res => {
                            me.buildings = res.data.buildings;
                            me.rooms=null;

                        })
                        .catch(err => {


                        });
                    // alert(this.selected)
                },
                loadBuildings:function () {
                    let url = '{{url('landlord/get_building_apartments')}}' + '/' + this.apartment_selected;
                    let me = this;
                    axios.get(url)
                        .then(res => {
                            me.buildings_arr = res.data.buildings;

                        })
                        .catch(err => {


                        });
                }
            }

        });
    </script>
@endsection