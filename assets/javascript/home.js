function dashboardData(){
    $.ajax({
         url:'/project/homecontroller/',
        type:"POST",
        data:{
            dashboard:'dashboard'
        },
success:function(data){
    data=JSON.parse(data)
    console.log(data.data)
    data.data.forEach(function(value){
        $('#total_users').html(value['id'])
        $('#total_clients').html(value['client_id'])
        $('#total_items').html(value['item_id'])
        $('#total_invoice').html(value['InvoiceNo'])
        $('#total_active_users').append(value['Uactive'])
        $('#total_inactive_users').append(value['Uinactive'])
        $('#total_active_client').append(value['Cactive'])
        $('#total_inactive_client').append(value['Cinactive'])
        
    })
}
    })
}

$('#logo').on('click',function(){
    dashboardData()
})

