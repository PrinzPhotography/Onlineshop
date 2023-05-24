$(document).ready(function () {
    //artikelSuchenedit();
    $('#artikel_speichern').on('click',function () {
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
            artikelSpeichern(price, lager);
        }
    });
});
/*

function alleArtikel() {
    $.ajax({
        url: 'php/artikel_verwalten.php',
        type: 'POST',
        data : {
            DATA:'artikelliste',
        },
        dataType:'json',
        success : function(data) {
            data.forEach(function (element) {
                $('#artikelliste').append('<div class="all_articles col-sm-2">\n' +
                    '            <div class="article col-md-2">\n' +
                    '                <div class="article_image">\n' +
                    '                    <img src="../img/'+element['produktbild']+'" class="produktbilder">' +
                    '                </div>\n' +
                    '                <div class="details_artikel">\n' +
                    '                    <ul>' +
                    '                        <li><b>Art.-Nr.:</b> ' +'<i>'+ element['artikelnr']+'</i>'+'</li>' +
                    '                        <li><b>Art.-Name:</b> ' + element['artikelname']+'</li>' +
                    '                        <li><b>Art.-Bez.:</b> ' + element['artikelbez']+'</li>' +
                    '                        <li><b>Hersteller:</b> ' + element['hersteller']+'</li>' +
                    '                        <li><b>Warengruppe:</b> ' + element['warengruppe']+'</li>' +
                    '                        <li><b>Preis:</b> ' + element['preis']+'€'+'</li>' +
                    '                        <li><b>Lagerbestand:</b> ' + element['lagerbestand']+' Stk'+'</li>' +
                    '                        <li><b>Verfügbar:</b> ' + element['verfuegbarkeit']+'</li>' +
                    '                    </ul>' +
                    '                </div>' +
                    '                <button class="btn_article_mainsite btn btn-primary" id="btn_artikel_bearbeiten">Artikel bearbeiten</button>' +
                    '            </div>' +
                    '        </div>');
            });
            Artikelbearbeiten();
        },
        error : function(request,error)
        {
            alert("Fehler");
        }
    });
}
*/
/*let art_nr = "";
function Artikelbearbeiten() {
    $('.btn_artikel_bearbeiten').on('click',function () {
        art_nr = $(this).find('i').text();
        console.log(art_nr);
        $('#artikelliste').html("");
        $('#suche_artikel').html("");
        $.ajax({
            url: 'php/artikel_verwalten.php',
            type: 'POST',
            data : {
                DATA:'artikeldetails_bearbeiten',
                'art_nr':art_nr,
            },
            dataType:'json',
            success : function(data, element) {
                $('#artikelliste').append('<div class="card" id="card_bearbeiten">\n' +
                    '    <h5 class="card-header">Artikel bearbeiten</h5>\n' +
                    '    <div class="card-body">\n' +
                    '        <form action="../php/artikel_verwalten.php" method="post" id="artikel_bearbeiten">\n' +
                    '            <label for="artikel_nr" class="label_artikel_verwalten">Art.-Nr.:</label>\n' +
                    '            <div class="form-group">\n' +
                    '                <input class="form-control" type="text" name="artikel_nr" id="artikel_nr"\n' +
                    '                       required readonly>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label for="artikel_name" class="label_artikel_verwalten">Artikel Name:</label>\n' +
                    '            <div class="form-group">\n' +
                    '                <input class="form-control" type="text" name="artikel_name" id="artikel_name"\n' +
                    '                       required>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label for="artikel_bez" class="label_artikel_verwalten">Art.-Bezeichnung:</label>\n' +
                    '            <div class="form-group">\n' +
                    '        <textarea class="form-control" type="text" name="artikel_bez" id="artikel_bez"\n' +
                    '                  required></textarea>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label for="artikelbeschreibung" class="label_artikel_verwalten">Art.-Beschreibung:</label>\n' +
                    '            <div class="form-group">\n' +
                    '        <textarea class="form-control" type="text" name="artikelbeschreibung" id="artikelbeschreibung"\n' +
                    '                  required></textarea>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label for="hersteller" class="label_artikel_verwalten">Hersteller:</label>\n' +
                    '            <div class="form-group">\n' +
                    '                <input class="form-control" type="text" name="hersteller" id="hersteller"\n' +
                    '                       required>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label for="preis" class="label_artikel_verwalten">Preis €:</label>\n' +
                    '            <div class="form-group">\n' +
                    '                <input class="form-control" type="number" step="any" name="preis" id="preis"\n' +
                    '                       required>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label for="rabatt" class="label_artikel_verwalten">Rabatt %:</label>\n' +
                    '            <div class="form-group">\n' +
                    '                <select class="form-control rabatt" type="number" name="rabatt" id="rabatt"\n' +
                    '                       required>' +
                    '                </select>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label for="lagerbestand" class="label_artikel_verwalten">Lagerbestand:</label>\n' +
                    '            <div class="form-group">\n' +
                    '                <input class="form-control" type="number" name="lagerbestand" id="lagerbestand"\n' +
                    '                       required>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label for="warengruppe" class="label_artikel_verwalten">Warengruppe:</label>\n' +
                    '            <div class="form-group">\n' +
                    '                <select class="form-control" name="warengruppe" id="warengruppe" required>\n' +
                    '                </select>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label For="image" class="label_artikel_verwalten">Produktfoto:</label>\n' +
                    '            <div class="form-group">\n' +
                    '                <input class="form-control" type="file" name="image" id="image">\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <label for="verfuegbarkeit" class="label_artikel_verwalten">Verfügbarkeit:</label>\n' +
                    '            <div class="form-group">\n' +
                    '                <select class="form-control" name="verfuegbarkeit" id="verfuegbarkeit" required>\n' +
                    '                    <option>Auf Lager</option>\n' +
                    '                    <option>Bald wieder lieferbar</option>\n' +
                    '                    <option>Zurzeit nicht im Angebot</option>\n' +
                    '                </select>\n' +
                    '            </div>\n' +
                    '\n' +
                    '            <input class="btn btn-primary" id="artikel_speichern" type="button" value="Artikel speichern">\n' +
                    '            <input class="btn btn-secondary" id="zurück" type="button" value="Zurück"\n' +
                    '                   onclick="window.location.href=\'index.php?page=artikel_verwalten\'">\n' +
                    '\n' +
                    '        </form>\n' +
                    '    </div>\n' +
                    '</div>'
                );
                $('#artikel_nr').val(data['artikelnr']);
                $('#artikel_name').val(data['artikelname']);
                $('#artikel_bez').val(data['artikelbez']);
                $('#artikelbeschreibung').val(data['artikelbeschreibung']);
                $('#hersteller').val(data['hersteller']);
                $('#preis').val(data['preis']);
                $('#lagerbestand').val(data['lagerbestand']);
                getWarengruppen(data['warengruppe']);
                artikelSpeichern();
                getRabatt(data['rabatt']);
            },
            error : function(request,error)
            {
                alert("Fehler2");
            }
        });
    });
}*/

