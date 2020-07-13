var TableDataTables = function(){
    var handleProductTable = function(){
        var manageProductTable = $("#manage-product-datatable");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        var oTable = manageProductTable.dataTable({
            "processing": true,
            "serverSide":true,
            "ajax": {
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "page": "manage_product"
                }
            },
            "lengthMenu": [
                [5,10,20,-1],
                [5,10,20,"All"]
            ],
            "order": [
                [1,"ASC"]
            ],
            "columnDefs": [{
                'orderable': false,
                'targets': [0,-1]
            }],
        });
        
        manageProductTable.on('click','.edit',function(){
            id = $(this).attr('id');
            $("#product_id").val(id);
            $.ajax({
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "product_id": id,
                    "fetch": "product"
                },
                dataType : "json",
                success: function(data){
                    console.log(data);
                    $("#product_name").val(data[0].name);
                    $("#product_specification").val(data[0].specifications);
                    $("#product_hsn_code").val(data[0].hsn_code);
                    $("#product_category_id").val(data[0].category_id);
                    $("#product_eoq_level").val(data[0].eoq_level);
                    $("#product_danger_level").val(data[0].danger_level);
                    $("#product_quantity").val(data[0].quantity);

                }
            });
        });
        
        manageProductTable.on('click','.delete',function(){
            id = $(this).attr('id');
            $("#record_id").val(id);
            $.ajax({
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "product_id": id,
                    "fetch": "product"
                },
                dataType: "json",
                success: function(data){
                }
            });
        });
    }
    return{
        init: function(){
            handleProductTable();
        }
    }
}();
jQuery(document).ready(function(){
    TableDataTables.init();
})