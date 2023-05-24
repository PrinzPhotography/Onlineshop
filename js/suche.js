$(document).ready(function () {
    $('#btn_search_all').on('click',function () {
        let suche = $('#suche_alle').val();
        window.location.href='index.php?page=suche&anfrage='+suche;
    });
});

