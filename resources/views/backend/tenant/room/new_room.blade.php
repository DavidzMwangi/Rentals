<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Website Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
    <h1>Room Allocation Page</h1>
    <p>Selection of Room</p>
</div>


<div class="container"  id="building_id">

    <form method="post" action="{{route('save_tenant_details_now')}}">

        {{ @csrf_field() }}


        @if(count($errors->all())>0)

            <div class="alert alert-danger">

                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>

                    @endforeach
            </div>
            @endif
    <div class="row">

        <div class="col-sm-6 form-group">
            <label for="">Apartment Name</label>
            <select name="aprtment"  class="form-control"  v-model="selected"  v-on:change="getData()">
                <option>Select An Apartment</option>

                @foreach(\App\Models\Apartment::all() as $apartment)
                    <option value="{{$apartment->id}}">{{$apartment->apartment_name}}</option>

                    @endforeach
            </select>

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

        <div class="col-md-6">
            <div class="form-group">
                <label>Room Number</label>
                <select class="form-control"  name="room_id" required  >
                    <option disabled selected> Select a room</option>

                    <option v-for="room in rooms" :value="room.id">@{{ room.name }}</option>
                </select>
            </div>
        </div>

    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>

{{--        <div class="col-sm-4">--}}
{{--            <h2>About Me</h2>--}}
{{--            <h5>Photo of me:</h5>--}}
{{--            <div class="fakeimg">Fake Image</div>--}}
{{--            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>--}}
{{--            <h3>Some Links</h3>--}}
{{--            <p>Lorem ipsum dolor sit ame.</p>--}}
{{--            <ul class="nav nav-pills nav-stacked">--}}
{{--                <li class="active"><a href="#">Link 1</a></li>--}}
{{--                <li><a href="#">Link 2</a></li>--}}
{{--                <li><a href="#">Link 3</a></li>--}}
{{--            </ul>--}}
{{--            <hr class="hidden-sm hidden-md hidden-lg">--}}
{{--        </div>--}}
{{--        <div class="col-sm-8">--}}
{{--            <h2>TITLE HEADING</h2>--}}
{{--            <h5>Title description, Dec 7, 2017</h5>--}}
{{--            <div class="fakeimg">Fake Image</div>--}}
{{--            <p>Some text..</p>--}}
{{--            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>--}}
{{--            <br>--}}
{{--            <h2>TITLE HEADING</h2>--}}
{{--            <h5>Title description, Sep 2, 2017</h5>--}}
{{--            <div class="fakeimg">Fake Image</div>--}}
{{--            <p>Some text..</p>--}}
{{--            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>--}}
{{--        </div>--}}

</div>


<script type="text/javascript" src="{{asset('plugins/axios/axios.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/vue/vue.min.js')}}"></script>

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

                let url = '{{url('get_building_apartments')}}' + '/' + this.selected;
                let me = this;
                axios.get(url)
                    .then(res => {
                        console.log(res.data);
                        me.buildings = res.data;
                        me.rooms=null;

                    })
                    .catch(err => {


                    });
                // alert(this.selected)
            },
            roomsExtract: function () {
                // alert(this.selected_building);
                let url2 = '{{url('get_rooms_building')}}' + '/' + this.selected_building;

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

</body>
</html>
