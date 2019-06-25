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
                    <h1>Rooms Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Rooms</li>
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

                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#new_building_modal" >Add Room</button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Pricing</th>
                                <th>Room Type</th>
                                <th>Is Vacant</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            <tr v-for="room in rooms">


                                <td>@{{ room.name }}</td>
                                <td>@{{ room.pricing }}</td>
                                <td>

                                    <span v-if="room.room_type==0" class="badge badge-primary">BedSitter</span>
                                    <span v-if="room.room_type==1" class="badge badge-primary">Single Room</span>
                                    <span v-if="room.room_type==2" class="badge badge-primary">One Bedroom</span>
                                    <span v-if="room.room_type==3" class="badge badge-primary">Two Bedroom</span>
                                    <span v-if="room.room_type==4" class="badge badge-primary">Three Bedroom</span>


                                </td>
                                <td>
                                    <span v-if="room.is_vacant==true" class="badge badge-danger"> Vacant</span>
                                    <span v-if="room.is_vacant==false" class="badge badge-success">Occupied</span>

                                </td>

                                <td>
                                    <a href="#" title="Edit" >  <span class="fa fa-edit" ></span></a>
                                    <a href="#" title="Delete">  <span class="fa fa-trash"></span></a>
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


        <div class="modal " tabindex="-1" role="dialog" id="new_building_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('landlord.save_new_room')}}">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="verified">Apartment Name</label>

                                    <select class="form-control" name="apartment_id" @Change="loadBuildings()" v-model="apartment_selected" required>
                                        <option disabled readonly>Select an apartment</option>

                                        @foreach($apartments as $apartment)
                                            <option value="{{$apartment->id}}">{{$apartment->apartment_name}}</option>

                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-6">
                                    <label for="verified">Building Name</label>


                                        <select class="form-control" name="building_id" required>
                                            <option disabled selected> Select a building</option>

                                            <option v-for="building in buildings_arr" :value="building.id">@{{ building.name }}</option>
                                        </select>

                                </div>


                                <div class="form-group col-6">
                                    <label for="user">Room Number</label>
                                    <input class="form-control" name="name"  required >
                                </div>
                                <div class="form-group col-6">

                                    <label for="pricing">Pricing</label>
                                    <input id="pricing" type="number" class="form-control" name="pricing"  required/>


                                </div>

                                <div class="form-group col-6">

                                    <label for="pricing">Room Type</label>

                                    <select class="form-control" name="room_type" required>
                                        <option value="0">BedSitter</option>
                                        <option value="1">Single Room</option>
                                        <option value="2">One Bedroom</option>
                                        <option value="3">Two BedRoom</option>
                                        <option value="4">Three BedRoom</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

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
                rooms: [],
                buildings_arr:[],
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
                    let url2 = '{{url('landlord/get_rooms_building')}}' + '/' + this.selected_building;

                    let me = this;

                    axios.get(url2)
                        .then(res => {

                        me.rooms=res.data.rooms;
                        console.log(res.data.rooms);
                        if (res.data.rooms.length==0){
                            alert("There is no rooms in this building")
                        }
                        })
                        .catch(err => {


                        })
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