/*function getRabatt(rabatt) {
    $.ajax({
        url: 'php/artikel_verwalten.php',
        type: 'POST',
        data: {
            DATA:'select_rabatt',
        },
        dataType: 'json',
        success: function (data) {
            data.forEach(function (element) {
                if (element['rabatt'] == rabatt) {
                    $('#rabatt').append('<option selected value="'+element['rab_id']+'">'+element['rabatt']+'</option>');
                } else {
                    $('#rabatt').append('<option value="'+element['rab_id']+'">'+element['rabatt']+'</option>');
                }
            });
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
}

function getWarengruppen(warengruppe) {
    $.ajax({
        url: 'php/artikel_verwalten.php',
        type: 'POST',
        data: {
            DATA:'select_warengruppen',
        },
        dataType: 'json',
        success: function (data) {
            data.forEach(function (element) {
                if (element['warengruppe'] == warengruppe) {
                    $('#warengruppe').append('<option selected value="'+element['id']+'">'+element['warengruppe']+'</option>');
                } else {
                    $('#warengruppe').append('<option value="'+element['id']+'">'+element['warengruppe']+'</option>');
                }
            });
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
}*/
function artikelSpeichern(preis, lager) {

        let x = $('#image').val();
        imageUpload();
        $.ajax({
            url: 'php/artikel_verwalten.php',
            type: 'POST',
            data : {
                DATA:'artikel_speichern',
                'artikel_nr' : $('#artikel_nr').val(),
                'artikel_name' : $('#artikel_name').val(),
                'artikel_bez' : $('#artikel_bez').val(),
                'artikelbeschreibung' : $('#artikelbeschreibung').val(),
                'hersteller' : $('#hersteller').val(),
                'preis' : preis,
                'rabatt' : $('#rabatt').val(),
                'lagerbestand' : lager,
                'warengruppe' : $('#warengruppe').val(),
                'verfuegbarkeit' : $('#verfuegbarkeit').val(),
                'image' : x
            },
            dataType:'json',
            success : function(data) {
                alert(data["ok"])
                window.location.href='index.php?page=artikel_verwalten'
            },
            error : function(request,error) {
                alert("Artikel konnte nicht bearbeitet werden!");
            }
        });
}
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
            
        }
    })
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
/*
function artikelSuchenedit() {
    $('#btn_search_edit').on('click',function () {
        let suche = $('#suche_edit').val();
        $.ajax({
            url: 'php/artikel_verwalten.php',
            type: 'POST',
            data : {
                DATA:'sucheArtikeledit',
                'suche' : suche
            },
            dataType:'json',
            success : function(data) {
                $('#artikelliste').html('');
                data.forEach(function (element) {
                    $('#artikelliste').append('<div class="all_articles col-sm-2">\n' +
                        '            <div class="article col-md-2">\n' +
                        '                <div class="article_image">\n' +
                        '                    <img src="../img/'+element['produktbild']+'" class="produktbilder">' +
                        '                </div>\n' +
                        '                <div class="details_artikel">\n' +
                        '                    <ul>' +
                        '                        <li><b>Art.-Nr.:</b> ' +'<i>'+ element['artikelnr']+'</i>'+'</li>' +
                        '                        <li><b>Art.-Name:</b> ' + element['artikelname']+'</li>' +
                        '                        <li><b>Art.-Bez.:</b> ' + element['artikelbez']+'</li>' +
                        '                        <li><b>Hersteller:</b> ' + element['hersteller']+'</li>' +
                        '                        <li><b>Warengruppe:</b> ' + element['warengruppe']+'</li>' +
                        '                        <li><b>Preis:</b> ' + element['preis']+'€'+'</li>' +
                        '                        <li><b>Lagerbestand:</b> ' + element['lagerbestand']+' Stk'+'</li>' +
                        '                        <li><b>Verfügbar:</b> ' + element['verfuegbarkeit']+'</li>' +
                        '                    </ul>' +
                        '                </div>' +
                        '                <button class="btn_article_mainsite btn btn-primary" id="btn_artikel_bearbeiten">Artikel bearbeiten</button>' +
                        '            </div>' +
                        '        </div>')
                });

            },
            error : function(request,error)
            {
                alert("Fehler");
            }
        });
    })
}*/
