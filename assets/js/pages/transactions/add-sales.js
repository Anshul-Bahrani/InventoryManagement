var id=2;

function deleteProduct(delete_id) {
    var elements = document.getElementsByClassName("product_row");
    if(elements.length > 1) {
        $('#finalTotal').val(parseInt($('#finalTotal').val()) - parseInt($('#total_price_' + delete_id).val()));
        $("#element_"+delete_id).remove();
    }
}

function addProduct() {
    $("#products_container").append(

        `<!-- BEGIN: PRODUCT CUSTOM CONTROL -->
        <div class="row product_row" id="element_${id}">
          <!-- BEGIN: CATEGORY SELECT -->
          <div class="col-md-2">
              <div class="form-group">
                  <label for="category_${id}">Category</label>
                  <select id="category_${id}" class="form-control category_select">
                      <option disabled selected>Select Category</option>
                  </select>
              </div>
          </div>
          <!-- END: CATEGORY SELECT -->
          <!-- BEGIN: PRODUCT SELECT -->
          <div class="col-md-3">
              <div class="form-group">
                  <label for="product_${id}">Products</label>
                  <select name="product_id[]" id="product_${id}" class="form-control product_select">
                      <option disabled selected>Select Product</option>
                  </select>
              </div>
          </div>
          <!-- END: PRODUCT SELECT -->
          <!-- BEGIN: Selling Price -->
          <div class="col-md-2">
              <div class="form-group">
                  <label for="selling_price_${id}">Selling Price</label>
                  <input type="text" id="selling_price_${id}" class="form-control" disabled>
              </div>
          </div>
          <!-- END:  Selling Price -->
          <!-- BEGIN: Quantity -->
              <div class="col-md-1">
                  <div class="form-group">
                      <label for="quantity_${id}">Quantity</label>
                      <input type="number" name="quantity[]" id="quantity_${id}" class="form-control quantity_change" value=0>
                  </div>
              </div>
          <!-- END: Quantity -->
          <!-- BEGIN: Discount -->
          <div class="col-md-1">
              <div class="form-group">
                  <label for="discount_${id}">Discount(%)</label>
                  <input type="text" name="discount[]" id="discount_${id}" class="form-control discount_change" value = 0>
              </div>
          </div>
          <!-- END: Discount -->

          <!-- BEGIN: Total Price -->
          <div class="col-md-2">
              <div class="form-group">
                  <label for="total_price_${id}">Total Price</label>
                  <input type="text" id="total_price_${id}" class="form-control" disabled value = 0>
              </div>
          </div>
          <!-- END:  Total Price -->

          <!-- BEGIN: DELETE BUTTON -->
          <div class="col-md-1">
              <button onclick="deleteProduct(${id})" type="button" class="btn btn-danger" style="margin-top: 40%;">
                  <i class="fas fa-trash-alt"></i>
              </button>
          </div>
          <!-- END:  DELETE BUTTON -->
    </div>
    <!-- BEGIN: PRODUCT CUSTOM CONTROL -->
        `

    );

   var baseURL = window.location.origin;
    var filePath = "/helper/routing.php"
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getCategories: true,
        },
        dataType: 'json',
        success : function(categories) {
            console.log(categories);
            categories.forEach(function (category) {
                // console.log(category.id);
                // console.log(id);
            $("#category_"+id).append(
                `<option value='${category.id}'>${category.name}</option>`
            );
        });
        id ++;
        }
    });
}

$("#products_container").on('change', '.category_select', function () {
    var element_id = $(this).attr('id').split("_")[1];
    var category_id = this.value;
    // console.log(element_id, category_id);
    var baseURL = window.location.origin;
    var filePath = "/helper/routing.php"
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getProductsByCategoryID: true,
            categoryID : category_id
        },
        dataType: 'json',
        success : function(products) {
            console.log(products);
            $("#product_"+element_id).empty();
            $("#product_"+element_id).append(
                "<option disabled selected>Select Product</option>"
            );
            products.forEach(function (product) {
                // console.log(category.id);
                // console.log(id);
            $("#product_"+element_id).append(
                `<option value='${product.id}'>${product.name}</option>`
            );
        });
        }
    });
});

