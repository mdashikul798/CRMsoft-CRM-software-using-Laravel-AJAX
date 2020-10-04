<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM-Soft | Admin Panel</title>
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="{{ asset('public/component') }}/assets/dist/img/ico/favicon.png" type="image/x-icon">
      <!-- Start Global Mandatory Style
         =====================================================================-->
      <!-- jquery-ui css -->
      {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css"/> --}}
      <link rel="stylesheet" href="{{ asset('public/component') }}/assets/dist/css/chosen.min.css"/>
      <link href="{{ asset('public/component') }}/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <!-- Bootstrap -->
      <link href="{{ asset('public/component') }}/assets/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">
      <link href="{{ asset('public/component') }}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <!-- Bootstrap rtl -->
      <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
      <!-- Lobipanel css -->
      <link href="{{ asset('public/component') }}/assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <!-- Pace css -->
      <link href="{{ asset('public/component') }}/assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <!-- Font Awesome -->
      <link href="{{ asset('public/component') }}/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <!-- Pe-icon -->
      <link href="{{ asset('public/component') }}/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <!-- Themify icons -->
      <link href="{{ asset('public/component') }}/assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="{{ asset('public/component') }}/assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <!-- Theme style rtl -->
      <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
      <!-- End Theme Layout Style
         =====================================================================-->
   </head>
   <body class="hold-transition sidebar-mini">
      <!-- Site wrapper -->
      <div class="wrapper">
         <header class="main-header">
            <a href="{{ route('user.home') }}" class="logo">
               <!-- Logo -->
               <span class="logo-mini">
               <img src="{{ asset('public/component') }}/assets/dist/img/mini-logo.png" alt="">
               </span>
               <span class="logo-lg">
               <img src="{{ asset('public/component') }}/assets/dist/img/logo.png" alt="">
               </span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
               <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                  <!-- Sidebar toggle button-->
                  <span class="sr-only">Toggle navigation</span>
                  <span class="pe-7s-angle-left-circle"></span>
               </a>
               <!-- searchbar-->
               <a href="#search"><span class="pe-7s-search"></span></a>
               <div id="search">
                  <button type="button" class="close">×</button>
                  <form>
                     <input type="search" value="" placeholder="type keyword(s) here" />
                     <button type="submit" class="btn btn-add">Search...</button>
                  </form>
               </div>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- Orders -->
                     
                     <!-- Messages -->
                     
                     <!-- user -->
                     <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('public/component') }}/assets/dist/img/avatar.png" class="img-circle" width="45" height="45" alt="user"></a>
                        <ul class="dropdown-menu" >
                           <li>
                              <a href="profile.html">
                              <i class="fa fa-user"></i> User Profile</a>
                           </li>
                           <li><a href="#"><i class="fa fa-inbox"></i> Inbox</a></li>
                           <li><a href="login.html">
                              <i class="fa fa-sign-out"></i> Signout</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
         </header>
         <!-- =============================================== -->
         <!-- Left side column. contains the sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar -->
            <div class="sidebar">
               <!-- sidebar menu -->
               <ul class="sidebar-menu">
                  <li class="{{request()->is('/') ? 'active':''}}">
                     <a href="{{ route('user.home') }}"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                     <span class="pull-right-container">
                     </span>
                     </a>
                  </li>
                  <li class="treeview {{request()->is('category/*') ? 'active':''}}">
                     <a href="#">
                     <i class="fa fa-list"></i><span>Category</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{request()->is('category/add-category') ? 'active':''}}"><a href="{{ route('add.category') }}">Add Category</a></li>
                        <li class="{{request()->is('category/all-category') ? 'active':''}}"><a href="{{ route('all.category') }}">View Category</a></li>
                     </ul>
                  </li>
                  
                  <li class="treeview {{ request()->is('sale/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="fa fa-shopping-cart"></i><span>Sales</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('sale/product-sale') ? 'active' : '' }}"><a href="{{ route('product.sale') }}">Product Sale</a></li>
                        <li class="{{ request()->is('sale/asset-sale') ? 'active' : '' }}"><a href="{{ route('asset.sale') }}">Asset Sale</a></li>
                        <li class="{{ request()->is('sale/view/*') ? 'active' : '' }}"><a href="#"><span>View sales activities</span>
                           <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                           </span>
                           </a>
                           <ul class="treeview-menu">
                              <li class="{{ request()->is('sale/view/product-sale') ? 'active' : '' }}"><a href="{{ route('view.product.sale') }}">Product</a></li>
                              <li class="{{ request()->is('sale/view/asset-sale') ? 'active' : '' }}"><a href="{{ route('view.asset.sale') }}">Asset-Sale</a></li>
                           </ul>
                        </li>
                     </ul>
                  </li>
                  <li class="treeview {{ request()->is('purchase/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="fa fa-shopping-basket"></i><span>Purchase</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('purchase/product-purchase') ? 'active' : '' }}"><a href="{{ route('product.purchase') }}">Product Purchase</a></li>
                        <li class="{{ request()->is('purchase/stationery-purchase') ? 'active' : '' }}"><a href="{{ route('stationery.purchase') }}">Stationery Purchase</a></li>
                        <li class="{{ request()->is('purchase/asset-purchase') ? 'active' : '' }}"><a href="{{ route('asset.purchase') }}">Asset Purchase</a></li>

                        <li class="{{ request()->is('purchase/view/*') ? 'active' : '' }}"><a href="#"><span>View purchase activities</span>
                           <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                           </span>
                           </a>
                           <ul class="treeview-menu">
                              <li class="{{ request()->is('purchase/view/product-purchase') ? 'active' : '' }}"><a href="{{ route('view.product.purchase') }}">Product</a></li>
                              <li class="{{ request()->is('purchase/view/stationery-purchase') ? 'active' : '' }}"><a href="{{ route('view.stationery.purchase') }}">Stationery-purchase</a></li>
                              <li class="{{ request()->is('purchase/view/asset-purchase') ? 'active' : '' }}"><a href="{{ route('view.asset.purchase') }}">Asset-purchase</a></li>
                           </ul>
                        </li>


                     </ul>
                  </li>
                  <li class="treeview {{ request()->is('bank/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="fa fa-bank"></i><span>Bank</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('bank/bank-deposit') ? 'active' : '' }}"><a href="{{ route('bank.deposit') }}">Add Deposit</a></li>
                        <li class="{{ request()->is('bank/bank-withdrawal') ? 'active' : '' }}"><a href="{{ route('bank.withdrawal') }}">Add withdrawal</a></li>
                        <li class="{{ request()->is('bank/bank-statement') ? 'active' : '' }}"><a href="{{ route('bank.statement') }}">View Statement</a></li>
                     </ul>
                  </li>
                  <li class="treeview {{ request()->is('supplier/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="fa fa-user-circle"></i><span>Supplier</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('supplier/add-supplier') ? 'active' : '' }}"><a href="{{ route('add.supplier') }}">Add Supplier</a></li>
                        <li class="{{ request()->is('supplier/view-supplier') ? 'active' : '' }}"><a href="{{ route('view.supplier') }}">View Supplier</a></li>
                     </ul>
                  </li>
                  <li class="treeview {{ request()->is('income/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="hvr-buzz-out pe-7s-diamond"></i><span>Other Income</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('income/add-other-income') ? 'active' : '' }}"><a href="{{ route('other.income') }}">Add Other Income</a></li>
                        <li class="{{ request()->is('income/view-other-income') ? 'active' : '' }}"><a href="{{ route('other.view') }}">View Other Income</a></li>
                     </ul>
                  </li>
                  <li class="treeview {{ request()->is('expense/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="hvr-buzz-out fa fa-arrows-h"></i><span>Other Expense</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('expense/operating-exp') ? 'active' : '' }}"><a href="{{ route('add.operating') }}">Operating Expense</a></li>
                        <li class="{{ request()->is('expense/operating-view') ? 'active' : '' }}"><a href="{{ route('view.operating') }}">View Operating</a></li>
                        <li class="{{ request()->is('expense/admin-exp') ? 'active' : '' }}"><a href="{{ route('admin.exp.home') }}">Administrative Expense</a></li>
                        <li class="{{ request()->is('expense/admin-view') ? 'active' : '' }}"><a href="{{ route('view.admin') }}">View Administrative</a></li>
                     </ul>
                  </li>
                  <li class="treeview {{ request()->is('return/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="hvr-buzz-out pe-7s-diamond"></i><span>Return Activity</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('return/customer-return') ? 'active' : '' }}"><a href="{{ route('customer.return') }}">Ruturn from Customer</a></li>
                        <li class="{{ request()->is('return/supplier-return') ? 'active' : '' }}"><a href="{{ route('supplier.return') }}">Ruturn to Supplier</a></li>
                        <li class="{{ request()->is('return/view-return') ? 'active' : '' }}"><a href="{{ route('view.return') }}">All Ruturn</a></li>
                     </ul>
                  </li>
                  <li class="treeview {{ request()->is('accounting/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="fa fa-bar-chart"></i><span>Accounting</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('accounting/view-profit-loss') ? 'active' : '' }}"><a href="{{ route('view.profit.loss') }}">Profit & Loss</a></li>
                        <li class="{{ request()->is('accounting/view-fixed-asset') ? 'active' : '' }}"><a href="{{ route('view.fixed.asset') }}">Fixed Asset</a></li>
                        <li class="{{ request()->is('accounting/view-receivable') ? 'active' : '' }}"><a href="{{ route('view.receivable') }}">Receivable</a></li>
                        <li class="{{ request()->is('accounting/view-payable') ? 'active' : '' }}"><a href="{{ route('view.payable') }}">Payable</a></li>
                     </ul>
                  </li>
                  <li class="treeview {{ request()->is('report/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="fa fa-file-text"></i><span>Report</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('report/view-stock-report') ? 'active' : '' }}"><a href="{{ route('view.stock.report') }}">Stock Report</a></li>
                        <li class="{{ request()->is('report/view-customer-report') ? 'active' : '' }}"><a href="{{ route('view.customer.report') }}">Customer Report</a></li>
                     </ul>
                  </li>
                  <li class="treeview {{ request()->is('component/*') ? 'active' : '' }}">
                     <a href="#">
                     <i class="hvr-buzz-out fa fa-ravelry"></i><span>Components</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="{{ request()->is('component/add-bank-account') ? 'active' : '' }}"><a href="{{ route('add.bank.account') }}">Add bank account</a></li>
                        <li class="{{ request()->is('component/add-office-staff') ? 'active' : '' }}"><a href="{{ route('add.office.staff') }}">Add office staff</a></li>
                        <li class="{{ request()->is('component/add-office-branch') ? 'active' : '' }}"><a href="{{ route('add.office.branch') }}">Add branch</a></li>
                        <li class="{{ request()->is('component/add-meter') ? 'active' : '' }}"><a href="{{ route('add.meter') }}">Add electricity meter</a></li>
                        <li class="{{ request()->is('component/add-depreciation') ? 'active' : '' }}"><a href="{{ route('add.depreciation') }}">Depreciation expense</a></li>
                     </ul>
                  </li>

                  <li class="treeview {{ request()->is('customer-lottery') ? 'active' : '' }}">
                     <a href="{{ route('customer.lottery') }}" target="_blank">
                     <i class="fa fa-trophy"></i><span>Best Customer</span>
                     </a>
                  </li>
               </ul>
            </div>
            <!-- /.sidebar -->
         </aside>
         <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')
            
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <div class="pull-right hidden-xs"> <b>Version</b> 1.0</div>
            <strong>Copyright &copy; 2020-2021 <a href="#">CRM Soft</a>.</strong> All rights reserved.
         </footer>
      </div>
      <!-- ./wrapper -->
      <!-- Start Core Plugins
         =====================================================================-->
      <!-- jQuery -->
      <script src="{{ asset('public/component') }}/assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
      <script src="{{ asset('public/component') }}/assets/plugins/validation/1.16.0/jquery.validate.min.js"></script>
      <!-- jquery-ui --> 
      <script src="{{ asset('public/component') }}/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="{{ asset('public/component') }}/assets/bootstrap/js/bootstrap-toggle.min.js"></script>
      <script src="{{ asset('public/component') }}/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- lobipanel -->
      <script src="{{ asset('public/component') }}/assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <!-- Pace js -->
      <script src="{{ asset('public/component') }}/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <!-- SlimScroll -->
      <script src="{{ asset('public/component') }}/assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <!-- FastClick -->
      <script src="{{ asset('public/component') }}/assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <!-- CRMadmin frame -->
      <script src="{{ asset('public/component') }}/assets/dist/js/custom.js" type="text/javascript"></script>
      <!-- End Core Plugins
         =====================================================================-->
      <!-- Start Theme label Script
         =====================================================================-->
      <!-- Dashboard js -->
      <script src="{{ asset('public/component') }}/assets/dist/js/dashboard.js" type="text/javascript"></script>
      <!-- Pace js -->
      <!-- table-export js -->
      <script src="{{ asset('public/component') }}/assets/plugins/table-export/tableExport.js" type="text/javascript"></script>
      <script src="{{ asset('public/component') }}/assets/plugins/table-export/jquery.base64.js" type="text/javascript"></script>
      <script src="{{ asset('public/component') }}/assets/dist/js/chosen.jquery.js"></script>
      <script src="{{ asset('public/component') }}/assets/dist/js/delete.confirm.js"></script>
      <script src="{{ asset('public/component') }}/assets/dist/js/additional.js"></script>
      @yield('script')
      <!-- End Theme label Script
         =====================================================================-->
   </body>
</html>
