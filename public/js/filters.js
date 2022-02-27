function categoryFilter(cat_id = 0, cat_name = null) {
    var id = cat_id;
    $.ajax({
        type: "get",
        url: base_path+'/product_category_filter',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            "category_id": id,
        },
        success: function (result) {
            alert('succss');
        }
    });
}
function sizeFilter(e){
    var id = e.id;
    console.log($('#'+id).parents('li'))
    console.log($('#'+id).parents('li').hasClass('active'))
    if($('#'+id).parents('li').hasClass('active')){
        alert('checked');
    }else{
        alert('not checked');
    }

    alert('her');
}
