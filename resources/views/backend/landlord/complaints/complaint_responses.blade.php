@extends('backend.layouts.master')
@section('style')
    <link href="{{asset('plugins/jasny-bootstrap/css/jasny-bootstrap.css')}}" rel="stylesheet" />
    <style>
        .cursor_changer{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Responses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Post Responses</li>
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
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header">
                            <h3 class="card-title">Post Message: {{$complaint->description}}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                                        data-widget="chat-pane-toggle">
                                    <i class="fa fa-comments"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" >
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="height: 500px;">


                                @foreach($responses as $response)

                                    @if(!$response->is_landlord)
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name float-left">{{$response->complaint->tenant->user->name}}</span>
                                                <span class="direct-chat-timestamp float-right">{{$response->created_at->diffForHumans()}}</span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                {{$response->description}}

                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>

                                    @else

                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name float-right">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                                <span class="direct-chat-timestamp float-left">{{$response->created_at->diffForHumans()}}</span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                {{$response->description}}



                                            </div>

                                        </div>

                                    @endif
                                @endforeach

                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <form action="{{route('landlord.save_new_complaint_response')}}" method="post">
                                {{csrf_field()}}
                                <div class="input-group">
                                    <input type="hidden" name="complaint_id" value="{{$complaint->id}}">
                                    <input type="text" name="message" placeholder="Type Message ..." class="form-control" required>
                                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary">Send</button>
                    </span>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('script')


@endsection
