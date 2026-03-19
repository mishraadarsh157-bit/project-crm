if (window.location.href == "http://localhost/project/home/") {
  dashboardData();
}

function dashboardData() {
  $.ajax({
    url: "/project/homecontroller/",
    type: "POST",
    data: {
      dashboard: "dashboard",
    },
    success: function (data) {
      data = JSON.parse(data);
      data.data.forEach(function (value) {
        $("#total_users").append(value["id"]);
        $("#total_clients").append(value["client_id"]);
        $("#total_items").append(value["item_id"]);
        $("#total_invoice").append(value["InvoiceNo"]);
        $("#total_active_users").append(value["Uactive"]);
        $("#total_inactive_users").append(value["Uinactive"]);
        $("#total_active_client").append(value["Cactive"]);
        $("#total_inactive_client").append(value["Cinactive"]);
      });
    },
  });
}
