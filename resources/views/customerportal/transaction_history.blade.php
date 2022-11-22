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
                    
                    <h4 class="header-title mt-0 mb-3">Transaction History</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Amount</th>
                                   <th>Status</th>
                                   <th>Order ID</th>
                                   <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 0;?>
                                @foreach($transactions as $transaction)
                                <?php $i = $i + 1;?>
                                <tr align="center">
                                    <td>{{$i}}</td>
                                    <td>${{$transaction->amount}}</td>
                                    <td>
                                        @if($transaction->transaction == "Credit")
                                        <span class="badge badge-success">{{$transaction->transaction}}</span>
                                        @elseif($transaction->transaction == "Debit")
                                        <span class="badge badge-warning">{{$transaction->transaction}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($transaction->transaction == "Credit")
                                        <span class="badge badge-dark">N/A</span>
                                        @elseif($transaction->transaction == "Debit")
                                        {{$transaction->order_id}}
                                        @endif
                                    </td>
                                    <td><?php echo date_format($transaction->created_at,"M d, Y H:i:s"); ?></td>
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