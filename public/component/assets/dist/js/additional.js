//sctipt for changing the category status
$(document).ready(function(){
    $('body').on('change', '#cateStatus', function(){
        var id = $(this).attr('data-id');
        if(this.checked){
            var status = 1;
        }else{
            var status = 0;
        }
        $.ajax({
            url: 'cateStatus/'+id+'/'+status,
            method: 'get',
            success: function(result){
                console.log(result);
            }
        });
    });

    //changing the status of supplier
    $('body').on('change', '#supplierStatus', function(){
        var id = $(this).attr('data-id');
        if(this.checked){
            var status = 1;
        }else{
            var status = 0;
        }
        $.ajax({
            url: 'supplierStatus/'+id+'/'+status,
            method: 'get',
            success: function(result){
                console.log(result);
            }
        });
    });

    //changing the status of bank-a/c
    $('body').on('change', '#bankStatus', function(){
        var id = $(this).attr('data-id');
        if(this.checked){
            var status = 1;
        }else{
            var status = 0;
        }
        $.ajax({
            url: 'bankStatus/'+id+'/'+status,
            method: 'get',
            success: function(result){
                console.log(result);
            }
        });
    });

    //changing the status of 'Staff'
    $('body').on('change', '#officeStaffStatus', function(){
        var id = $(this).attr('data-id');
        if(this.checked){
            var status = 1;
        }else{
            var status = 0;
        }
        $.ajax({
            url: 'officeStaffStatus/'+id+'/'+status,
            method: 'get',
            success: function(result){
                console.log(result);
            }
        });
    });

    //'Depreciationable asset' search
    $('#asset_name').autocomplete({
        source: function(request, cb){
            $.ajax({
                url: 'searchDepreciationByItem/'+request.term,
                method: 'GET',
                dataType: 'json',
                success: function(res){
                    var result;
                    result = [
                        {
                            label: 'There is no matching record found for '+request.term,
                            value: ''
                        }
                    ];
                    console.log(res);
                    
                    if (res.length) {
                        result = $.map(res, function(obj){
                            return {
                                label: obj.asset_name,
                                value: obj.asset_name,
                                data : obj
                            };
                        });
                    }
                    cb(result);
                }
            });
        },

        select:function(e, selectedData) {
            console.log(selectedData);

            if (selectedData && selectedData.item && selectedData.item.data){
                var data = selectedData.item.data;

                $('#purchase_price').val(data.purchase_price);
                $('#accumulated').val(data.accumulated);
                $('#present_value').val(data.present_value);
            }
        }
    });
    //End of 'Depreciationable asset' search

    //changing the status of 'Meter'
    $('body').on('change', '#changeMeterStatus', function(){
        var id = $(this).attr('data-id');
        if(this.checked){
            var status = 1;
        }else{
            var status = 0;
        }
        $.ajax({
            url: 'changeMeterStatus/'+id+'/'+status,
            method: 'get',
            success: function(result){
                console.log(result);
            }
        });
    });

    //changing the status of 'Branch'
    $('body').on('change', '#changeBranchStatus', function(){
        var id = $(this).attr('data-id');
        if(this.checked){
            var status = 1;
        }else{
            var status = 0;
        }
        $.ajax({
            url: 'changeBranchStatus/'+id+'/'+status,
            method: 'get',
            success: function(result){
                console.log(result);
            }
        });
    });

    //edit supplier
    $(document).ready(function(){
        $('.edit_supplier').on('click', function(){
            $('.edit_modal').modal('show');
            $tr = $(this).closest('tr');

            var data = $tr.children('td').map(function(){
                return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[0]);
            $('#name').val(data[1]);
            $('#phone').val(data[2]);
            $('#email').val(data[3]);
            $('#address').val(data[4]);
            $('#address_2').val(data[5]);
        });
        
        $('#supplierId').on('submit', function(e){
            e.preventDefault();

            var id = $('#id').val();
            $.ajax({
                method: 'get',
                url: 'editSupplier/'+id,
                data: $('#supplierId').serialize(),
                success: function(resqonse){
                    console.log(resqonse);
                    $('.edit_modal').modal('hide');
                    location.reload();
                },
                error: function(error){
                    console.log(error);
                }
            });
        });
    });
    //end of edit the supplier

    /*Script for 'Return' from customer*/
        //search by invoice number
    $('#invoiceNum').autocomplete({
        source: function(request, cb){
            $.ajax({
                url: 'customerReturnSearchByInv/'+request.term,
                method: 'GET',
                dataType: 'json',
                success: function(res){
                    var result;
                    result = [
                        {
                            label: 'There is no matching record found for '+request.term,
                            value: ''
                        }
                    ];
                    console.log(res);
                    
                    if (res.length) {
                        result = $.map(res, function(obj){
                            return {
                                label: obj.invoiceNum,
                                value: obj.invoiceNum,
                                data : obj
                            };
                        });
                    }
                    cb(result);
                }
            });
        },

        select:function(e, selectedData) {
            console.log(selectedData);

            if (selectedData && selectedData.item && selectedData.item.data){
                var data = selectedData.item.data;

                $('#item_name').val(data.item_name + ' - ' +data.item_code);
                $('#customer_name').val(data.customer_name);
                $('#phone').val(data.phone);
                $('#price').val(data.price);
                $('#discount').val(data.discount);
                $('#total').val(data.total);
                $('#quentity').val(data.quentity);
                $('#date').val(data.created_at);
            }
        }
    });

      //search by item name
    $('#item_name').autocomplete({
        source: function(request, cb){
            $.ajax({
                url: 'customerReturnSearchByItem/'+request.term,
                method: 'GET',
                dataType: 'json',
                success: function(res){
                    var result;
                    result = [
                        {
                            label: 'There is no matching record found for '+request.term,
                            value: ''
                        }
                    ];
                    console.log(res);
                    
                    if (res.length) {
                        result = $.map(res, function(obj){
                            return {
                                label: obj.item_name + ' - ' + obj.item_code,
                                value: obj.item_name + ' - ' + obj.item_code,
                                data : obj
                            };
                        });
                    }
                    cb(result);
                }
            });
        },

        select:function(e, selectedData) {
            console.log(selectedData);

            if (selectedData && selectedData.item && selectedData.item.data){
                var data = selectedData.item.data;

                $('#invoiceNum').val(data.invoiceNum);
                $('#customer_name').val(data.customer_name);
                $('#phone').val(data.phone);
                $('#price').val(data.price);
                $('#discount').val(data.discount);
                $('#total').val(data.total);
                $('#quentity').val(data.quentity);
                $('#date').val(data.created_at);
            }
        }
    });
    /*End of 'Return' from customer*/

    /*Script for Return to supplier*/
        //search by item code/model
    $('#item_code').autocomplete({
        source: function(request, cb){
            $.ajax({
                url: 'supplierReturnSearchByModel/'+request.term,
                method: 'GET',
                dataType: 'json',
                success: function(res){
                    var result;
                    result = [
                        {
                            label: 'There is no matching record found for '+request.term,
                            value: ''
                        }
                    ];
                    console.log(res);
                    
                    if (res.length) {
                        result = $.map(res, function(obj){
                            return {
                                label: obj.item_code,
                                value: obj.item_code,
                                data : obj
                            };
                        });
                    }
                    cb(result);
                }
            });
        },

        select:function(e, selectedData) {
            console.log(selectedData);

            if (selectedData && selectedData.item && selectedData.item.data){
                var data = selectedData.item.data;

                $('#product_name').val(data.item_name);
                $('#supplier_name').val(data.supplier_name);
                $('#phone').val(data.supplier_phone);
                $('#price').val(data.price);
                $('#discount').val(data.discount);
                $('#quentity').val(data.quentity);
                $('#total').val(data.total);
                $('#date').val(data.created_at);
            }
        }
    });

    //search by item name
    $('#product_name').autocomplete({
        source: function(request, cb){
            $.ajax({
                url: 'supplierReturnSearchByName/'+request.term,
                method: 'GET',
                dataType: 'json',
                success: function(res){
                    var result;
                    result = [
                        {
                            label: 'There is no matching record found for '+request.term,
                            value: ''
                        }
                    ];
                    console.log(res);
                    
                    if (res.length) {
                        result = $.map(res, function(obj){
                            return {
                                label: obj.item_name,
                                value: obj.item_name,
                                data : obj
                            };
                        });
                    }
                    cb(result);
                }
            });
        },

        select:function(e, selectedData) {
            console.log(selectedData);

            if (selectedData && selectedData.item && selectedData.item.data){
                var data = selectedData.item.data;

                $('#item_code').val(data.item_code);
                $('#supplier_name').val(data.supplier_name);
                $('#phone').val(data.supplier_phone);
                $('#price').val(data.price);
                $('#discount').val(data.discount);
                $('#quentity').val(data.quentity);
                $('#total').val(data.total);
                $('#date').val(data.created_at);
            }
        }
    });
    /*End of 'Return' from the supplier */

    
    
  });

/*Script to manage the editable input field*/
$('.chosen').chosen();

/*Delete conformation pop-up*/
$(document).on("click", "#delete", function(e) {
    e.preventDefault();
    var link = $(this).attr("href");
    bootbox.confirm("Are you want to delete permanently!", function(confirmed) {
        if(confirmed){
            window.location.href = link;
        }
    });
});





//calculate the product sale auto showing discount and total at 'add-sale' Route
function changeTotalSale(){
 var quentity = document.getElementById('quentity').value;
 var inputDue = document.getElementById('amountDue').value;
 var inputDiscount = document.getElementById('discount').value;
 var inputPrice = document.getElementById('price').value;
 var quentity = parseInt(quentity);
 var due = parseInt(inputDue);
 var discount = parseInt(inputDiscount);
 var price = parseInt(inputPrice);

 if(inputDiscount == ""){
   var total = (price * quentity) - inputDue;
   document.getElementById('total').value = total;
 }else if(inputDue == ""){
   var total = (price * quentity) - (discount * quentity);
   document.getElementById('total').value = total;
 }else{
    var total = (price * quentity) - (discount * quentity) - inputDue;
   document.getElementById('total').value = total;
 }
}

//script for other sale calculation
function totalOtherSale(){
    var inputPrice = document.getElementById('otherPrice').value;
    var inputDue = document.getElementById('amountDue').value;
    
    if(inputDue == ""){
        var price = parseInt(inputPrice);
        document.getElementById('otherTotal').value = price
    }else{
        var price = parseInt(inputPrice);
        var amountDue = parseInt(inputDue);
        document.getElementById('otherTotal').value = price - amountDue;
    }
    
}

//script for other income calculation
function totalOtherIncome(){
    var inputPrice = document.getElementById('price').value;
    var inputDue = document.getElementById('due').value;
    
    if(inputDue == ""){
        var price = parseInt(inputPrice);
        document.getElementById('total').value = price
    }else{
        var price = parseInt(inputPrice);
        var amountDue = parseInt(inputDue);
        document.getElementById('total').value = price - amountDue;
    }
    
}

//script for stationary purchase calculation
function stationary(){
    var inputQty = document.getElementById('quentity').value;
    var inputPrice = document.getElementById('price').value;
    var convartQty = parseInt(inputQty);
    var convartPrice = parseInt(inputPrice);

    document.getElementById('total').value = convartPrice * convartQty;
}

//Script for live data search
$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
          });
});
//End of live data search
