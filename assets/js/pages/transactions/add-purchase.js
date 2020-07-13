var baseURL = window.location.origin;
var filePath = "/helper/Routing.php";
  
var id=2;
// manageCustomerTable.on('click','.edit',function(){
//     id = $(this).attr('id');
//     $("#customer_id").val(id);
//     $.ajax({
//         url: baseURL + filePath,
//         method: "POST",
//         data: {
//             "customer_id": id,
//             "fetch": "customer"
//         },
//         dataType : "json",
//         success: function(data){
//             console.log(data);
//             $("#customer_first_name").val(data[0].first_name);
//             $("#customer_last_name").val(data[0].last_name);
//             $("#customer_gst_no").val(data[0].gst_no);
//             $("#customer_phone_no").val(data[0].phone_no);
//             $("#customer_email_id").val(data[0].email_id);
//         }
//     });
// });



function deleteProduct(delete_id) {
    var elements = document.getElementsByClassName("product_row");
    if(elements.length > 1) {
      var final_price = document.getElementById("final_rate_"+delete_id).value;
    var final_total = document.getElementById("finalTotal").value;
    console.log(final_price, final_total);
    document.getElementById("finalTotal").value = final_total-final_price;
        $("#element_"+delete_id).remove();
    }
}

function editSellingPrice(edit_id){
    var product_id = document.getElementById("product_"+edit_id).value;
    document.getElementById('product_id').value=product_id;
    document.getElementById('element_id').value=edit_id;
    console.log(product_id);
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            fetch: 'product',
            product_id: product_id
        },
        dataType: 'json',
        success: function(product){
            console.log(product);
            var sp = document.getElementById("selling_price_"+edit_id).value;
            document.getElementById("prod_name").value = product[0].name;
            document.getElementById("prod_name").disabled=true;
            document.getElementById("new_sp").value = sp;
        }
    });
    }


