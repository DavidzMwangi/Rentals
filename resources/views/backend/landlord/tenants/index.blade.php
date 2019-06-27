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
                    <h1>Tenants Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tenants</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="building_id">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Apartment Name</label>
                    <select class="form-control" v-model="selected"  v-on:change="getData()">
                        <option disabled selected> Select an apartment</option>

                        @foreach($apartments as $apartment)
                            <option value="{{$apartment->id}}">{{$apartment->apartment_name}}</option>

                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label>Building Name</label>
                    <select class="form-control" v-model="selected_building"  @change="roomsExtract()">
                        <option disabled selected> Select a building</option>

                        <option v-for="building in buildings" :value="building.id">@{{ building.name }}</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Rooms Management</h3>

{{--                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#new_building_modal" >Add Room</button>--}}

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Tenant Name</th>
                                <th>Room Type</th>
                                <th>Rent Balance</th>
                                <th>Deposit Amount</th>
                            </tr>
                            </thead>
                            <tbody>


                            <tr v-for="tenant in tenants">


                                <td>@{{ tenant.room.name }}</td>
                                <td>@{{ tenant.user.name }}</td>
                                <td>

                                    <span v-if="tenant.room.room_type==0" class="badge badge-primary">BedSitter</span>
                                    <span v-if="tenant.room.room_type==1" class="badge badge-primary">Single Room</span>
                                    <span v-if="tenant.room.room_type==2" class="badge badge-primary">One Bedroom</span>
                                    <span v-if="tenant.room.room_type==3" class="badge badge-primary">Two Bedroom</span>
                                    <span v-if="tenant.room.room_type==4" class="badge badge-primary">Three Bedroom</span>


                                </td>
                                <td>
                                  @{{ tenant.rent_balance }}
                                </td>
                                <td>
                                    @{{ tenant.current_deposit_amount }}
                                </td>

                            </tr>


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



        // $(function () {
        //     $("#example1").DataTable();
        //     $('#example2').DataTable({
        //         "paging": true,
        //         "lengthChange": false,
        //         "searching": false,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false
        //     });
        // });


        let abs=new Vue({

            el: '#building_id',
            data: {
                selected: '',
                selected_building: '',
                apartment_selected: '',
                buildings: [],
                rooms: [],
                buildings_arr:[],
                tenants:[],
            },
            created: function () {

            },
            methods: {
                getData: function () {

                    let url = '{{url('landlord/get_building_apartments')}}' + '/' + this.selected;
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
                roomsExtract: function () {
                    // alert(this.selected_building);
                    let url2 = '{{url('landlord/get_occupied_rooms')}}' + '/' + this.selected_building;

                    let me = this;

                    axios.get(url2)
                        .then(res => {

                            me.tenants=res.data.tenants;

                        })
                        .catch(err => {


                        })
                }

            }

        });
    </script>
@endsection