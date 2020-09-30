<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('public/component') }}/assets/dist/img/ico/favicon.png" type="image/x-icon">
    <title>Invoice</title>
    <style type="text/css">
      /* reset */
      *{
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
      }

      /* content editable */
      *[contentreadonly] { border-radius: 0.25em; min-width: 1em; outline: 0;  cursor: pointer; display: inline-block;}
      *[contentreadonly]:hover, *[contentreadonly]:focus, td:hover *[contentreadonly], td:focus *[contentreadonly], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

      /*span[contenteditable] { display: inline-block; }*/

      /* heading */
      h1 { font: bold 100% Ubuntu, Arial, sans-serif; text-align: center; text-transform: uppercase; }

      /* table */
      table { font-size: 75%; width: 100%; }
      table { border-collapse: separate; border-spacing: 2px; }
      th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
      th, td { border-radius: 0.25em; border-style: solid; }
      th { background: #EEE; border-color: #BBB; }
      td { border-color: #DDD; }

      /* page */
      html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; }
      html { background: #fff; cursor: default; }
      body { box-sizing: border-box; margin:0;}
      #wrapper{height: 29.7cm; margin: 0 auto; width: 21cm; }
      body { background: #FFF;}

      /* header */
      header { margin: 0 0 3em; }
      header:after { clear: both; content: ""; display: table; }
      header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
      header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
      header address p { margin: 0 0 0.25em; }
      header span, header img { display: block; float: right; }
      header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
      header img { max-height: 100%; max-width: 50%; }
      header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

      /* article */
      article, article address, table.meta, table.inventory { margin: 0 0 3em; }
      article:after { clear: both; content: ""; display: table; }
      article h1 { clip: rect(0 0 0 0); position: absolute; }
      article address { float: left; font-size: 125%; font-weight: bold; }

      /* table meta & balance */
      table.meta, table.balance { float: right; width: 36%; }
      table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

      /* table meta */
      table.meta th { width: 40%; }
      table.meta td { width: 60%; }

      /* table items */
      table.inventory { clear: both; width: 100%; }
      table.inventory th { font-weight: bold; text-align: center; }
      table.inventory td:nth-child(1) { width: 10%; }
      table.inventory td:nth-child(2) { width: 50%; }
      table.inventory td:nth-child(3) { text-align: right; width: 15%; }
      table.inventory td:nth-child(4) { text-align: right; width: 10%; }
      table.inventory td:nth-child(5) { text-align: right; width: 15%; }

      /* table balance */
      table.balance th, table.balance td { width: 50%; }
      table.balance td { text-align: right; }

      /* aside */
      aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
      aside h1 { border-color: #999; border-bottom-style: solid; }

      .cutw{position:relative;}
      /* javascript */

      .add, .cut
      {
        border-width: 1px;
        display: block;
        font-size: .8em;
        padding: 0.25em;
        float: left;
        text-align: center;
        width:0.8em;
      }
      .cut{font-size:1em;}
      .add, .cut
      {
        background: #9AF;
        box-shadow: 0 1px 2px rgba(0,0,0,0.2);
        background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
        background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
        border-radius: 0.5em;
        border-color: #0076A3;
        color: #FFF;
        cursor: pointer;
        font-weight: bold;
        text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
      }
      .add { margin: -2.5em 0 0; }
      .add:hover { background: #00ADEE; }
      .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
      tr:hover .cut { opacity: 1; }

      @media print {
        * { -webkit-print-color-adjust: exact; }
        html { background: none; padding: 0; }
        body { box-shadow: none; margin: 0; }
        span:empty { display: none; }
        .add, .cut { display: none; }
      }
      @page { margin: 0; }
    </style>
    
  </head>
  <body>
    <div id="wrapper">
      @php
          use App\Model\User\Sale\OtherSale;
          $other = OtherSale::orderBy('id', 'DESC')
             ->where('token', Session('_token'))->get();
       @endphp
       @if(Session::has('session_id'))
      <header>
        <h1>Invoice</h1>
        <address contentreadonly>
          <p>Md Rafsan Ansari</p>
          <p>Jhaudanga Bazar<br>Satkhira, Khulna</p>
          <p>(880) 1234567</p>
        </address>
        <span><img alt="" src="{{ asset('public/component') }}/assets/dist/img/logo.png" /></span>
      </header>
      <article>
       @foreach($allSale as $sale)

       @endforeach
                     
        <h1>Recipient</h1>
        <address contentreadonly>
          <p>
            Name: {{ $allSale['0']['customer_name'] }}<br>
            Phone: {{ $allSale['0']['customer_phone'] }}
          </p>
        </address>
        <table class="meta">
          <tr>
            <th><span contentreadonly>Invoice #</span></th>
            <td><span contentreadonly>{{ $allSale['0']['invoiceNum'] }}</span></td>
          </tr>
          <tr>
            <th><span contentreadonly>Date</span></th>
            <td><span contentreadonly>{{ date('d-m-Y') }}</span></td>
          </tr>
          <tr>
            @php
              $totalDue = 0;
            @endphp
            @foreach($allSale as $sale)
              @php
                $totalDue += $sale->amountDue;
              @endphp
            @endforeach
            <th><span contentreadonly style="font-weight:bold;">Amount Due</span></th>
            <td>TK. <span id="prefix" contentreadonly style="font-weight:bold;">{{ number_format($totalDue) }}</span></td>
          </tr>
        </table>
        <table class="inventory">
          <thead>
            <tr>
              <th>Item</th>
              <th><span contentreadonly>Description</span></th>
              <th><span contentreadonly>Price</span></th>
              <th><span contentreadonly>Due</span></th>
              <th><span contentreadonly>Sub-Total</span></th>
            </tr>
          </thead>
          <tbody>
            @php
              $total_price = 0;
              $amountDue = 0;
            @endphp
            @foreach($allSale as $sale)
            @php
              $total_price += $sale->price;
              $amountDue += $sale->amountDue;
            @endphp
            <tr>
               <td>{{ $loop->index +1 }}</td>
               <td>{{ $sale->item_name }} - {{ $sale->item_code }}</td>
               <td>TK. {{ number_format($sale->price) }}</td>
               <td>TK. {{ number_format($sale->amountDue) }}</td>
               
               <td>TK. {{ number_format($sale->price - $sale->amountDue) }}</td>
            </tr>
            
            @endforeach
          </tbody>
        </table>
        <table class="balance">
          <tr>
            <th><span contentreadonly style="font-weight:bold;">Total</span></th>
            <td>
              <p id="totalAmount" style="font-weight:bold;">TK. {{ number_format($total_price) }}</p>
            </td>
          </tr>
          <tr>
            <th><span contentreadonly>Amount Paid</span></th>
            <td>
              <p id="dueBalance">TK. {{ number_format($total_price - $amountDue) }}</p>
            </td>
          </tr>
          <tr>
            <th><span contentreadonly style="font-weight:bold;">Balance Due</span></th>
              <td>
                <p id="dueBalance" style="font-weight:bold;">TK. {{ number_format($amountDue) }}</p>
              </td>
          </tr>
        </table>
      </article>
      <aside>
        <h1><span contentreadonly>Additional Notes</span></h1>
        

        <a href="{{ route('other.sale.print') }}" target="_blank" style="padding:10px;background:rgb(10 65 67 / 89%);color:#fff;float:right;"><img src="{{ asset('public/component') }}/assets/dist/img/printer.png" style="width:30px;height:24px;padding:0;margin-right:4px;margin-top:-3px;">Print</a>

        <a href="{{ route('other.sale') }}" style="padding:10px;background:rgb(10 65 67 / 89%);color:#fff;float:right;margin-right:5px;"><img src="{{ asset('public/component') }}/assets/dist/img/home-icon.png" style="width:30px;height:24px;padding:0;margin-right:4px;margin-top:-3px;">Home</a>
      </aside>
      @else
      <h2>No item is added to show</h2>
      @endif
    </div>
  </body>
</html>