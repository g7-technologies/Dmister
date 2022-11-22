@extends('layouts.admin_master')

@section('content')

<div class="container-fluid">
    <div class="row" style="margin: 20px;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body order-list">
                    
                    <div id="alertDiv">
                        @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                        @endif
                        @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                        @endif
                    </div>
                    
                    <h4 class="header-title mt-0 mb-3">All Orders</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Order Id</th>
                                   <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script>
    $(document).ready( function() {
        $('#alertDiv').delay(3000).slideUp(1200);
    });
    
</script>

@endpush