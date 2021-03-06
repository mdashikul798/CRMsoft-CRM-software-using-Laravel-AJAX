@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-users"></i>
   </div>
   <div class="header-title">
      <h1>Customer</h1>
      <small>Customer List</small>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-sm-12">
         <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
               <div class="btn-group" id="buttonexport">
                  <a href="#">
                     <h4>Add customer</h4>
                  </a>
               </div>
            </div>
            <div class="panel-body">
            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="btn-group">
                  <div class="buttonexport" id="buttonlist"> 
                     <a class="btn btn-add" href="{{ route('add.customer') }}"> <i class="fa fa-plus"></i> Add Customer
                     </a>  
                  </div>
                  <button class="btn btn-exp btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
                  <ul class="dropdown-menu exp-drop" role="menu">
                     <li>
                        <a href="#"> 
                        <i class="fa fa-download" aria-hidden="true"></i> Download</a>
                     </li>
                     <li>
                        <a href="#"> 
                        <i class="fa fa-file-pdf-o"></i> PDF</a>
                     </li>
                     <li>
                        <a href="#"> <i class="fa fa-print"></i> Print</a>
                     </li>
                  </ul>
               </div>
               <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="table-responsive">
                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr class="info">
                           <th>Photo</th>
                           <th>Customer Name</th>
                           <th>Mobile</th>
                           <th>Email</th>
                           <th>Address</th>
                           <th>type</th>
                           <th>Join</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td><img src="assets/dist/img/w1.png" class="img-circle" alt="User Image" width="50" height="50"> </td>
                           <td>MD. Alimul Alrazy</td>
                           <td>+8801674688663</td>
                           <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6b0a07190a11122b1f030e060e06020502181f0e1945080406">[email&#160;protected]</a></td>
                           <td>98 Green Rd, Dhaka 1215, Bangladesh</td>
                           <td>V.I.P</td>
                           <td>27th April,2017</td>
                           <td><span class="label-custom label label-default">Active</span></td>
                           <td>
                              <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1"><i class="fa fa-pencil"></i></button>
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
                           </td>
                        </tr>
                        <tr>
                           <td><img src="assets/dist/img/w2.png" class="img-circle" alt="User Image" width="50" height="50"> </td>
                           <td>MD. Alrazy</td>
                           <td>+8801674688663</td>
                           <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f2939e8093888bb2869a979f979f9b9c9b81869780dc919d9f">[email&#160;protected]</a></td>
                           <td>98 Green Rd, Dhaka 1215, Bangladesh</td>
                           <td>V.I.P</td>
                           <td>27th April,2017</td>
                           <td><span class="label-danger label label-default">Inctive</span></td>
                           <td>
                              <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1"><i class="fa fa-pencil"></i></button>
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
                           </td>
                        </tr>
                        <tr>
                           <td><img src="assets/dist/img/w3.png" class="img-circle" alt="User Image" width="50" height="50"> </td>
                           <td>Mrs. Jorina Begum</td>
                           <td>+8801674688663</td>
                           <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="84e5e8f6e5fefdc4f0ece1e9e1e9edeaedf7f0e1f6aae7ebe9">[email&#160;protected]</a></td>
                           <td>98 Green Rd, Dhaka 1215, Bangladesh</td>
                           <td>V.I.P</td>
                           <td>27th April,2017</td>
                           <td><span class="label-danger label label-default">Inctive</span></td>
                           <td>
                              <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1"><i class="fa fa-pencil"></i></button>
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
                           </td>
                        </tr>
                        <tr>
                           <td><img src="assets/dist/img/w4.png" class="img-circle" alt="User Image" width="50" height="50"> </td>
                           <td>Mrs. Rabeya Begum</td>
                           <td>+8801674688663</td>
                           <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d0b1bca2b1aaa990a4b8b5bdb5bdb9beb9a3a4b5a2feb3bfbd">[email&#160;protected]</a></td>
                           <td>98 Green Rd, Dhaka 1215, Bangladesh</td>
                           <td>V.I.P</td>
                           <td>27th April,2017</td>
                           <td><span class="label-custom label label-default">Active</span></td>
                           <td>
                              <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1"><i class="fa fa-pencil"></i></button>
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- customer Modal1 -->
   <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Update Customer</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal">
                        <fieldset>
                           <!-- Text input-->
                           <div class="col-md-4 form-group">
                              <label class="control-label">Customer Name:</label>
                              <input type="text" placeholder="Customer Name" class="form-control">
                           </div>
                           <!-- Text input-->
                           <div class="col-md-4 form-group">
                              <label class="control-label">Email:</label>
                              <input type="email" placeholder="Email" class="form-control">
                           </div>
                           <!-- Text input-->
                           <div class="col-md-4 form-group">
                              <label class="control-label">Mobile</label>
                              <input type="number" placeholder="Mobile" class="form-control">
                           </div>
                           <div class="col-md-6 form-group">
                              <label class="control-label">Address</label><br>
                              <textarea name="address" rows="3"></textarea>
                           </div>
                           <div class="col-md-6 form-group">
                              <label class="control-label">type</label>
                              <input type="text" placeholder="type" class="form-control">
                           </div>
                           <div class="col-md-12 form-group user-form-group">
                              <div class="pull-right">
                                 <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                 <button type="submit" class="btn btn-add btn-sm">Save</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
   <!-- Modal -->    
   <!-- Customer Modal2 -->
   <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Delete Customer</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal">
                        <fieldset>
                           <div class="col-md-12 form-group user-form-group">
                              <label class="control-label">Delete Customer</label>
                              <div class="pull-right">
                                 <button type="button" class="btn btn-danger btn-sm">NO</button>
                                 <button type="submit" class="btn btn-add btn-sm">YES</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
</section>
   <!-- customer Modal1 -->
@endsection