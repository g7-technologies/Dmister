@extends('layouts.customer_master')

@section('content')

<div class="container-fluid">
    <div class="row" style="margin:20px">
        <h4 class="header-title mt-0 mb-3">Add Funds</h4>
    </div>
    <div class="row">
        @foreach($coins as $coin)
        <div class="col-sm-2">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="header-title mt-0 mb-3">{{$coin->symbol}} {{$coin->name}}</h4>
                </div>
                <div class="card-body bg-light text-center">
                    <i class="las la-coins font-40"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="{{url('/customer_add_amount/'.$coin->id)}}" class="btn btn-primary">Pay Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
                    
</div>



@endsection
