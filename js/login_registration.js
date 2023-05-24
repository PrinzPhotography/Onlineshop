$(document).ready(function () {
    $('#login').on('click',function () {
        window.location.href = 'index.php?page=login';
    });
    $('#btn_rgn').on('click',function () {
        window.location.href = 'index.php?page=registration';
    });
    $('#btn_lgn').on('click',function () {
        window.location.href = 'index.php?page=login';
    });
    $('.home').on('click',function () {
        window.location.href='index.php?page=index'
    });

});

$(document).ready(function () {

    let position = window.location.search;
    if(position==='?page=registration') {
        document.getElementById("password").onblur = function() {isPasswordValid()};
        document.getElementById("email").onblur = function() {isEmailValid()};
    }

    $('#lgn_btn').on('click',function () {
        validatePassword();
        validateEmail();
        if(validatePassword() && validateEmail()) {
            loginWeb();
        } else {
        }
    });

    $('#rgn_btn').on('click',function () {
        wrapValidation();
        if(validatePassword() && validateEmail() && validateFirstname() && validateLastname() && isPasswordValid() && isEmailValid()) {
            registrationWeb();
        }
    });
});



function loginWeb() {

    let userdata_is_wrong = $('#userdata_is_wrong')

    $.ajax({
        url: '/php/login_registration.php',
        type: 'POST',
        data: {
            requirement: 'LOGIN',
            pw: $('#password').val(),
            email: $('#email').val()
        },
        dataType: 'json',
        success: function (data) {
            switch (data) {
                case '1':
                    window.location.href = 'index.php?page=index';
                    break;
                case '01':
                    userdata_is_wrong.hide();
                    userdata_is_wrong.show(); // Passwort ist falsch
                    break;
                case '0':
                    userdata_is_wrong.hide();
                    userdata_is_wrong.show(); // Email ist nicht vergeben
                    break;
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

function registrationWeb() {
let password_wrong = $('#password_is_wrong');
    $.ajax({
        url: '/php/login_registration.php',
        type: 'POST',
        data: {
            requirement: 'REGISTRATION',
            pw1: $('#password').val(),
            pw2: $('#conpassword').val(),
            email: $('#email').val(),
            firstname: $('#firstname').val(),
            lastname: $('#lastname').val()
        },
        dataType: 'json',
        success: function (data) {
            switch (data) {
                case '1':
                    alert('Account erfolgreich angelegt');
                    window.location.href = 'index.php?page=index';
                    break;
                case '01':
                    password_wrong.show();// Passwörter stimmen nicht überein
                    break;
                case '0':
                    password_wrong.show(); // Email bereits vergeben
                    break;
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



// Validate First- and Lastname


function validateFirstname() {
    let firstnameValue = $('#firstname').val();
    if(firstnameValue.length == '') {
        $('#usercheck1').show();
        return false;
    } else {
        $('#usercheck1').hide();
        return true;
    }
}

function validateLastname() {
    let lastnameValue = $('#lastname').val();
    if(lastnameValue.length == '') {
        $('#usercheck2').show();
        return false;
    } else {
        $('#usercheck2').hide();
        return true;
    }
}

// Validate Password

function validatePassword() {
    let passwrdValue =
        $('#password').val();
    if(passwrdValue.length == '') {
        $('#passcheck').show();
        return false;
    }
    else {
        $('#passcheck').hide();
        return true;
    }
}
// Es liegt am eventlistener, dass return value undefined ist
function isPasswordValid() {
        let pw = $('#password');
        let is_invalid = $('#is_invalid');

        let invalidCharacter = /[`~,<>;':"/[\]|{}()=+-]/;
        let regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[.!_]).{8,}$/;

        let s = pw.val();
        if(invalidCharacter.test(s) === true){

            pw.addClass('is-invalid');
            is_invalid.text('Passwort enthält ein nicht erlaubtes Sonderzeichen');
            return false;

        } else {

            if(regex.test(s)) {

                pw.removeClass('is-invalid');
                is_invalid.text('');
                return true;

            } else {
                let length = s.length;
                pw.addClass('is-invalid');
                if(length < 8) {
                    is_invalid.text('Passwort ist kürzer als 8 Zeichen');
                } else {
                    is_invalid.text('Passwort entspricht nicht den Vorgaben');
                }
                return false;

            }
        }

}


// Validate Email

function validateEmail() {

    let emailValue = $('#email').val();
    if(emailValue.length == '') {
        $('#emailcheck').show();
        return false;

    } else {

        $('#emailcheck').hide();
        return true;

    }
}

function isEmailValid() {
    const email = document.getElementById('email');
        let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        let s = email.value;
        if(regex.test(s)) {
            email.classList.remove('is-invalid');
            return true;

        } else {

            email.classList.add('is-invalid');
            return false;

        }
}

function wrapValidation() {
    validateLastname();
    validateFirstname();
    validateEmail();
    validatePassword();
}
