@extends('layouts.admin_master')

@section('content')

<div class="container-fluid">
    
    <div class="row" style="margin:20px">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div id="alertDiv">
                        @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                        @endif
                        @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                        @endif
                    </div>
                    <h4 class="header-title mt-0 mb-3">Update Service</h4> 
                    
                    <form id="form" class="form" method="post" action="{{url('/update_service')}}" enctype="multipart/form-data">
                    @csrf
                        
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-2">Service Name <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="name" name="name" type="text" class="form-control" value="{{$service->name}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="price" class="col-lg-2">Price <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="price" name="price" type="number" class="form-control" min="1" value="{{$service->price}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="profit" class="col-lg-2">Profit <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="profit" name="profit" type="number" class="form-control" min="1" value="{{$service->profit}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="min" class="col-lg-2">Min <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="min" name="min" type="number" class="form-control" min="1" value="{{$service->min}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="max" class="col-lg-2">Max <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="max" name="max" type="number" class="form-control" min="1" value="{{$service->max}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="description" class="col-lg-2">Description <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <textarea id="description" name="description" class="form-control" cols="3" required>{{$service->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Update Service</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
                    
</div>



@endsection
