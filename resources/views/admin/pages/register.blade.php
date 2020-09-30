<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CRM Admin Panel</title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="{{ asset('public/component') }}/assets/dist/img/ico/favicon.png" type="image/x-icon">
        <!-- Bootstrap -->
        <link href="{{ asset('public/component') }}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Pe-icon-7-stroke -->
        <link href="{{ asset('public/component') }}/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- style css -->
        <link href="{{ asset('public/component') }}/assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper">
            <div class="back-link">
                <a href="#" class="btn btn-add">Back to Dashboard</a>
            </div>
            <div class="container-center lg">
             <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Register</h3>
                                <small><strong>Please enter your data to register.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="index.html" id="loginForm" novalidate>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Username</label>
                                    <input type="text" value="" id="username" class="form-control" name="username">
                                    <span class="help-block small">Your unique username to app</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Password</label>
                                    <input type="password" value="" id="password" class="form-control" name="password">
                                    <span class="help-block small">Your hard to guess password</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Repeat Password</label>
                                    <input type="password" value="" id="repeatpassword" class="form-control" name="repeatpassword">
                                    <span class="help-block small">Please repeat your pasword</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email Address</label>
                                    <input type="text" value="" id="email" class="form-control" name="email">
                                    <span class="help-block small">Your address email to contact</span>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-warning">Register</button>
                                <a class="btn btn-add" href="{{ route('login') }}">Login</a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="{{ asset('public/component') }}/assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="{{ asset('public/component') }}/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>