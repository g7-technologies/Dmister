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
                    
                    <h4 class="header-title mt-0 mb-3">View Categories</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Category Name</th>
                                   <th>Status</th>
                                   <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 0;?>
                                @foreach($categories as $category)
                                <?php $i = $i + 1;?>
                                <tr align="center">
                                    <td>{{$i}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @if($category->status == 1)
                                        <span class="badge badge-success">Active</span>
                                        @elseif($category->status == 0)
                                        <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($category->status == 1)
                                        <a href="{{url('/disable_category/'.$category->id)}}" title="Disable Category" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                                        <a href="{{url('/edit_category/'.$category->id)}}" title="Edit Category" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                        @elseif($category->status == 0)
                                        <a href="{{url('/enable_category/'.$category->id)}}" title="Enable Category" class="btn btn-outline-success"><i class="fas fa-check"></i></a>
                                        <a href="{{url('/edit_category/'.$category->id)}}" title="Edit Category" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
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