function addNewSellingPrice(){
    product_id=document.getElementById('product_id').value;
    new_sp = document.getElementById('new_sp').value;
    element_id = document.getElementById("element_id").value;
    console.log(product_id, new_sp, element_id);
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            editSellingPrice: true,
            product_id: product_id,
            new_sp: new_sp
        },
        dataType: 'json',
        success: function(status){
            console.log(status);
                $.ajax({
                    url: baseURL+filePath,
                    method: 'POST',
                    data: {
                        getSellingPrice: true,
                        productID: product_id
                    },
                    dataType: 'json',
                    success: function(sellingprice){
                        console.log("inner ajax!"+sellingprice);
                        document.getElementById("selling_price_"+element_id).value=sellingprice;
                        document.getElementById("close").click();
                        
                    }
            
                })
   
            
        }
    });
}
function addProduct() {
    $("#products_container").append(

        `   
        <div class="product_row" id="element_${id}">
        <hr/>
        <div class="row ">
            <!--Begin supplier select-->
          <div class="col-md-4">
            <div class="form-group">
              <label for="supplier_${id}">Supplier</label>
              <select id="supplier_${id}" name="supplier_id[]" class="form-control suppliers_select">
              <option disabled selected>Supplier</option>
              </select>
            </div>
          </div>
          <!--End supplier select-->
          <!-- Begin category select-->
          <div class="col-md-4">
            <div class="form-group">
              <label for="category_${id}">Category</label>
              <select id="category_${id}" class="form-control category_select"
              name="category_id[]"
              >
              <option disabled selected>Category</option>
              </select>
            </div>
          </div> 
          <!--End category select -->
          <!--Begin product -->
          <div class="col-md-4">
              <div class="form-group">
                  <label for="">Products</label>
                  <select name="product_id[]" id="product_${id}" class="form-control product_select">
                      <option disabled selected>Select Product</option>
                  </select>
              </div>
          </div>
          <!--End product -->
            </div>
        <div class="row">
          <!--Begin edit sp button-->
          <div class="col-md-1">
          <div class="form-group">
          <label for="">Edit SP</label>
              <button onclick="editSellingPrice(${id})"
              type="button"
              class="btn btn-primary form-control"
              data-toggle="modal" data-target="#editModal"
              >
              <i class="fa fa-pencil-alt"></i>
              </button>                          
          </div>
          </div>
          <!--End edit sp button-->
              <!--Begin selling price -->
          <div class="col-md-3">
              <div class="form-group">
                  <label for="">S.P</label>
                  <input type="text" name="selling_price[]" id="selling_price_${id}"
                  class="form-control"
                  disabled
                  >
              </div>
          </div>
          <!--End selling price-->
          <!--Begin purchase rate -->
          <div class="col-md-3">
              <div class="form-group">
                  <label for="">C.P</label>
                  <input type="text" name="purchase_rate[]" id="purchase_rate_${id}"
                  class="form-control"
                  >
              </div>
          </div>
          <!--End purchase rate-->
          <!--Begin quantity -->
          <div class="col-md-2">
              <div class="form-group">
                  <label for="">Quantity</label>
                  <input type="number" value=0 name="quantity[]" id="quantity_${id}"
                  class="form-control quantity_ip"
                  placeholder="Enter Quantity">                              
              </div>
          </div>
          <!--End quantity -->
          <!-- Begin discount -->
          <!-- <div class="col-md-1">
              <div class="form-group">
                  <label for="">Discount</label>
                  <input type="number" value = 0 name="discount[]" id="discount_${id}" class="form-control discount_ip" 
                  placeholder="Enter Disount">
              </div>
          </div> -->
          <!--End discount -->
          
          <!--Begin final rate -->
          <div class="col-md-2">
              <div class="form-group">
                  <label for="">Final</label>
                  <input type="text" name="final_rate[]" id="final_rate_${id}"
                  class="form-control"
                  disabled
                  value="0"
                  >
              </div>
          </div>
          <!--End final price-->
          <!--Begin delete button-->
          <div class="col-md-1">
            <div class="form-group">
                <label for="">Delete</label>
                    <button onclick="deleteProduct(${id})"
                    type="button"
                    class="btn btn-danger form-control"
                    >
                    <i class="far fa-trash-alt"></i>
                    </button>                          
            </div>
          </div>
          <!--End delete button-->
          
        </div>
        
    </div> 
    `
);
$.ajax({
    url: baseURL+filePath,
    method: 'POST',
    data: {
        getSuppliers: true
    },
    dataType: 'json',
    success: function(suppliers){
        suppliers.forEach(function(supplier){
            $("#supplier_"+id).append(
                `<option value='${supplier.id}'>${supplier.first_name} ${supplier.last_name}</option>`
            );
        });
        id++;
    }
});
}





$('#products_container').on('change', '.suppliers_select', function(){
    console.log("HI");
    var element_id = $(this).attr('id').split("_")[1];
    var supplier_id = this.value;
    //console.log(element_id, supplier_id);
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getCategoriesBySupplierId: true,
            supplierId: supplier_id
        },
        dataType: 'json',
        success:function(categories){
            //console.log("HI");
            console.log(categories);
            $("#category_"+element_id).empty();
            $("#category_"+element_id).append(
                `<option value="">Select Category</option>`
            );
            categories.forEach(function(category){
                
                $("#category_"+element_id).append(
                    `<option value='${category.id}'>${category.name}</option>`
                );
            });
        }
    });

});


$('#products_container').on('change', '.category_select', function(){
    var element_id = $(this).attr('id').split("_")[1];
    //console.log("HI");
    var supplier_id = $('#supplier_'+element_id).children("option:selected").val();
    var category_id = this.value;
    console.log(element_id, category_id, supplier_id);
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getProductsByCategoryIDandSupplierID: true,
            categoryId: category_id, 
            supplierId: supplier_id
        },
        dataType: 'json',
        success:function(products){
            $("#product_"+element_id).empty();
            $("#product_"+element_id).append(
                `<option value="">Select product</option>`
            );
            products.forEach(function(product){
                
                $("#product_"+element_id).append(
                    `<option value='${product.id}'>${product.name}</option>`
                );
            });
        },
        error:function(e){
            console.log(e);
            console.log(e.status+e.statusText);
        }
    });

});

$('#products_container').on('change', '.product_select',function(){
    var element_id = $(this).attr('id').split("_")[1];
    var product_id = this.value;
    console.log(element_id, product_id);
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getSellingPrice: true,
            productID: product_id
        },
        dataType: 'json',
        success: function(sellingprice){
            document.getElementById("selling_price_"+element_id).value=sellingprice;
        }

    })
});

