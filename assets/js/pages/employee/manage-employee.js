var TableDataTables = function(){
    var handleEmployeeTable = function(){
        var manageEmployeeTable = $("#manage-employee-datatable");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        var oTable = manageEmployeeTable.dataTable({
            "processing": true,
            "serverSide":true,
            "ajax": {
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "page": "manage_employee"
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
        
        manageEmployeeTable.on('click','.edit',function(){
            id = $(this).attr('id');
            $("#employee_id").val(id);
            $.ajax({
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "employee_id": id,
                    "fetch": "employee"
                },
                dataType : "json",
                success: function(data){
                    console.log(data);
                    $("#employee").val(data[0].name);
                }
            });
        });
        
        manageEmployeeTable.on('click','.delete',function(){
            id = $(this).attr('id');
            $("#record_id").val(id);
            $.ajax({
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "employee_id": id,
                    "fetch": "employee"
                },
                dataType: "json",
                success: function(data){
                }
            });
        });
    }
    return{
        init: function(){
            handleEmployeeTable();
        }
    }
}();
jQuery(document).ready(function(){
    TableDataTables.init();
})