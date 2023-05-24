$(document).ready(function () {
    $("#artikel_anlegen").on('click', function (){
        let price = checkDecimal($("#preis").val());
        let lager = checkDecimal($("#lagerbestand").val());
        if(price === "invalid" && lager === "invalid") {
            swal("Sie haben in den Feldern Lagerbestand und Preis entweder zu viele Zeichen oder Nachkomma stellen verwendet!", {
                icon: "warning",
            });
        }
        if(price != "invalid" && lager === "invalid") {
            swal("Sie haben in dem Feld Lagerbestand entweder zu viele Zeichen oder Nachkomma stellen verwendet!", {
                icon: "warning",
            });
        }
        if(price === "invalid" && lager != "invalid") {
            swal("Sie haben in dem Feld Preis entweder zu viele Zeichen oder Nachkomma stellen verwendet!", {
                icon: "warning",
            });
        }
        if(price != "invalid" && lager != "invalid") {
            neuerArtikel(price, lager);
        }
    });
    $("#warengruppe_anlegen").on('click', function () {
        neueWarengruppe();
    });

});
/*function getWarengruppen() {
    $.ajax({
        url: 'php/artikel_verwalten.php',
        type: 'POST',
        data: {
            DATA:'select_warengruppen',
        },
        dataType: 'json',
        success: function (data) {
            data.forEach(function (element) {
                $('#warengruppe').append('<option value="'+element['id']+'">'+element['warengruppe']+'</option>');
            });
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
}

function getRabatt() {
    $.ajax({
        url: 'php/artikel_verwalten.php',
        type: 'POST',
        data: {
            DATA:'select_rabatt',
        },
        dataType: 'json',
        success: function (data) {
            data.forEach(function (element) {
                $('.rabatt').append('<option value="'+element['rab_id']+'">'+element['rabatt']+'</option>');
                console.log(element['rabatt']);
            });
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
}*/

function imageUpload() {
    let fd = new FormData();
    let files = $('#image')[0].files[0];
    fd.append('image',files);
    $.ajax({
        url: 'php/bilder_upload.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            if(response != 0){

            }else{
                alert('File not uploaded');
            }
        }
    })
}

function neuerArtikel(preis, lager) {
        let x = $('#image').val();
        imageUpload();
        $.ajax({
            url: 'php/neuer_artikel.php',
            type: 'POST',
            data : {
                'artikel_name' : $("#artikel_name").val(),
                'artikel_bez' : $("#artikel_bez").val(),
                'artikel_beschreibung': $("#artikel_beschreibung").val(),
                'hersteller' : $("#hersteller").val(),
                'preis' : preis,
                'lagerbestand' : lager,
                'verfuegbarkeit' : $("#verfuegbarkeit").val(),
                'warengruppe' : $("#warengruppeArt").val(),
                'image': x,
                'rabatt' : $("#rabatt_art").val()
            },
            dataType:'json',
            success : function(data) {
                if(data['success'] === true) {
                    swal("Der Artikel wurde erfolgreich erstellt!", {
                        icon: "success",
                    });
                } else {
                    swal("Sie haben nicht alle Felder beschriftet!", {
                        icon: "warning",
                    });
                }
            },
            error : function(request,error)
            {
                alert("Error");
            }
        });
        $('#new_article')[0].reset();
}
function neueWarengruppe() {
    $.ajax({
        url: 'php/neue_warengruppe.php',
        type: 'POST',
        data : {
            'warengruppe' : $("#warengruppeWg").val(),
            'mwst' : $("#mwst").val(),
            'rabatt': $("#rabatt_warengrp").val()
        },
        dataType:'json',
        success : function(data) {
            if(data['success'] === true) {
                swal("Der Artikel wurde erfolgreich erstellt!", {
                    icon: "success",
                });
            }
            if(data['success'] === false) {
                if(data['reason'] === 'empty') {
                    swal("Sie haben nicht alle Felder beschriftet!", {
                        icon: "warning",
                    });
                }
                if(data['reason'] === 'exists') {
                    swal("Die Warengruppe, die siee erstellen wollen exestiert bereits!", {
                        icon: "warning",
                    });
                }
            }
        },
        error : function(request,error)
        {
            alert("Error");
        }
    });
    $('#warengrp_anlegen')[0].reset();
}
function checkDecimal(str) {
    let validChar = /^[.,0-9]*$/gm;
    let en = /^(\d+(\.\d{1,2})?)$/g;
    let de =/^(\d+(,\d{1,2})?)$/g;
    let newN;
    let valid = validChar.test(str);
    let enReg = en.test(str);
    let deReg = de.test(str);
    if(valid) {
        if(enReg) {
            newN = str;
        }
        if(deReg) {
            newN = str.replace(',', '.');
        }
        if(!enReg && !deReg){
            str = "invalid";
        }
    }
    if(!valid) {
        str = "invalid";
    }
    return str;
}