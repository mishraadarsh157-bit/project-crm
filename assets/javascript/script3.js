console.log("working");

///////insert



function insertItem(){
// const form=$('#itemInsertForm')
    var fd=new FormData(itemInsertForm);
    console.log(fd)
$.ajax({
    url:'/project/itemcontroller/',
    type:'POST',
    data:fd,
    success:function(data){
        console.log(data);
    }
})
}

function itmImg(event) {
  const imgPrieview = $(".itemImage");
  const files = event.target.files;
  if (files.length > 0) {
    const file = files[0];
    const tempUrl = URL.createObjectURL(file);
    $(".itemImage").attr("src", tempUrl);
    imgPrieview.onload = function () {
      URL.revokeObjectURL(this.src);
    };
  }
}

//////////load

function loadItems() {
  var field = $(".field_i").val() ?? "item_id";
  var order = $(".order_i").val() ?? "asc";
  var searc = $(".searc_i").val() ?? "";
  var limit = $("#limit_c").val() ?? 5;
  var limit = Number(limit);
}

if (window.location.href == "http://localhost/project/itemmaster/") {
  loadItems();
}

///////////update

//////delete
