function updateCart(e){
    e.preventDefault();
    let urlUpdateCart=$('.updateCartUrl').data('url');
    let id=$(this).data('id');
    let quantity=$(this).parents('tr').find('input.quantity').val();
    $.ajax({
        type:'GET',
        url:urlUpdateCart,
        data:{
            id:id,
            quantity:quantity
        },
        success:function (data){
            if(data.code === 200){
                $('.updateCartUrl').html(data.cart_update);
                alert('Cập nhật sản phẩm thành công');
            }
        },
        error:function (){

        }
    })
}

function deleteCart(e){
    e.preventDefault();
    let urlDeleteCart=$('.deleteCartUrl').data('url');
    let id=$(this).data('id');
    let that=$(this).parents('tr');

    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Bạn không thể khôi phục lại khi xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Xóa'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type:'GET',
                url:urlDeleteCart,
                data:{
                    id:id
                },
                success:function (data){
                    if(data.code == 200){
                        that.remove();
                        // Swal.fire(
                        //     'Xóa',
                        //     'Bạn đã xóa thành công',
                        //     'success'
                        // )
                    }
                },
                error:function (){

                }
            });
        }
    })
}





$(function (){
    $(document).on('click','.update_cart',updateCart);
    $(document).on('click','.delete_cart',deleteCart);
})
