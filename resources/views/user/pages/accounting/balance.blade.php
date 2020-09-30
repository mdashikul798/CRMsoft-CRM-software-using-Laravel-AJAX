@extends('user.layouts.app')

@section('content')
   <div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="What you looking for?">
   </div>
   <span class="counter pull-right"></span>
   <table class="table table-hover table-bordered results">
     <thead>
       <tr>
         <th>#</th>
         <th class="col-md-5 col-xs-5">Names / Surname</th>
         <th class="col-md-4 col-xs-4">Jobs</th>
         <th class="col-md-3 col-xs-3">Citys</th>
         <th class="col-md-3 col-xs-3">price</th>
         <th class="col-md-3 col-xs-3">Country</th>
       </tr>
       <tr class="warning no-result">
         <td colspan="4"><i class="fa fa-warning"></i> No result matched</td>
       </tr>
     </thead>
     <tbody>
       <tr>
         <th scope="row">1</th>
         <td>Vatanay Özbeyli</td>
         <td>UI & UX</td>
         <td>Istanbul</td>
         <td>Istanbul</td>
         <td>Ashikul</td>
       </tr>
       <tr>
         <th scope="row">2</th>
         <td>Burak Özkan</td>
         <td>Software Developer</td>
         <td>Istanbul</td>
         <td>Istanbul</td>
         <td>Istanbul</td>
       </tr>
       <tr>
         <th scope="row">3</th>
         <td>Egemen Özbeyli</td>
         <td>Purchasing</td>
         <td>Kocaeli</td>
         <td>Kocaeli</td>
         <td>Kocaeli</td>
       </tr>
       <tr>
         <th scope="row">4</th>
         <td>Engin Kızıl</td>
         <td>Sales</td>
         <td>Bozuyük</td>
         <td>Bozuyük</td>
         <td>Bozuyük</td>
       </tr>
     </tbody>
   </table>
<!-- /.content -->
@endsection
