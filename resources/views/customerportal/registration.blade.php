
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Chaintasker | Customer Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}">

        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="account-body">

        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <div class="auth-logo-box">
                                    <a href="{{ url('/') }}" class="logo logo-admin"><img src="{{ asset('public/images/logo.png') }}" height="55" alt="logo" class="auth-logo"></a>
                                </div>
                                
                                <div class="text-center auth-logo-text">
                                    <h4 class="mt-0 mb-3 mt-5">Let's Get Started</h4>
                                    <p class="text-muted mb-0">Sign up to continue</p>  
                                </div>

                                @if(session('error_msg'))
                                <p class="alert alert-danger">{{session('error_msg')}}</p> 
                                @endif
                                <form class="form-horizontal auth-form my-4" method="post" action="{{ url('/customer_register') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i> 
                                            </span>
                                            <input type="name" class="form-control" id="username" name="username" placeholder="Enter username" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i> 
                                            </span>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="userpassword">Password</label>                                            
                                        <div class="input-group mb-3"> 
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i> 
                                            </span>
                                            <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>                                            
                                        <div class="input-group mb-3"> 
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i> 
                                            </span>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter password again" required>
                                        </div>
                                    </div>
        
                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit">Sign Up <i class="fas fa-add-user ml-1"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="m-3 text-center text-muted">
                                <p class="">Already have an account ?  <a href="{{ url('/login') }}" class="text-primary ml-2">Sign In</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/waves.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.slimscroll.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('public/assets/js/app.js') }}"></script>

    </body>
</html>