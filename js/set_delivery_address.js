$(document).ready(function (){
    $('#save').on('click',function () {
        checkIfEmpty();
    });
    $('.edit').on('click',function () {
        let address = $(this).parent('.card-body').find('.a_id').val();
        checkDeliveryAddress(address);
    });
    $('.favorit').on('click',function () {
        let val = $(this).parent('.card-body').find('.a_id').val();
        setFavorit(val);
    });
    $('.favAdr').on('click',function () {
        let val = $(this).val();
        setFavorit(val);
    });
    $('.delete').on('click',function () {
        let address = $(this).parent('.card-body').find('.a_id').val();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    deleteDeliveryAddress(address);
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

    });
    $('#saveEdit').on('click',function () {
        editDeliveryAddress();
        //window.location.href='index.php?page=index'
    });
});

function allCheck() {
    isPhoneEmpty();
    isStreetEmpty();
    isZipCodeEmpty();
    isCityEmpty();
}
function checkIfEmpty() {
    allCheck();
    if( isPhoneEmpty() && isStreetEmpty() && isZipCodeEmpty() && isCityEmpty()) {
        setDeliveryAddress();
    }
}
function isPhoneEmpty() {
    const phon = document.getElementById('phone');
    let phone = phon.value;
    if(phone === '') {
        phon.classList.add('is-invalid');
        return false;
    }
    phon.classList.remove('is-invalid');
    return true;
}
function isStreetEmpty() {
    const stre = document.getElementById('street');
    let street = stre.value;
    if( street === '') {
        stre.classList.add('is-invalid');
        return false;
    }
    stre.classList.remove('is-invalid');
    return true;
}
function isZipCodeEmpty() {
    const zip = document.getElementById('zipCode');
    let zipCode = zip.value;
    if(zipCode === '') {
        zip.classList.add('is-invalid');
        return false;
    }
    zip.classList.remove('is-invalid');
    return true;
}
function isCityEmpty() {
    const cit = document.getElementById('city');
    let city = cit.value;
    if(city === '') {
        cit.classList.add('is-invalid');
        return false;
    }
    cit.classList.remove('is-invalid');
    return true;
}
function setDeliveryAddress() {
    $.ajax({
        url: '/php/delivery_address.php',
        type: 'POST',
        data: {
            requirement: 'SETADDRESS',
            phonenbr: $('#phone').val(),
            street: $('#street').val(),
            zipCode: $('#zipCode').val(),
            city: $('#city').val()
        },
        dataType: 'json',
        success: function (data) {
            if(data['success'] === true) {
                var myParam = location.search.split('status=')[1]
                if(myParam === 'order') {
                    window.location.href='index.php?page=order_transaction';
                }
                if(myParam === 'profil') {
                    window.location.href='index.php?page=delivery_addresses';
                }
            }
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });

}
function checkDeliveryAddress(val) {
    $.ajax({
        url: '/php/delivery_address.php',
        type: 'POST',
        data: {
            requirement: 'CHECK',
            address_id: val
        },
        dataType: 'json',
        success: function (data) {
            window.location.href='index.php?page=editDeliveryAddress';
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        },
        complete: function () {
            console.log("Dieser Code-Block wird immer ausgeführt");
        }
    });
}
function setFavorit(val) {
    $.ajax({
        url: '/php/delivery_address.php',
        type: 'POST',
        data: {
            requirement: 'FAVORIT',
            adresse: val
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
function editDeliveryAddress() {
    $.ajax({
        url: '/php/delivery_address.php',
        type: 'POST',
        data: {
            requirement: 'EDIT',
            phonenr: $('#phone').val(),
            street: $('#street').val(),
            zip: $('#zipCode').val(),
            city: $('#city').val()
        },
        dataType: 'json',
        success: function (data) {
            window.location.href='index.php?page=profile';
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        },
        complete: function () {
            console.log("Dieser Code-Block wird immer ausgeführt");
        }
    });
}
function deleteDeliveryAddress(address) {
    $.ajax({
        url: '/php/delivery_address.php',
        type: 'POST',
        data: {
            requirement: 'DELETE',
            toBeDeleted: address
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
