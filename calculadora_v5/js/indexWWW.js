(function ($) {

    $.fn.visible = function (partial) {

        var $t = $(this),
            $w = $(window),
            viewTop = $w.scrollTop(),
            viewBottom = viewTop + $w.height(),
            _top = $t.offset().top,
            _bottom = _top + $t.height(),
            compareTop = partial === true ? _bottom : _top,
            compareBottom = partial === true ? _top : _bottom;

        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

    };

})(jQuery);

$(window).scroll(function (event) {

    $(".animate-fade-in-up").each(function (i, el) {
        var el = $(el);
        if (el.visible(true)) {
            el.addClass("animate__fadeInUp");
        }
    });
    $(".animate-fade-in-left").each(function (i, el) {
        var el = $(el);
        if (el.visible(true)) {
            el.addClass("animate__fadeInLeft");
        }
    });
    $(".animate-fade-in-right").each(function (i, el) {
        var el = $(el);
        if (el.visible(true)) {
            el.addClass("animate__fadeInRight");
        }
    });
    $(".animate-fade-in").each(function (i, el) {
        var el = $(el);
        if (el.visible(true)) {
            el.addClass("animate__fadeIn");
        }
    });

});




function contactFormSuccess(data) {
    $(".contact-alarm").remove();
    $("#form-contact").prepend(getAlert(data, "success"));
    document.getElementById("form-contact").reset();
}

function contactFormFailure(XMLHttpRequest, textStatus, errorThrown) {
    $(".contact-alarm").remove();
    $("#form-contact").prepend(getAlert(XMLHttpRequest.responseText, "danger"));
    document.getElementById("form-contact").reset();
}

function getAlert(message, type) {
    return `<div class="alert alert-${type} contact-alarm" role="alert">
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ${message}
    </div>`;
}