$('#products_container').on('change','.quantity_ip', function(){
    var element_id = $(this).attr('id').split("_")[1];
    if($(this).val()=="" || parseInt($(this).val()) <=0){
      console.log("HI");
      $(this).addClass("text-field-error");
      return;
    }
    $(this).removeClass("text-field-error");
    //console.log(element_id, product_id);
    var pr=document.getElementById('purchase_rate_'+element_id).value;
    var q=document.getElementById('quantity_'+element_id).value;
    var total=document.getElementById('finalTotal').value;
    console.log(total);
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getFinalRate: true,
            sp: pr,
            q: q
        },
        dataType: 'json',
        success: function(ans){
            document.getElementById('final_rate_'+element_id).value = ans;
            var final_rate_arr=document.getElementsByName('final_rate[]');
            var total=0;
            for(var i=0;i<final_rate_arr.length;i++){
                if(parseInt(final_rate_arr[i].value))
                    total += parseInt(final_rate_arr[i].value);
            }
            document.getElementById('finalTotal').value=total; 
        }
    })
});


// $('#products_container').on('change', '.product_select',function(){
//     var element_id = $(this).attr('id').split("_")[1];
//     var product_id = this.value;
//     console.log(element_id, product_id);
//     $.ajax({
//         url: baseURL+filePath,
//         method: 'POST',
//         data: {
//             getSellingPrice: true,
//             productID: product_id
//         },
//         dataType: 'json',
//         success: function(sellingprice){
//             document.getElementById("selling_price_"+element_id).value=sellingprice;
//         }

//     })
// });

// $('#products_container').on('change','.quantity_ip', function(){
//     var element_id = $(this).attr('id').split("_")[1];
//     if($(this).val()=="" || parseInt($(this).val()) <=0){
//       console.log("HI");
//       $(this).addClass("text-field-error");
//       return;
//     }
//     $(this).removeClass("text-field-error");
//     //console.log(element_id, product_id);
//     var sp=document.getElementById('selling_price_'+element_id).value;
//     var q=document.getElementById('quantity_'+element_id).value;
//     var total=document.getElementById('finalTotal').value;
//     console.log(total);
//     $.ajax({
//         url: baseURL+filePath,
//         method: 'POST',
//         data: {
//             getFinalRate: true,
//             sp: sp,
//             q: q
//         },
//         dataType: 'json',
//         success: function(ans){
//             document.getElementById('final_rate_'+element_id).value = ans;
//             var final_rate_arr=document.getElementsByName('final_rate[]');
//             var total=0;
//             for(var i=0;i<final_rate_arr.length;i++){
//                 if(parseInt(final_rate_arr[i].value))
//                     total += parseInt(final_rate_arr[i].value);
//             }
//             document.getElementById('finalTotal').value=total; 
//         }
//     })
// });

// $('#products_container').on('change','.discount_ip',function(){
//     var element_id = $(this).attr('id').split("_")[1];
//     //console.log(element_id, product_id);
//     if($(this).val()=="" || parseInt($(this).val()) <=0){
//       console.log("HI");
//       $(this).addClass("text-field-error");
//       return;
//     }
//     $(this).removeClass("text-field-error");
    
//     var sp=document.getElementById('selling_price_'+element_id).value;
//     var q=document.getElementById('quantity_'+element_id).value;
//     var total=document.getElementById('finalTotal').value;

//     fr=sp*q;
//     var disc=document.getElementById('discount_'+element_id).value;
//     //console.log(fr,disc);
//     $.ajax({
//         url: baseURL+filePath,
//         method: 'POST',
//         data: {
//             getDiscountedFinalRate: true,
//             fr: fr,
//             disc: disc
//         },
//         dataType: 'json',
//         success: function(ans){
//             document.getElementById('final_rate_'+element_id).value = ans;
//             var final_rate_arr=document.getElementsByName('final_rate[]');
//             var total=0;
//             for(var i=0;i<final_rate_arr.length;i++){
//                 if(parseInt(final_rate_arr[i].value))
//                     total += parseInt(final_rate_arr[i].value);
//             }
//             document.getElementById('finalTotal').value=total;
//         }
//     })
// });