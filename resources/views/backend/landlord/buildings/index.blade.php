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
                    <h1>Building Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buildings</li>
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
                        <option disabled readonly>Please Select an apartment</option>

                        @foreach($apartments as $apartment)
                            <option value="{{$apartment->id}}">{{$apartment->apartment_name}}</option>

                            @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Buildings Management</h3>

                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#new_building_modal" >Add Building</button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Building Name</th>
                                <th>Description</th>
                                <th>Apartment Name</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                                <tr v-for="building in buildings">


                                    <td>@{{ building.name }}</td>
                                    <td>@{{ building.description }}</td>
                                    <td>@{{ building.apartment.apartment_name }}</td>

                                    <td>
{{--                                        <a href="#" title="Edit" >  <span class="fa fa-edit" ></span></a>--}}
                                        <a href="#" title="Delete" @click="deleteBuilding(building.id)">  <span class="fa fa-trash"></span></a>
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
                        <h5 class="modal-title">New Building</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('landlord.save_new_building')}}">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="row">

{{--                                <input type="hidden" name="category_id" :value="selected_category.id">--}}
                                <div class="form-group col-6">
                                    <label for="user">Name</label>
                                    <input class="form-control" name="name"  required >
                                </div>
                                <div class="form-group col-6">

                                    <label for="business">Description</label>
                                    <input id="business" class="form-control" name="description"  required/>


                                </div>

                                <div class="form-group col-6">
                                    <label for="verified">Apartment Name</label>

                                    <select class="form-control" name="apartment_id" required>
                                        <option disabled readonly>Please Select an apartment</option>

                                        @foreach($apartments as $apartment)
                                            <option value="{{$apartment->id}}">{{$apartment->apartment_name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

            el:'#building_id',
            data:{
                selected:'',
                buildings:[],
            },
            created:function () {

            },
            methods:{
                getData:function () {

                    let url='{{url('landlord/get_apartment_buildings')}}'+'/'+this.selected;
                    let me=this;
                    axios.get(url)
                        .then(res=>{
                            me.buildings=res.data.buildings;

                        })
                        .catch(err=>{


                        })
                    // alert(this.selected)
                },
                deleteBuilding:function (buildingId) {
                    let url='{{url('landlord/delete_building')}}'+'/'+buildingId;
                    axios.get(url)
                        .then(res=>{
                            swal("Success", "Room Successfully deleted", "success");
                            window.location='{{url('landlord/building')}}'

                        })
                        .catch(err=>{


                        })
                }
            }
        })
    </script>
@endsection