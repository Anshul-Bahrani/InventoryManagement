var TableDataTables = function(){
    var handleSupplierTable = function(){
        var manageSupplierTable = $("#manage-supplier-datatable");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        var oTable = manageSupplierTable.dataTable({
            "processing": true,
            "serverSide":true,
            "ajax": {
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "page": "manage_supplier"
                }
            },
            "lengthMenu": [
                [2,5,10,20,-1],
                [2,5,10,20,"All"]
            ],
            "order": [
                [1,"ASC"]
            ],
            "columnDefs": [{
                'orderable': false,
                'targets': [0,-1]
            }],
        });
        
        manageSupplierTable.on('click','.edit',function(){
            id = $(this).attr('id');
            $("#supplier_id").val(id);
            $.ajax({
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "supplier_id": id,
                    "fetch": "supplier"
                },
                dataType : "json",
                success: function(data){
                    console.log(data);
                    $("#supplier_first_name").val(data[0].first_name);
                    $("#supplier_last_name").val(data[0].last_name);
                    $("#supplier_gst_no").val(data[0].gst_no);
                    $("#supplier_phone_no").val(data[0].phone_no);
                    $("#supplier_email_id").val(data[0].email_id);
                }
            });
        });
        
        manageSupplierTable.on('click','.delete',function(){
            id = $(this).attr('id');
            $("#record_id").val(id);
            $.ajax({
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "supplier_id": id,
                    "fetch": "supplier"
                },
                dataType: "json",
                success: function(data){
                }
            });
        });
    }
    return{
        init: function(){
            handleSupplierTable();
        }
    }
}();
jQuery(document).ready(function(){
    TableDataTables.init();
})