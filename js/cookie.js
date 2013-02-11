jQuery(document).ready(function($) {
    var data = pmg_cookie || {};

    function set_hide(cb) {
        $.get(data.ajax, {action: data.dismiss}, cb);
    }

    $.get(data.ajax, {action: data.action, ip: data.remote_ip}, function(resp) {
        var h;

        if ('1' == resp) {
            $cook = $('.pmg-cookie-wrap');

            // do a dance to get an actual height.
            $cook.css({display: 'block', visibility: 'hidden'});
            h = $cook.height();
            $cook.css({display: 'none', visibility: 'visible'});

            // show the message
            $cook.slideDown({queue: false});
            $('body').animate({'padding-top': h}, {queue: false});
        }
    });

    $('body').on('click', '.pmg-cookie-dismiss', function(e) {
        set_hide(function() {
            $('.pmg-cookie-wrap').slideUp({queue: false});
            $('body').animate({'padding-top': '0'}, {queue: false});
        });
    });
});
