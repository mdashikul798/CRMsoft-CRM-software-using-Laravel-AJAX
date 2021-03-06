@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-bar-chart"></i>
   </div>
   <div class="header-title">
      <h1>All Asset</h1>
      <small>Customer List</small>
   </div>
   <div class="btn-group" id="buttonlist" style="float:right;top:-45px;">
      <input type="text" class="search form-control" placeholder="What you looking for?">
   </div>
   <span class="counter pull-right" style="margin-top:-38px;padding:5px;"></span>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-sm-12">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="btn-group" id="buttonexport">
                  <a href="#">
                     <h4>Sales incormation</h4>
                  </a>
               </div>
            </div>
            <div class="panel-body">
            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="btn-group">
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
                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover results">
                     <thead>
                        <tr class="info">
                           <th>S.L No.</th>
                           <th>Asset Name</th>
                           <th>Purchase Date</th>
                           <th>Purchase Price</th>
                           <th>Percent (%)</th>
                           <th>Accu. Dep.</th>
                           <th>Current Dep.</th>
                           <th>Current Value</th>
                        </tr>
                        <tr class="warning no-result">
                           <td colspan="4"><i class="fa fa-warning"></i> No result matched</td>
                        </tr>
                     </thead>
                     <tbody>
                      @php
                        $totalValue = 0;
                      @endphp
                        @foreach($allAsset as $asset)
                        <tr>
                          <td>{{ $loop->index +1 }}</td>
                          <td>{{ $asset->asset_name }}</td>
                          <td>{{ date_format(new dateTime($asset->created_at), 'd-m-y') }}</td>
                           <td>{{ number_format($asset->purchase_price) }}</td>
                           <td>{{ $asset->percent }} %</td>
                           <td>{{ number_format($asset->accumulated) }}</td>
                           <td>{{ number_format($asset->depreciation) }}</td>
                           <td>{{ number_format($asset->present_value) }}</td>
                        </tr>
                        @php
                        $totalValue += $asset->present_value;
                      @endphp
                        @endforeach
                        <tr>
                          <td colspan="7" style="text-align:right;font-weight:bold;">Total Current Value</td>
                          <td style="font-weight:bold;">{{ number_format($totalValue) }}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
   <!-- customer Modal1 -->
@endsection