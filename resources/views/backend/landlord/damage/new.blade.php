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
                    <h1>Damage Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Damages</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="building_id">


        <a href="{{route('landlord.view_all_damages')}}" class="btn btn-primary">View All Damages</a>
        <form method="post" action="{{route('landlord.save_new_damage')}}">
            {{@csrf_field()}}

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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Room Number</label>
                    <select class="form-control" name="room_number_id" >
                        <option disabled selected> Select a Room Number</option>

                        <option v-for="room in rooms" :value="room.id">@{{ room.name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tenant Name</label>
                    <select class="form-control"  name="tenant_id">
                        <option disabled selected> Select a Tenant</option>

                      @foreach($tenants as $tenant)
                          <option value="{{$tenant->id}}">{{$tenant->user->name}}</option>

                          @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="form-group col-6">
                <label>Description</label>

                <textarea class="form-control" name="description"></textarea>
            </div>

<div class="form-group col-6">

    <label>Damage Cost</label>
    <input type="number" name="price" class="form-control" >
</div>
        </div>


        <div class="row">
            <div class="form-group col-6">

            </div>
            <div class="form-group col-6 ">

                <button type="submit" class="btn btn-success ">Submit</button>

            </div>
        </div>
        </form>






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
                {{--loadBuildings:function () {--}}
                {{--    let url = '{{url('landlord/get_building_apartments')}}' + '/' + this.apartment_selected;--}}
                {{--    let me = this;--}}
                {{--    axios.get(url)--}}
                {{--        .then(res => {--}}
                {{--            me.buildings_arr = res.data.buildings;--}}

                {{--        })--}}
                {{--        .catch(err => {--}}


                {{--        });--}}
                {{--}--}}
            }

        });
    </script>
@endsection