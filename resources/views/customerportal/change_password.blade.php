@extends('layouts.customer_master')
@section('content')
<div class="container-fluid">
    <div class="row" style="margin: 20px;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body order-list">
                    @if (session('error_msg'))
                        <div class="alert alert-danger">
                            {{ session('error_msg') }}
                        </div>
                    @endif
                    @if (session('success_msg'))
                        <div class="alert alert-success">
                            {{ session('success_msg') }}
                        </div>
                    @endif
                    <h4 class="page-title">Change Password</h4>
                    <form class="form-horizontal" method="POST" action="{{ url('customer_change_password_submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="new-password" >Current Password</label>
                            <input id="currentpassword" type="password" class="form-control" name="currentpassword" required>
                        </div>
                        <div class="form-group">
                            <label for="new-password" >New Password</label>
                            <input id="newpassword" type="password" class="form-control" name="newpassword" required>
                        </div>
                        <div class="form-group">
                            <label for="new-password-confirm">Confirm New Password</label>
                            <input id="newpassword-confirm" type="password" class="form-control" name="newpassword_confirmation" required>
                        </div>
                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection