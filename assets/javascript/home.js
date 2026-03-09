
function totalUsers(){
    $.ajax({
        url:'/project/homecontroller/',
        type:"POST",
        data:{
            id:"id",
            table:"users"
        },
        success: function(data){
            $("#total_users").html(data);
        }
    })
}
totalUsers()


function totalClients(){
    $.ajax({
        url:'/project/homecontroller/',
        type:"POST",
        data:{
            id:"client_id",
            table:"client"
        },
        success: function(data){
            $("#total_clients").html(data);
        }
    })
}
totalClients()



function totalItems(){
    $.ajax({
        url:'/project/homecontroller/',
        type:"POST",
        data:{
            id:"item_id",
            table:"items"
        },
        success: function(data){
            $("#total_items").html(data);
        }
    })
}
totalItems()

function totalinActiveUsers(){
    $.ajax({
        url:'/project/homecontroller/',
        type:"POST",
        data:{
            id:"id",
            status:'STATUS!',
            value:1,
            tabl:"users"
        },
        success: function(data){
            $("#total_inactive_users").html("Inactive " + data);
        }
    })
}
totalinActiveUsers()
function totalActiveUsers(){
    $.ajax({
        url:'/project/homecontroller/',
        type:"POST",
        data:{
            id:"id",
            status:'STATUS',
            value:1,
            tabl:"users"
        },
        success: function(data){
            $("#total_active_users").html("Active " + data);
        }
    })
}
totalActiveUsers()
function totalinActiveClients(){
    $.ajax({
        url:'/project/homecontroller/',
        type:"POST",
        data:{
            id:"client_id",
            status:'client_status!',
            value:1,
            tabl:"client"
        },
        success: function(data){
            $("#total_inactive_client").html("Inactive " + data);
        }
    })
}
totalinActiveClients()
function totalinActiveClinets(){
    $.ajax({
        url:'/project/homecontroller/',
        type:"POST",
        data:{
            id:"client_id",
            status:'client_status',
            value:1,
            tabl:"client"
        },
        success: function(data){
            $("#total_active_client").html("Active " + data);
        }
    })
}
totalinActiveClinets()