$("#products_container").on('change', '.product_select', function () {
    console.log(this);
    var element_id = $(this).attr('id').split('_')[1];
    console.log(element_id);
    var product_id = this.value;
    var baseURL = window.location.origin;
    var filePath = "/helper/routing.php";
    $.ajax({
        url: baseURL+filePath,
        method: "POST",
        data: {
            getProductSellingRateByID : true,
            productID : product_id,
        },
        dataType: 'json',
        success: function(product_selling_rate) {
            console.log(product_selling_rate);
            console.log($("#selling_price_"+ element_id));
            $("#selling_price_" + element_id).val(product_selling_rate);
            $('#quantity_' + element_id).val(1);
            $("#total_price_" + element_id).val(product_selling_rate);
            $('#finalTotal').val(parseInt($('#finalTotal').val()) + parseInt(product_selling_rate));
        }
    });
    // console.log(product_id);
});

$("#products_container").on('change', '.quantity_change', function () {
    // console.log($(this).val());
    var elem_id = $(this).attr('id').split('_')[1];
    var old_total = $("#total_price_" + elem_id).val();
    // console.log(parseInt(old_total));
    // console.log($('#selling_price_' + elem_id).val());
    var temp = ($('#selling_price_' + elem_id).val())*($(this).val());
    // console.log(parseInt(temp));
    var new_total = temp - temp*$('#discount_' + elem_id).val()/100;
    // console.log(new_price);
    $("#total_price_" + elem_id).val(new_total);
    $('#finalTotal').val(parseInt($('#finalTotal').val()) - parseInt(old_total) + parseInt(new_total));
});

$("#products_container").on('change', '.discount_change', function () {
    // console.log($(this).val());
    var elem_id = $(this).attr('id').split('_')[1];
    var old_total = $("#total_price_" + elem_id).val();
    // console.log(parseInt(old_total));
    // console.log($('#selling_price_' + elem_id).val());
    var temp = ($('#selling_price_' + elem_id).val())*($('#quantity_' + elem_id).val());
    // console.log(parseInt(temp));
    var new_total = temp - temp*$(this).val()/100;
    // console.log(new_price);
    $("#total_price_" + elem_id).val(new_total);
    $('#finalTotal').val(parseInt($('#finalTotal').val()) - parseInt(old_total) + parseInt(new_total));
});

function checkEmail() {
    // console.log("Hi");
    // $("#check_email").css({"display": "none"});
    var email = $('#customer_email').val();
    if(email == "") {
        console.log("empty");
    }
    // console.log(email);
    var baseURL = window.location.origin;
    var filePath = "/helper/routing.php";
    $.ajax({
        url : baseURL + filePath,
        method: "POST",
        data : {
            customer_email : email,
        },
        dataType: 'json',
        success : function(verified) {
            // if (verified == 1) {
            //     console.log("verified");
            // }
            // else {
            //     console.log("Not Verified");
            // }
            console.log(verified);
            if(verified != false) {
                // $("#")
                var id = verified[0]['id'];
                console.log("hi");
                // $("#check_email").css("display", "none");
                // $("#check_email_success").css("display", "block");
                $('#customer_id').val(id);
                $('#customer_email').prop('disabled', true);
            }
            else {
                console.log("Not Verified");
            }
        }
    });
};

// Payment Things

$("#payment_method").on('change', function() {
    var value = $("#payment_method").val();
    console.log(value);
        $(".cheque_details").empty();
        if(value == 1) {
            $(".cheque_details").append(
                `
                <div class="col-md-3">
                    <label for="cheque_no">Cheque Number</label>
                    <input name="cheque_no" id="cheque_no" type="number" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="cheque_name">Cheque Name</label>
                    <input name="cheque_date" id="cheque_date" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="bank_name">Bank Name</label>
                    <input name="bank_name" id="bank_name" type="text" class="form-control">
                </div>
                <div class="col-md-1 lock_unlock">
                <input id="for_lock" type="hidden" value="1">
                    <button onclick="disable()" type="button" class="btn btn-primary" style="margin-top: 40%;">
                        <i class="fas fa-unlock" id="for_toggle"></i>
                    </button>
                </div>
            `
            );
    }
});

function disable() {
    var value = $('#for_lock').val();
    console.log(value);
    if (value == 1) {
        $("#cheque_no, #cheque_date, #bank_name").prop('readonly', true);
        $('#for_lock').val(0);
    }
    else {
        $("#cheque_no, #cheque_date, #bank_name").prop('readonly', false);
        $('#for_lock').val(1);
    }
    $("#for_toggle").toggleClass("fa-unlock");
    $('#for_toggle').toggleClass("fa-lock");
};