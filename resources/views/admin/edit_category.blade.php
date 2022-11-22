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
                    <h4 class="header-title mt-0 mb-3">Update Category</h4> 
                    
                    <form id="form" class="form" method="post" action="{{url('/update_category')}}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-2">Category Name <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="name" name="name" type="text" class="form-control" value="{{$category->name}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
                    
</div>



@endsection
