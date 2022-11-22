@extends('layouts.customer_master')

@section('content')

<div class="container-fluid">
    
    <div class="row" style="margin:20px">
        <div class="col-sm-8">
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
                    <h4 class="header-title mt-0 mb-3">Add Funds</h4> 
                    <p class="mt-0 mb-3">Funds must be send to {{$coin->address}}</p> 
                    
                    <form id="form" class="form" method="post" action="{{url('/customer_deposit')}}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="coin_id" value="{{$coin->id}}">
                        <div class="row" id="price_block">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-2">Coin <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="name" name="name" type="name" class="form-control" disabled value="{{$coin->name}} ({{$coin->symbol}})" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="amount" class="col-lg-2">Amount <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="amount" name="amount" type="number" min="{{$coin->min}}" max="{{$coin->max}}" step="1" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="transaction_link" class="col-lg-2">Transaction Link <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="transaction_link" name="transaction_link" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Add Funds</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3 text-center">Auto Bonus</h4>
                    <p class="header-title">Deposit $100 to $1000</p> 
                    <p class="text-muted">*5% bonus</p> 
                    <p class="header-title">Deposit $1000+ to $5000</p> 
                    <p class="text-muted">*10% bonus</p> 
                    <p class="header-title">Deposit $5000+</p> 
                    <p class="text-muted">*20% bonus</p> 
                </div>
            </div>
        </div>

    </div>
                    
</div>



@endsection
