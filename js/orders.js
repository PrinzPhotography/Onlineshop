$(document).ready( function (){
    $('.order_change').on('click', function (){
        let orderId = $(this).val();
        changeOrderStatus(orderId);
    });

    $('.order_send').on('click', function () {
        isUserLoggedIn();
    });
    $('.zahlung_art').on('click', function () {
        let zahlung = $(this).val();
        changeZahlungsart(zahlung);
    });
    $('#send_order').on('click', function () {
        orderTransaction();
    });
});


function changeOrderStatus(order) {
    $.ajax({
        url: '/php/shopping_cart.php',
        type: 'POST',
        data: {
            requirement: 'CHANGE_ORDER_STATUS',
            ordernr: order
        },
        dataType: 'json',
        success: function (data) {
            location.reload();
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        },
        complete: function () {
            console.log("Dieser Code-Block wird immer ausgeführt");
        }
    });
}

function createOrder() {
    $.ajax({
        url: '/php/shopping_cart.php',
        type: 'POST',
        data: {
            requirement: 'CREATE_ORDER'
        },
        dataType: 'json',
        success: function (data) {
            if(data['success'] === true) {
                swal("Sie haben ihre Bestellung erfolgreich erstellt", {
                    icon: "success",
                })
                    .then(() => {
                        window.location.href="index.php?page=index";
                });

            } else {
                let feedback = '';
                data['feedback'].forEach(function (element) {
                    feedback = feedback +element['text'];
                });
                swal(feedback, {
                    icon: "warning",
                });
            }
            //location.reload();
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        },
        complete: function () {
            console.log("Dieser Code-Block wird immer ausgeführt");
        }
    });
}
function isUserLoggedIn() {
    $.ajax({
        url: '/php/delivery_address.php',
        type: 'POST',
        data: {
            requirement: 'IS_LOGGED_IN'
        },
        dataType: 'json',
        success: function (data) {
            if(data['success'] === true && data['feedback'] === false) {
                window.location.href="index.php?page=order_transaction";
            }
            if(data['success'] === true && data['feedback'] !== false) {

                data['feedback'].forEach(function (element) {
                    $('#warnings').append('<div class="alert alert-warning" role="alert">' +
                        '<span>Artikel '+element['artikel']+' hat nur noch '+element['erhaeltlich']+' auf Lager!</span>' +
                        '</div>');
                });
            }
            if(data['success'] === false) {
                swal({
                    title: "Weiter zum Login?",
                    text: "Sie sind nicht Angemeldet und können somit nicht Bestellen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((goToLogin) => {
                        if (goToLogin) {
                            window.location.href="index.php?page=login";
                        } else {
                            swal("Bestellvorgang abgebrochen!");
                        }
                    });

            }

        }
    });
}
function orderTransaction() {
    $.ajax({
        url: '/php/order_transaction.php',
        type: 'POST',
        data: {
            requirement: 'check_order_payable'
        },
        dataType: 'json',
        success: function (data) {
            if(data['success'] === true) {
                createOrder();
            }
            if(data['success'] === false) {
                if(!data['zahlungsart']) {
                    $('#liefer').append('<div class="alert alert-danger" role="alert">' +
                        '<span>Sie haben noch keine Zahlungsart ausgewählt!</span>' +
                        '</div>');
                }
                if(!data['lieferadresse']) {
                    $('#zahlung').append('<div class="alert alert-danger" role="alert">' +
                        '<span>Sie haben noch keine Lieferadresse ausgewählt!</span>' +
                        '</div>');
                }

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
function changeZahlungsart(val) {
    $.ajax({
        url: '/php/order_transaction.php',
        type: 'POST',
        data: {
            requirement: 'change_zahlung',
            zahlung: val
        },
        dataType: 'json',
        success: function (data) {
            if(data['success'] === true) {
                location.reload();
                //window.location.href="index.php?page=order_transaction";
            }
        }
    });
}