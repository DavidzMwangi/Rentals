@extends('backend.layouts.master')
@section('style')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}"/>
    @endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>New Apartment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">New Apartment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="whole_content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

{{--                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">New/Edit Apartment</a></li>--}}
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                @if(count($errors->all())>0)
                                    <div class="alert alert-danger">

                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>

                                        @endforeach
                                    </div>

                                @endif
                                <div class="tab-pane active " id="settings">

                                    <form class="form-horizontal" method="post" action="{{route('landlord.save_new_apartment')}}">
                                        {{csrf_field()}}
                                        <div class="row">



                                        <div class="form-group col-sm-12 col-md-6">
                                            <input value="{{old('id')}}" type="hidden" name="apartment_id">
                                            <label for="inputName" class=" control-label">Apartment Name</label>

                                            <div class="">
                                                <input type="text" class="form-control" id="inputName"  value="{{old('apartment_name')}}" name="apartment_name" placeholder="Apartment Name">
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-12 col-md-6">
                                            <label for="inputEmail" class=" control-label">Description</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEmail" value="{{old('description')}}" name="description" placeholder="Description">
                                            </div>
                                        </div>
                                        </div>


{{--                                    <div class="row">--}}
{{--                                        <div class="form-group  col-sm-12 col-md-6">--}}
{{--                                            <label for="location">Location</label>--}}
{{--                                            <div class="col-sm-10">--}}
{{--                                                <select class="form-control select2" name="location_id" id="location" >--}}
{{--                                                  @foreach(\App\Models\Location::all() as $location)--}}
{{--                                                      <option value="{{$location->id}}">{{$location->name}}</option>--}}
{{--                                                      @endforeach--}}

{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger" >Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @endsection

@section('script')
    <script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })

        </script>
    @endsection

