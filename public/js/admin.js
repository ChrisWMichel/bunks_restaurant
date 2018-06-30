$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $('#flash-overlay-modal').modal();

    /*$("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });*/

    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);

    $('#sidebarCollapse').on('click', function () {

        $('#sidebar').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });


});