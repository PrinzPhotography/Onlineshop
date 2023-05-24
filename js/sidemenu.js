$(document).ready(function () {
    $('.sub-btn').on('click',function () {
        $(this).next('.sub-menu').slideToggle();
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $('#shopping_cart').on('click', function () {
        window.location.href='index.php?page=cart'
    });
    $('.pdf').on('click', function () {
        window.open('../dokumente_temp/test.pdf');
    });
});
