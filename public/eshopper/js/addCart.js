function addToCart(e){
    e.preventDefault();
    let $urlCart=$(this).data('url');
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Thêm sản phẩm vào giỏ hàng thành công',
        showConfirmButton: false,
        timer: 1500
    })
    $.ajax({
        type:'GET',
        url:$urlCart,
        dataType:'json',
        success:function (data){
            if(data.code === 200){

            }
        },
        error:function (){
            if(data.code === 500){

            }
        }
    });
}



$(function (){
    $('.add_cart').on('click',addToCart);


})
