$(document).ready(function () {
    bewertungenIndex();
    bewertungenUser();
    bewerten();
    $('.delete_rezi').on('click',function (){
        let id = $(this).val();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    deleteRezi(id);
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
});

function deleteRezi(id) {
    $.ajax({
        url: 'php/artikel_verwalten.php',
        type: 'POST',
        data : {
            DATA:'bewertung_delete',
            bewertungId : id
        },
        dataType:'json',
        success : function(data) {
            location.reload();
        },
        error : function(request,error) {
            alert('error');
        }
    });
}

function bewerten() {

    let sterne = null;

    $('input').on('click',function () {
        $(this).prop('checked', true);
        sterne = $("input:checked").val();
    });

    $('#btn_bewertung').on('click',function () {
        if(sterne === null) {
            swal("Warnung!", "Sie müssen Sterne angeben um zu bewerten!", "warning");
            return;
        }
        let artikel = $(this).val();
        let bewertung = $('#bewertung_text').val();
        $.ajax({
            url: 'php/rezensionen.php',
            type: 'POST',
            data : {
                DATA:'bewertung_abgeben',
                bewertung: bewertung,
                artikel: artikel,
                sterne: sterne
            },
            dataType:'json',
            success : function(data) {
/*                if(data === '1') {
                    swal("Erfolgreich!", "Vielen Dank für Ihre Bewertung", "success");
                    window.location.href='index.php?page=artikelseite&artikel='+artikel;
                } if (data === 'Sie können einen Artikle nur eine Bewertung geben!') {

                } else {
                    swal("Warnung!", data, "warning");
                }*/
                if(data['success'] === true) {
                    if(data['otherData'] === 'Erfolgreich') {
                        swal("Erfolgreich!", "Vielen Dank für Ihre Bewertung", "success");
                        window.location.href='index.php?page=artikelseite&artikel='+artikel;
                    }
                    if(data['otherData'] === 'Update') {
                        swal("Sie haben bereits eine Rezension geschrieben! Möchten sie diese Überschreiben?", {
                            buttons: {
                                cancel: "Nein",
                                accept: "Ja",
                            },
                        })
                            .then((value) => {
                                switch (value) {

                                    case "accept":
                                        bewertungUpdate(sterne, bewertung, artikel)
                                        break;
                                    default:
                                        swal("Erfolgreich","Nichts hat sich geändert!", "success");
                                }
                            });

                    }
                } else {
                    swal("Warnung!", "Admins dürfen nicht bewerten!", "warning");
                }
            },
            error : function(request,error) {
                alert("Bitte loggen Sie sich ein um diesen Artikel zu bewerten");
            }
        });
    });

}
function bewertungUpdate(stars, rating, article) {
    $.ajax({
        url: 'php/rezensionen.php',
        type: 'POST',
        data : {
            DATA:'bewertung_update',
            stars:   stars,
            rating:  rating,
            article: article
        },
        dataType:'json',
        success : function(data) {
            if(data['success'] === true) {
                swal("Erfolgreich","Ihre Rezension wurde erfolgreich geändert!", "success");
                location.reload();
            }
        },
        error : function(request,error) {
            alert('error');
        }
    });
}

function bewertungenIndex() {

    let average = 0;

    $('.artikel_spalte').each(function() {
        average = Math.round($(this).find('.bewertung .sterne span').text());
        $(this).find('.rating-'+average).prop('checked', true);
    });
}

function bewertungenUser() {

    let average = 0;

    $('.div_sterne-name').each(function() {
        average = $(this).find('.sterne_user').val();
        $(this).find('.'+average).prop('checked', true);

    });
}