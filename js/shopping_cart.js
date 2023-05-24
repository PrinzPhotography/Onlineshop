$(document).ready(function (){

    $('.quantity_shopping_cart').on('click',function () {
        let artikel = $(this).val();
        let quantity = $(this).parent('#menge_warenkorb').find('#quantity').val();
        putProductInCart(artikel, quantity);
    });

    $('select.select').on('change',function() {
        $(this).parents().eq(3).find('.update').show();
        if ($(this).val() === '10+')
            $('.select').replaceWith('<input style="width:20%" type="number" class="menge" id="quantity_cart">');
    });

    $('.update').on('click', function (){
        let id = $(this).val();
        let quantity = $(this).parent().find('#quantity_cart').val();
        updateCart(id, quantity);
        $('.update').hide();
    });

    $('.shopping_cart').on('click',function () {
        let artikel = $(this).val();
        //console.log(test)
        putProductInCart(artikel);
    });

    $('.delete_artikel').on('click',function () {
        let test = $(this).parent('.artikel_spalte').find('.art_nr').val();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    deleteCartItem(test);
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

    });

    $('select.selec').on('change',function() {
        if ($(this).val() == '10+')
            $('.selec').replaceWith('<input type="number" class="menge" id="quantity">');
    });


});



function putProductInCart(art, quant = 1) {
    $.ajax({
        url: '/php/shopping_cart.php',
        type: 'POST',
        data: {
            requirement: 'CART',
            articlenr: art,
            quantity: quant
        },
        dataType: 'json',
        success: function (data) {
            if(data === '1'){
                location.reload();
            } else {
                location.reload();
            }
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        },
        complete: function () {
            console.log("Dieser Code-Block wird immer ausgeführt");
        }
    });
}
function updateCart(art, quant = 1) {
    $.ajax({
        url: '/php/shopping_cart.php',
        type: 'POST',
        data: {
            requirement: 'UPDATE',
            articlenr: art,
            quantity: quant
        },
        dataType: 'json',
        success: function (data) {
            if(data === '1'){
                location.reload();
            } else {
                location.reload();
            }
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        },
        complete: function () {
            console.log("Dieser Code-Block wird immer ausgeführt");
        }
    });
}
function deleteCartItem(art) {
    $.ajax({
        url: '/php/shopping_cart.php',
        type: 'POST',
        data: {
            requirement: 'DELETECART',
            article_nr: art
        },
        dataType: 'json',
        success: function (data) {
            if(data !== '0'){
                location.reload();
            } else {
                location.reload();
            }
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        },
        complete: function () {
            console.log("Dieser Code-Block wird immer ausgeführt");
        }
    });
}