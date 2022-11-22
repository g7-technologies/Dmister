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
                    <h4 class="header-title mt-0 mb-3">Create Order</h4> 
                    <form id="form" class="form" method="post" action="{{url('/customer_add_order')}}" enctype="multipart/form-data">
                    @csrf
                            
                        <div class="row" id="category_block">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="category" class="col-lg-2">Category <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <select name="category" id="category" class="form-control" onchange="get_services()" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="service_block">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="service" class="col-lg-2">Service <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <select name="service" id="service" class="form-control" onchange="get_service_info()" required>
                                            <option value="">Select Service</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="tweet_link_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="tweet_link" class="col-lg-2">Tweet Link <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="tweet_link" name="tweet_link" type="url" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="profile_url_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="profile_url" class="col-lg-2">Profile URL <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="profile_url" name="profile_url" type="url" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="quality_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="quality" class="col-lg-2">Quality <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <select name="quality" id="quality" class="form-control">
                                            <option value="">Select Quality</option>
                                            <option value="2">Top - Max 3k </option>
                                            <option value="1">Good - Max 10k</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="speed_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="speed" class="col-lg-2">Speed <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <select name="speed" id="speed" class="form-control">
                                            <option value="">Select Speed</option>
                                            <option value="1000">Normal</option>
                                            <option value="100">Slow</option>
                                            <option value="50">Very Slow</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="custom_comments_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="custom_comments" class="col-lg-2">Custom Comments <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <textarea id="custom_comments" name="custom_comments" class="form-control" cols="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="twitter_space_link_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="twitter_space_link" class="col-lg-2">Twitter Space Link <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="twitter_space_link" name="twitter_space_link" type="url" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="current_space_listeners_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="current_listeners" class="col-lg-2">Current Space Listeners <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="current_listeners" name="current_listeners" type="number" min="0" step="1" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="discord_invite_link_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="discord_invite_link" class="col-lg-2">Discord Invite Link <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="discord_invite_link" name="discord_invite_link" type="url" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="discord_channel_name_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="discord_channel_name" class="col-lg-2">Discord Channel Name <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="discord_channel_name" name="discord_channel_name" type="name" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="quantity_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="quantity" class="col-lg-2">Quantity <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="quantity" name="quantity" type="number" min="1" step="1" class="form-control" onchange="get_price()" onkeypress="get_price()" onkeydown="get_price()" onkeyup="get_price()" onscroll="get_price()">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="time_quantity_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="time_quantity" class="col-lg-2">Quantity <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <select name="time_quantity" id="time_quantity" class="form-control" onchange="get_price()">
                                            <option value="">Select Quantity</option>
                                            <option value="300">30 Minutes</option>
                                            <option value="600">1 Hour</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="price_block" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="price" class="col-lg-2">Price <span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="price" name="price" type="number" min="1" step="1" class="form-control" disabled value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Create Order</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-4" id="service_info">   
        </div>
    </div>
                    
</div>



@endsection

@push('scripts')

