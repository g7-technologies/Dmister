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
                    <h4 class="header-title mt-0 mb-3">Add Coin</h4> 
                    
                    <form id="form" class="form" method="post" action="{{url('/store_coin')}}" enctype="multipart/form-data">
                    @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-2">Coin Name <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="name" name="name" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="symbol" class="col-lg-2">Coin Symbol <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="symbol" name="symbol" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="min" class="col-lg-2">Min Amount <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="min" name="min" type="number" step="1" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="max" class="col-lg-2">Max Amount <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="max" name="max" type="number" step="1" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="wallet_address" class="col-lg-2">Wallet Address <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="wallet_address" name="wallet_address" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Add Coin</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

    </div>
                    
</div>



@endsection
