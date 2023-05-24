$(document).ready(function () {
    var artikel = "";
    $('.zum_artikel').on('click',function () {
        artikel = $(this).val();
        window.location.href='index.php?page=artikelseite&artikel='+artikel;
    });
});