<script>
    var price = 0;
    function get_services()
    {    
        var category_id = document.getElementById('category').value;
        var _token = $('input[name=_token]').val();

        $.ajax(
        {
            url: "{{ url('get_services') }}",
            method: 'post',
            data: {  _token: _token, category_id:category_id },
            success: (response) => 
            {
                var $select = $('#service');
                $select.find('option').remove();
                $select.append('<option value="">Select Service</option>');
                $.each(response.services,function(key, value)
                {
                    $select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            },
            error: (error) => {
                console.log(error);
            }
        })
    }

    function get_price()
    {
        var service_id = document.getElementById('service').value;
        if(service_id != 30)
        {
            var quantity = document.getElementById('quantity').value;
            var total_price = price*quantity;
            $("#price").val(total_price);
        }
        else if(service_id == 30)
        {
            var quantity = document.getElementById('time_quantity').value;
            var total_price = price*quantity;
            $("#price").val(total_price);
        }
    }

    function get_service_info()
    {
        var service_id = document.getElementById('service').value;
        var _token = $('input[name=_token]').val();
        $("input[type=name], input[type=url], input[type=number], textarea").val("");

        $.ajax(
        {
            url: "{{ url('get_service_info') }}",
            method: 'post',
            data: {  _token: _token, service_id:service_id },
            success: (response) => 
            {
                var $service_info = $('#service_info');
                $service_info.find('div').remove();
                $service_info.append('<div class="card"><div class="card-body"><h4 class="header-title mt-0 mb-3">Service Info</h4><p>'+ response.service.description +'</p></div></div>')
                $("#quantity").prop('min',response.service.min);
                $("#quantity").prop('max',response.service.max);

                price = (response.service.price + response.service.profit)/1000;
            },
            error: (error) => {
                console.log(error);
            }
        })

        if(service_id == 1 || service_id == 3 || service_id == 14 || service_id == 23 || service_id == 24 || service_id == 25)
        {
            $("#tweet_link_block").css("display", "block");
            $("#tweet_link").prop('required',true);
            
            $("#quantity_block").css("display", "block");
            $("#quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#speed_block").css("display", "block");
            $("#speed").prop('required',true);
            
            $("#quality_block").css("display", "block");
            $("#quality").prop('required',true);

            $("#custom_comments_block").css("display", "none");
            $("#custom_comments").prop('required',false);
            
            $("#twitter_space_link_block").css("display", "none");
            $("#twitter_space_link").prop('required',false);
            
            $("#current_space_listeners_block").css("display", "none");
            $("#current_space_listeners").prop('required',false);
            
            $("#discord_invite_link_block").css("display", "none");
            $("#discord_invite_link").prop('required',false);
            
            $("#profile_url_block").css("display", "none");
            $("#profile_url").prop('required',false);
            
            $("#time_quantity_block").css("display", "none");
            $("#time_quantity").prop('required',false);
            
            $("#discord_channel_name_block").css("display", "none");
            $("#discord_channel_name").prop('required',false);
        }
        else if(service_id == 26)
        {
            $("#tweet_link_block").css("display", "block");
            $("#tweet_link").prop('required',true);
            
            $("#profile_url_block").css("display", "block");
            $("#profile_url").prop('required',true);
            
            $("#quantity_block").css("display", "block");
            $("#quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#speed_block").css("display", "block");
            $("#speed").prop('required',true);
            
            $("#quality_block").css("display", "none");
            $("#quality").prop('required',false);
            
            $("#custom_comments_block").css("display", "none");
            $("#custom_comments").prop('required',false);
            
            $("#twitter_space_link_block").css("display", "none");
            $("#twitter_space_link").prop('required',false);
            
            $("#current_space_listeners_block").css("display", "none");
            $("#current_space_listeners").prop('required',false);
            
            $("#discord_invite_link_block").css("display", "none");
            $("#discord_invite_link").prop('required',false);
            
            $("#time_quantity_block").css("display", "none");
            $("#time_quantity").prop('required',false);
            
            $("#discord_channel_name_block").css("display", "none");
            $("#discord_channel_name").prop('required',false);
        }
        else if(service_id == 31)
        {
            $("#tweet_link_block").css("display", "block");
            $("#tweet_link").prop('required',true);
            
            $("#profile_url_block").css("display", "none");
            $("#profile_url").prop('required',false);
            
            $("#quantity_block").css("display", "block");
            $("#quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#speed_block").css("display", "none");
            $("#speed").prop('required',false);
            
            $("#quality_block").css("display", "none");
            $("#quality").prop('required',false);
            
            $("#custom_comments_block").css("display", "block");
            $("#custom_comments").prop('required',true);
            
            $("#twitter_space_link_block").css("display", "none");
            $("#twitter_space_link").prop('required',false);
            
            $("#current_space_listeners_block").css("display", "none");
            $("#current_space_listeners").prop('required',false);
            
            $("#discord_invite_link_block").css("display", "none");
            $("#discord_invite_link").prop('required',false);
            
            $("#time_quantity_block").css("display", "none");
            $("#time_quantity").prop('required',false);
            
            $("#discord_channel_name_block").css("display", "none");
            $("#discord_channel_name").prop('required',false);
        }
        else if(service_id == 8 || service_id == 9)
        {
            $("#tweet_link_block").css("display", "block");
            $("#tweet_link").prop('required',true);
            
            $("#quantity_block").css("display", "block");
            $("#quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#speed_block").css("display", "block");
            $("#speed").prop('required',true);
            
            $("#quality_block").css("display", "block");
            $("#quality").prop('required',true);
            
            $("#profile_url_block").css("display", "block");
            $("#profile_url").prop('required',true);
            
            $("#custom_comments_block").css("display", "none");
            $("#custom_comments").prop('required',false);
            
            $("#twitter_space_link_block").css("display", "none");
            $("#twitter_space_link").prop('required',false);
            
            $("#current_space_listeners_block").css("display", "none");
            $("#current_space_listeners").prop('required',false);
            
            $("#discord_invite_link_block").css("display", "none");
            $("#discord_invite_link").prop('required',false);
            
            $("#time_quantity_block").css("display", "none");
            $("#time_quantity").prop('required',false);
            
            $("#discord_channel_name_block").css("display", "none");
            $("#discord_channel_name").prop('required',false);
        }
        else if(service_id == 8 || service_id == 9)
        {
            $("#tweet_link_block").css("display", "block");
            $("#tweet_link").prop('required',true);
            
            $("#quantity_block").css("display", "block");
            $("#quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#speed_block").css("display", "block");
            $("#speed").prop('required',true);
            
            $("#quality_block").css("display", "block");
            $("#quality").prop('required',true);
            
            $("#profile_url_block").css("display", "block");
            $("#profile_url").prop('required',true);
            
            $("#custom_comments_block").css("display", "block");
            $("#custom_comments").prop('required',true);
            
            $("#twitter_space_link_block").css("display", "none");
            $("#twitter_space_link").prop('required',false);
            
            $("#current_space_listeners_block").css("display", "none");
            $("#current_space_listeners").prop('required',false);
            
            $("#discord_invite_link_block").css("display", "none");
            $("#discord_invite_link").prop('required',false);
            
            $("#time_quantity_block").css("display", "none");
            $("#time_quantity").prop('required',false);
            
            $("#discord_channel_name_block").css("display", "none");
            $("#discord_channel_name").prop('required',false);
        }
        else if(service_id == 5 || service_id == 21)
        {
            $("#tweet_link_block").css("display", "block");
            $("#tweet_link").prop('required',true);
            
            $("#custom_comments_block").css("display", "block");
            $("#custom_comments").prop('required',true);
            
            $("#quantity_block").css("display", "block");
            $("#quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#speed_block").css("display", "block");
            $("#speed").prop('required',true);
            
            $("#quality_block").css("display", "block");
            $("#quality").prop('required',true);

            $("#twitter_space_link_block").css("display", "none");
            $("#twitter_space_link").prop('required',false);
            
            $("#current_space_listeners_block").css("display", "none");
            $("#current_space_listeners").prop('required',false);
            
            $("#discord_invite_link_block").css("display", "none");
            $("#discord_invite_link").prop('required',false);
            
            $("#profile_url_block").css("display", "none");
            $("#profile_url").prop('required',false);
            
            $("#time_quantity_block").css("display", "none");
            $("#time_quantity").prop('required',false);
            
            $("#discord_channel_name_block").css("display", "none");
            $("#discord_channel_name").prop('required',false);
        }
        else if(service_id == 4 || service_id == 27 || service_id == 13 || service_id == 28 || service_id == 29 || service_id == 2
             || service_id == 16 || service_id == 17 || service_id == 18 || service_id == 19 || service_id == 20)
        {
            $("#tweet_link_block").css("display", "block");
            $("#tweet_link").prop('required',true);
            
            $("#quantity_block").css("display", "block");
            $("#quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#speed_block").css("display", "block");
            $("#speed").prop('required',true);

            $("#quality_block").css("display", "none");
            $("#quality").prop('required',false);
            
            $("#custom_comments_block").css("display", "none");
            $("#custom_comments").prop('required',false);
            
            $("#twitter_space_link_block").css("display", "none");
            $("#twitter_space_link").prop('required',false);
            
            $("#current_space_listeners_block").css("display", "none");
            $("#current_space_listeners").prop('required',false);
            
            $("#discord_invite_link_block").css("display", "none");
            $("#discord_invite_link").prop('required',false);
            
            $("#profile_url_block").css("display", "none");
            $("#profile_url").prop('required',false);
            
            $("#time_quantity_block").css("display", "none");
            $("#time_quantity").prop('required',false);
            
            $("#discord_channel_name_block").css("display", "none");
            $("#discord_channel_name").prop('required',false);
        }
        else if(service_id == 30)
        {
            $("#twitter_space_link_block").css("display", "block");
            $("#twitter_space_link").prop('required',true);
            
            $("#current_space_listeners_block").css("display", "block");
            $("#current_space_listeners").prop('required',true);
            
            $("#time_quantity_block").css("display", "block");
            $("#time_quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#tweet_link_block").css("display", "none");
            $("#tweet_link").prop('required',false);
            
            $("#quantity_block").css("display", "none");
            $("#quantity").prop('required',false);
            
            $("#speed_block").css("display", "none");
            $("#speed").prop('required',false);
            
            $("#quality_block").css("display", "none");
            $("#quality").prop('required',false);
            
            $("#profile_url_block").css("display", "none");
            $("#profile_url").prop('required',false);
            
            $("#custom_comments_block").css("display", "none");
            $("#custom_comments").prop('required',false);
            
            $("#discord_invite_link_block").css("display", "none");
            $("#discord_invite_link").prop('required',false);
            
            $("#discord_channel_name_block").css("display", "none");
            $("#discord_channel_name").prop('required',false);
        }
        else if(service_id == 15)
        {
            $("#discord_invite_link_block").css("display", "block");
            $("#discord_invite_link").prop('required',true);
            
            $("#quantity_block").css("display", "block");
            $("#quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#twitter_space_link_block").css("display", "none");
            $("#twitter_space_link").prop('required',false);
            
            $("#current_space_listeners_block").css("display", "none");
            $("#current_space_listeners").prop('required',false);
            
            $("#time_quantity_block").css("display", "none");
            $("#time_quantity").prop('required',false);
            
            $("#tweet_link_block").css("display", "none");
            $("#tweet_link").prop('required',false);
            
            $("#speed_block").css("display", "none");
            $("#speed").prop('required',false);
            
            $("#quality_block").css("display", "none");
            $("#quality").prop('required',false);
            
            $("#profile_url_block").css("display", "none");
            $("#profile_url").prop('required',false);
            
            $("#custom_comments_block").css("display", "none");
            $("#custom_comments").prop('required',false);
            
            $("#discord_channel_name_block").css("display", "none");
            $("#discord_channel_name").prop('required',false);
        }
        else if(service_id == 22)
        {
            $("#discord_invite_link_block").css("display", "block");
            $("#discord_invite_link").prop('required',true);
            
            $("#quantity_block").css("display", "block");
            $("#quantity").prop('required',true);
            
            $("#price_block").css("display", "block");
            $("#price").prop('required',true);
            
            $("#discord_channel_name_block").css("display", "block");
            $("#discord_channel_name").prop('required',true);

            $("#twitter_space_link_block").css("display", "none");
            $("#twitter_space_link").prop('required',false);
            
            $("#current_space_listeners_block").css("display", "none");
            $("#current_space_listeners").prop('required',false);
            
            $("#time_quantity_block").css("display", "none");
            $("#time_quantity").prop('required',false);
            
            $("#tweet_link_block").css("display", "none");
            $("#tweet_link").prop('required',false);
            
            $("#speed_block").css("display", "none");
            $("#speed").prop('required',false);
            
            $("#quality_block").css("display", "none");
            $("#quality").prop('required',false);
            
            $("#profile_url_block").css("display", "none");
            $("#profile_url").prop('required',false);
            
            $("#custom_comments_block").css("display", "none");
            $("#custom_comments").prop('required',false)
        }
        else
        {
            $("#discord_invite_link_block").css("display", "none");
            $("#quantity_block").css("display", "none");
            $("#price_block").css("display", "none");
            $("#discord_channel_name_block").css("display", "none");
            $("#twitter_space_link_block").css("display", "none");
            $("#current_space_listeners_block").css("display", "none");
            $("#time_quantity_block").css("display", "none");
            $("#tweet_link_block").css("display", "none");
            $("#speed_block").css("display", "none");
            $("#quality_block").css("display", "none");
            $("#profile_url_block").css("display", "none");
            $("#custom_comments_block").css("display", "none");
        }
    }

</script>

@endpush