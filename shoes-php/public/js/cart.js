
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
        
function increaseItem(id){
    console.log(id);
            $.ajax({
                url: `/increase/${id}`,
                type: 'GET',
                success: function(result){
                     location.reload()
                }       
            });
}
function decreaseItem(id){
    console.log(id);
    $.ajax({
        url: `/decrease/${id}`,
        type: 'GET',
        success: function(result){
             location.reload()
        }       
    });
}

function  AddToCart (id) {
    

    // console.log(id);
    var size = $(".css-size-product.active").attr("data-size");
    console.log(size);
    $.ajax({
        url: `/cart/${id}`,
        type: 'POST',
        data: {
            size: size,
        },
        // success: function(data){
        //     console.log(data)
        //     alert('Đã thêm thành công sản phẩm' +data.selectedProductName )
        // }       
    })

}

