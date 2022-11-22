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
                    
                    <h4 class="header-title mt-0 mb-3">View Services</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Service Name</th>
                                   <th>Category</th>
                                   <th>Price</th>
                                   <th>Profit</th>
                                   <th>Min</th>
                                   <th>Max</th>
                                   <th>Description</th>
                                   <th>Status</th>
                                   <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 0;?>
                                @foreach($services as $service)
                                <?php $i = $i + 1;?>
                                <tr align="center">
                                    <td>{{$i}}</td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->category_info->name}}</td>
                                    <td>{{$service->price}}</td>
                                    <td>{{$service->profit}}</td>
                                    <td>{{$service->min}}</td>
                                    <td>{{$service->max}}</td>
                                    <td>{{$service->description}}</td>
                                    <td>
                                        @if($service->status == 1)
                                        <span class="badge badge-success">Active</span>
                                        @elseif($service->status == 0)
                                        <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($service->status == 1)
                                        <a href="{{url('/disable_service/'.$service->id)}}" title="Disable Service" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                                        <a href="{{url('/edit_service/'.$service->id)}}" title="Edit Service" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                        @elseif($service->status == 0)
                                        <a href="{{url('/enable_service/'.$service->id)}}" title="Enable Service" class="btn btn-outline-success"><i class="fas fa-check"></i></a>
                                        <a href="{{url('/edit_service/'.$service->id)}}" title="Edit Service" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
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