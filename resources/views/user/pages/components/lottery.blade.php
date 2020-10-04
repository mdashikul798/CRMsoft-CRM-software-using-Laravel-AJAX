<!DOCTYPE html>
<html>
 <head>
  <title>CRM-soft</title>

  <link rel="stylesheet" href="{{ asset('public/component') }}/assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{ asset('public/component') }}/assets/plugins/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
 </head>
 <body>
  <br />
  <div class="container box">
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="row">
      <div class="col-md-5">Sample Data - Total Records - <b><span id="total_records"></span></b></div>
      <div class="col-md-5">
       <div class="input-group input-daterange">
           <input type="text" name="from_date" id="from_date" readonly class="form-control" />
           <div class="input-group-addon">to</div>
           <input type="text"  name="to_date" id="to_date" readonly class="form-control" />
       </div>
      </div>
      <div class="col-md-2">
       <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
      </div>
     </div>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>S.L</th>
         <th>Date</th>
         <th>Voucher No.</th>
         <th>Product Name</th>
         <th>Customer Name</th>
         <th>Phone</th>
         <th>Price</th>
         <th>Qty</th>
         <th>Descount</th>
         <th>Total</th>
        </tr>
       </thead>
       <tbody>
       
       </tbody>
      </table>
      {{ csrf_field() }}
     </div>
    </div>
   </div>
  </div>
  <script src="{{ asset('public/component') }}/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{ asset('public/component') }}/assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
  <script src="{{ asset('public/component') }}/assets/plugins/js/bootstrap-datepicker.js"></script>
  <script>
    $(document).ready(function(){

     var date = new Date();

     $('.input-daterange').datepicker({
      todayBtn: 'linked',
      format: 'yyyy-mm-dd',
      autoclose: true
     });

     var _token = $('input[name="_token"]').val();

     fetch_data();

     function fetch_data(from_date = '', to_date = '')
     {
      $.ajax({
       url:"{{ route('daterange.fetch_data') }}",
       method:"POST",
       data:{from_date:from_date, to_date:to_date, _token:_token},
       dataType:"json",
       success:function(data)
       {
        var output = '';
        $('#total_records').text(data.length);
        for(var count = 0; count < data.length; count++)
        {
          
         output += '<tr>';
         output += '<td>' + length++ + '</td>';
         output += '<td>' + data[count].created_at.slice(0,10) + '</td>';
         output += '<td>' + data[count].invoiceNum + '</td>';
         output += '<td>' + data[count].item_name + '</td>';
         output += '<td>' + data[count].customer_name + '</td>';
         output += '<td>' + data[count].phone + '</td>';
         output += '<td>' + data[count].price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</td>';
         output += '<td>' + data[count].quentity + '</td>';
         output += '<td>' + data[count].discount + '</td>';
         output += '<td>' + (data[count].price*data[count].quentity).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</td></tr>';
        }
        $('tbody').html(output);
       }
      })
     }

     $('#filter').click(function(){
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      if(from_date != '' &&  to_date != '')
      {
       fetch_data(from_date, to_date);
      }
      else
      {
       alert('Both Date is required');
      }
     });

     $('#refresh').click(function(){
      $('#from_date').val('');
      $('#to_date').val('');
      fetch_data();
     });
    });
</script>
 </body>
</html>

