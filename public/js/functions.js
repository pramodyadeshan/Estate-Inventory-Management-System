
function suggetion() {

     $('#sug_input').keyup(function(e) {

         var formData = {
             'product_name' : $('input[name=title]').val()
         };

         if(formData['product_name'].length >= 1){

           // process the form
           $.ajax({
               type        : 'POST',
               url         : 'ajax.php',
               data        : formData,
               dataType    : 'json',
               encode      : true
           })
               .done(function(data) {
                   //console.log(data);
                   $('#result').html(data).fadeIn();
                   $('#result li').click(function() {

                     $('#sug_input').val($(this).text());
                     $('#result').fadeOut(500);

                   });

                   $("#sug_input").blur(function(){
                     $("#result").fadeOut(500);
                   });

               });

         } else {

           $("#result").hide();

         };

         e.preventDefault();
     });

 }
  $('#sug-form').submit(function(e) {
      var formData = {
          'p_name' : $('input[name=title]').val()
      };
        // process the form
        $.ajax({
            type        : 'POST',
            url         : 'ajax.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        })
            .done(function(data) {
                //console.log(data);
                $('#product_info').html(data).show();
                total();
                $('.datePicker').datepicker('update', new Date());

            }).fail(function() {
                $('#product_info').html(data).show();
            });
      e.preventDefault();
  });
  function total(){
    $('#product_info input').change(function(e)  {
            var price = +$('input[name=price]').val() || 0;
            var qty   = +$('input[name=quantity]').val() || 0;
            var total = qty * price ;
                $('input[name=total]').val(total.toFixed(2));
    });
  }

  $(document).ready(function() {

    //tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $('.submenu-toggle').click(function () {
       $(this).parent().children('ul.submenu').toggle(200);
    });
    //suggetion for finding product names
    suggetion();
    // Callculate total ammont
    total();

    $('.datepicker')
        .datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true
        });
  });

  setTimeout(function () {
    $(".alert-msg,.login-alert, #stock_save_msg").fadeOut("slow");
}, 5000);

Dropzone.options.dropzone =
    {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 5000,
        success: function(file, response) {
            console.log(response);
        },
        error: function(file, response){
            return false;
        }
    };
$(document).ready(function() {

    $('#new_password, #re_new_password').on('input', function() {

        var newPassword = $('#new_password').val();
        var reNewPassword = $('#re_new_password').val();

        var passwordMatchMessageDiv = $('#password_match_message');

        if(newPassword != '' && reNewPassword != '')
        {
            if (newPassword === reNewPassword) {
                // Display a success message
                passwordMatchMessageDiv.html('<i class="glyphicon glyphicon-ok"></i> Passwords match').removeClass('text-danger').addClass('text-success');
            } else {
                // Display an error message
                passwordMatchMessageDiv.html('<i class="glyphicon glyphicon-remove"></i> Passwords do not match').removeClass('text-success').addClass('text-danger');
            }
        }else
        {
            passwordMatchMessageDiv.html('').removeClass('text-success').addClass('text-danger');
            passwordMatchMessageDiv.html('').removeClass('text-danger').addClass('text-success');
        }
    });
});

function changeFormImage(imageFileName,public_path)
{
    document.getElementById('selectedImage').src = public_path + '/' + imageFileName;
}

$(document).ready(function () {
    initializeStockForm();
});

function initializeStockForm() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');


    $('#division, #division_update').on('click change', function () {
        var selectedValue = $(this).val();

        $.ajax({
            url: "/get-stock-division",
            method: 'POST',
            data: { selectedValue: selectedValue, _token: csrfToken },
            success: function (response) {

                updateProductDropdown(response.data);
                $('#qty').val('1');
                $('#qty_update').val('1');
                $('#total_price').val('0.00');
                $('#total_price_update').val('0.00');
                calculateTotal();
                calculateUpdateTotal();
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('#product_dropdown,#product_update').on('click change', function () {
        var productID = $(this).val();

        $.ajax({
            url: "/get-product-price/" + productID,
            method: 'GET',
            data: { productID: productID, _token: csrfToken },
            success: function (response) {
                if (response.qty <= 10) {
                    $('#low_stock_msg').html("<label class='text-danger'><i class='glyphicon glyphicon-warning-sign'></i> Limited stock of only " + response.qty + " left, Please restock now before supplies last!</label>");
                }

                $('#product_price').val(response.price.toFixed(2));
                $('#product_price_update').val(response.price.toFixed(2));
                calculateTotal();
                calculateUpdateTotal();
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
}

function updateProductDropdown(products) {
    var productDropdown = $('#product_dropdown,#product_update');
    productDropdown.empty();

    if (products.length > 0) {
        $.each(products, function (index, product) {
            productDropdown.append('<option value="' + product.id + '">' + product.name + '</option>');
        });
    } else {
        productDropdown.append('<option value="">Not Available</option>');
    }
}

function calculateTotal() {
    var price = parseFloat($('#product_price').val());
    var qty = parseFloat($('#qty').val());
    var total_price = price * qty;
    $('#total_price').val(total_price.toFixed(2));

    $('#issue_stock_btn').prop('disabled', false);
}
function calculateUpdateTotal() {
    var price = parseFloat($('#product_price_update').val());
    var qty = parseFloat($('#qty_update').val());
    var total_price = price * qty;
    $('#total_price_update').val(total_price.toFixed(2));
}

function display_ct5() {
    var x = new Date();
    var ampm = x.getHours() >= 12 ? ' PM' : ' AM';

    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var formattedDate = x.getFullYear() + '-' + padZero(x.getMonth() + 1) + '-' + padZero(x.getDate());
    formattedDate += ' , ' + padZero(x.getHours()) + ':' + padZero(x.getMinutes()) + ':' + padZero(x.getSeconds()) + ampm;

    document.getElementById('ct5').innerHTML = formattedDate;
    display_c5();
}
function padZero(value) {
    return value < 10 ? '0' + value : value;
}
function display_c5() {
    var refresh = 1000; // Refresh rate in milliseconds
    mytime = setTimeout('display_ct5()', refresh);
}

display_c5();

$(".js-example-tags").select2({
    tags: true
});
