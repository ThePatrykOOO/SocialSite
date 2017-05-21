$(document).ready(function () {
    $('#homeLink').click(function() {
        if ($('#restigerLink').hasClass("active")) {
            $('#restigerLink').removeClass("active");
        } else if ($('#loginLink').hasClass("active")) {
            $('#loginLink').removeClass("active");
        } else if ($('#aboutLink').hasClass("active")) {
            $('#aboutLink').removeClass("active");
        }
        $('#homeLink').addClass("active");
        $('#home').animatescroll({padding:100});
    });
    $('#restigerLink').click(function() {
        if ($('#homeLink').hasClass("active")) {
            $('#homeLink').removeClass("active");
        } else if ($('#loginLink').hasClass("active")) {
            $('#loginLink').removeClass("active");
        } else if ($('#aboutLink').hasClass("active")) {
            $('#aboutLink').removeClass("active");
        }
        $('#restigerLink').addClass("active");
        $('#restiger').animatescroll({padding:100});
    });
    $('#loginLink').click(function() {
        if ($('#homeLink').hasClass("active")) {
            $('#homeLink').removeClass("active");
        } else if ($('#restigerLink').hasClass("active")) {
            $('#restigerLink').removeClass("active");
        } else if ($('#aboutLink').hasClass("active")) {
            $('#aboutLink').removeClass("active");
        }
        $('#loginLink').addClass("active");
        $('#login').animatescroll({padding:100});
    });
    $('#aboutLink').click(function() {
        if ($('#homeLink').hasClass("active")) {
            $('#homeLink').removeClass("active");
        } else if ($('#restigerLink').hasClass("active")) {
            $('#restigerLink').removeClass("active");
        } else if ($('#loginLink').hasClass("active")) {
            $('#loginLink').removeClass("active");
        }
        $('#aboutLink').addClass("active");
        $('#about').animatescroll({padding:100});
    });

});