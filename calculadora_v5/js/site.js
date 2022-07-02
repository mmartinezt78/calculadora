Array.prototype.clean = function (deleteValue) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] === deleteValue) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
};

var pathNames = window.location.pathname.split('/').clean('');
var urlStart = '/' + pathNames[0] + '/' + pathNames[1];


$(document).ready(function () {
    setSizeClass();
    $(window).on('scroll', onWindowScroll);
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    $('#modal-recover-password').on('shown.bs.modal', function () {
        $("#modal-login").modal("hide");
        $('#txtEmail').trigger('focus');
    });

    if (areaAsFt) {
        $(".area-unit").html(areaUnitFt);
    }
    else {
        $(".area-unit").html(areaUnitM);
    }

    if (volumeAsGallon) {
        $(".volume-unit").html(volumeUnitGal);
    }
    else {
        $(".volume-unit").html(volumeUnitL);
    }
});

function onWindowScroll() {
    if ($(this).scrollTop() > 0) {
        $('.navbar').addClass("bg-dark");
        $('.navbar').addClass("navbar-light");
        $('.navbar').removeClass("bg-transparent");
    }
    else {
        $('.navbar').removeClass("bg-dark");
        $('.navbar').addClass("bg-transparent");
        $('.navbar').removeClass("navbar-light");
        $('.navbar').addClass("navbar-dark");
    }
}

function setSizeClass() {
    let $window = $(window);
    let $logo = $('.navbar');

    $window.resize(function resize() {
        if ($window.width() < 576) {
            return $logo.addClass('mobile');
        }
        $logo.removeClass('mobile');
    }).trigger('resize');
}

function pluralize(text, qty, english) {

    if (!text || !qty) {
        return "";
    }
    if (qty <= 1) {
        return text;
    }

    if (english) {
        let lastLetter = text.toLowerCase().slice(-1);
        if (lastLetter === "y") {
            return text.slice(0, text.length - 1) + "ies";
        }
        return text + 's';
    }

    let lastLetter = text.toLowerCase().slice(-1);
    if (lastLetter === 'a' || lastLetter === 'e' || lastLetter === 'i' || lastLetter === 'o' || lastLetter === 'u') {
        return text + 's';
    }
    else {
        return text + 'es';
    }
}

function onlyNumbers(source) {
    return source.replace(/\D/g, "");
}

function LoginSaveSuccess() {
    $("#modal-login").modal("hide");
    $("#form-login-edit").trigger("reset");
    $("#modal-message").modal("show");
    window.location.reload();
}

function LoginFailed(XMLHttpRequest, textStatus, errorThrown) {
    $("#login-error-message").html(XMLHttpRequest.responseText);
    $("#login-error").show();
}

function RecoverPasswordSuccess(data) {
    $("#form-recover-password").trigger("reset");
    $("#txtEmail").hide();

    $("#modal-message").modal("show");
    $("#recoverPasswordLabel").text(data);
    $("#recoverPasswordSubmit").hide();
    $("#recoverPasswordClose").removeClass("d-none");
}

function RecoverPasswordFailed(XMLHttpRequest, textStatus, errorThrown) {
    $("#recover-password-error-message").html(XMLHttpRequest.responseText);
    $("#recover-password-error").show();
    $("#recoverPasswordSubmit").prop('disabled', false);
}

function DisableRecoverPasswordBut() {
    $("#recoverPasswordSubmit").prop('disabled', true);
    $("#form-recover-password").submit();
}


function toLocalNumberComplete(val) {
    return parseFloat(val).toLocaleString(currentCulture, { minimumFractionDigits: 2, maximumFractionDigits: 10, style: 'decimal' })
}

function toLocalNumber(val) {
    return parseFloat(val).toLocaleString(currentCulture, { minimumFractionDigits: 2, maximumFractionDigits: 2, style: 'decimal' })
}

function toLocalNumberNoDecimals(val) {
    return parseFloat(val).toLocaleString(currentCulture, { maximumFractionDigits: 0, style: 'decimal' })
}


function getFloat(val) {
    return parseFloat(ParseFormattedNumber(val, groupSeparator, decimalSeparator, 2));
}

function getFloatComplete(val) {
    return parseFloat(ParseFormattedNumber(val, groupSeparator, decimalSeparator, null));
}

function ParseFormattedNumber(strNumber, groupSeparator, decimalSeparator, numOfDecimals) {
    //Default values are written like this for Pre-ES2015 compatibility
    numOfDecimals = typeof numOfDecimals === 'undefined' ? null : numOfDecimals;
    let decimalStart = strNumber.indexOf(decimalSeparator);
    let decimals;
    let naturalNum;
    if (decimalStart === -1) {
        decimals = '0';
        naturalNum = strNumber;
    }
    else {
        decimals = strNumber.slice(decimalStart + 1);
        naturalNum = strNumber.slice(0, decimalStart);
    }
    naturalNum = naturalNum.trim().split(groupSeparator).join('');
    let number = parseFloat(naturalNum + "." + decimals);
    return numOfDecimals === null ? +number : number.toFixed(numOfDecimals);
}


function numberWithCommas(value) {
    var parts = value.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}


function getArea(value) {

}