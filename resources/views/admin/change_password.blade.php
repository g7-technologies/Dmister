@extends('layouts.admin_master')
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
                    <form class="form-horizontal" method="POST" action="{{ url('change_password_submit') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="current_password" >Current Password</label>
                            <input id="current_password" type="password" class="form-control" name="current_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password" >New Password</label>
                            <input id="new_password" type="password" class="form-control" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection