var baseURL = window.location.origin;
var filePath = "/helper/routing.php";
$.ajax({
    url : baseURL + filePath,
    method: "POST",
    data : {
        getAllInvoices : true,
    },
    dataType: 'json',
    success : function(data) {
        $(".list-group").empty();
        console.log(data);
        var id = 1;
        data.forEach(function(item) {
            var date1 = new Date();
            var date2 = new Date(item['created_at']);
            var diff = date1.getTime() - date2.getTime();
            var days = parseInt(diff / (1000 * 3600 * 24));
            if (days == 1) {
                days = "Yesterday";
            }
            else if (days == 0) {
                days = "Today";
            }
            else {
                days = days + " days ago";
            }
            const monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                                ];
            var date2date = date2.getDate();
            var date2month = monthNames[date2.getMonth()];
            var date2year = date2.getFullYear();
            var finaldate = date2date + ", " + date2month + " " + date2year;
            $(".list-group").append(
                `
                <a href="#" id="invoice_${item['id']}" class="list-group-item list-group-item-action flex-column align-items-start invoice">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Invoice # ${item['id']}</h5>
                        <small>${item['date']}</small>
                    </div>
                    <p class="mb-1">For: ${item['first_name']} ${item['last_name']}</p>
                    <p class="mb-1">On: ${finaldate}</p>
                </a>
                `
            );
            id ++;
        });
        // window.open(baseURL + "/views/pages/show-invoice.php?id=19" , "_blank");
        // <small>Donec id elit non mi porta.</small>
    }
});

$('.list-group').on('click', '.invoice', function () {
    console.log(this);
    var id = $(this).attr("id").split("_")[1];
    window.open(baseURL + "/views/pages/show-invoice.php?id=" + id , "_blank");
});