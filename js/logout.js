$(document).ready(function (){
    $('#logout').on('click',function () {
        $.ajax({
            url: '/php/logout.php',
            type: 'POST',
            data: {
                requirement: 'LOGOUT',
            },
            dataType: 'json',
            success: function (data) {
                    window.location.href='index.php?page=index';
                    //location.reload();
            },
            error: function (request, error) {
                alert("Request: " + JSON.stringify(request));
            },
            complete: function () {
                console.log("Logout erfolgreich");
            }
        });
    });
});


