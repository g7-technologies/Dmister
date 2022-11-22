@extends('layouts.customer_master')

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
                    
                    <h4 class="header-title mt-0 mb-3">Funds History</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Coin</th>
                                   <th>Transaction Hash</th>
                                   <th>Amount</th>
                                   <th>Date</th>
                                   <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 0;?>
                                @foreach($funds as $fund)
                                <?php $i = $i + 1;?>
                                <tr align="center">
                                    <td>{{$i}}</td>
                                    <td>{{$fund->coin_info->name}} ({{$fund->coin_info->symbol}})</td>
                                    <td>{{$fund->transaction_id}}</td>
                                    <td>${{$fund->amount}}</td>
                                    <td><?php echo date_format($fund->created_at,"M d, Y H:i:s"); ?></td>
                                    <td>
                                        @if($fund->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                        @elseif($fund->status == 1)
                                        <span class="badge badge-success">Approved</span>
                                        @elseif($fund->status == 2)
                                        <span class="badge badge-danger">Denied</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
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