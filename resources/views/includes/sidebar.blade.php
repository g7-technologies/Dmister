<!-- Left Sidenav -->
<div class="left-sidenav">
    <div class="main-icon-menu">
        <nav class="nav">
            
            <a href="#Dashboard" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Dashboard">
                <i class="text-white mdi mdi-speedometer mdi-18px"></i>
            </a>
            
            <a href="#Orders" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Orders">
                <i class="text-white mdi mdi-gift mdi-18px"></i>
            </a>

            <a href="#Funds" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Funds">
                <i class="text-white mdi mdi-cash mdi-18px"></i>
            </a>

            <a href="#Coins" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Coins">
                <i class="text-white mdi mdi-coin mdi-18px"></i>
            </a>

            <a href="#Category" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Category">
                <i class="text-white mdi mdi-text mdi-18px"></i>
            </a>

            <a href="#Service" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Service">
                <i class="text-white mdi mdi-filter mdi-18px"></i>
            </a>

            <a href="#Settings" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Settings">
                <i class="text-white mdi mdi-settings"></i>
            </a>
            
        </nav>
    </div>

    <div class="main-menu-inner">
        <div class="menu-body slimscroll">
            
            <div id="Dashboard" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Dashboard</h6>       
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin_dashboard') }}">
                            <span class="w-100"> Dashboard</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div id="Orders" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Orders</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/all_orders')}}">
                            <span class="w-100">All Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/awaiting_orders')}}">
                            <span class="w-100">Awaiting Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/pending_orders')}}">
                            <span class="w-100">Pending Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/processing_orders')}}">
                            <span class="w-100">Processing Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/inprogress_orders')}}">
                            <span class="w-100">In Progress Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/completed_orders')}}">
                            <span class="w-100">Completed Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/partial_orders')}}">
                            <span class="w-100">Partial Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/cancelled_orders')}}">
                            <span class="w-100">Cancelled Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/refunded_orders')}}">
                            <span class="w-100">Refunded Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
            </div>

            <div id="Funds" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Funds</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/funds')}}">
                            <span class="w-100">Funds</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/transactions')}}">
                            <span class="w-100">Transactions</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
                
            </div>

            <div id="Coins" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Coins</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/add_coin')}}">
                            <span class="w-100">Add Coin</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/view_coins')}}">
                            <span class="w-100">View Coins</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
                
            </div>

            <div id="Category" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Category</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/view_categories')}}">
                            <span class="w-100">View Categories</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
                
            </div>

            <div id="Service" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Services</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/view_services')}}">
                            <span class="w-100">View Services</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
                
            </div>

            <div id="Settings" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Settings</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/change_password')}}">
                            <span class="w-100">Change Password</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/logout')}}">
                            <span class="w-100">Logout</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>

                </ul>
            </div>
            
        </div>
    </div>
</div>