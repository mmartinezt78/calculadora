$(document).ready(function () {
    if ($("#HasCountry").val() === "False") {
        $("#modal-country").modal("show");
    }
    initStep1();
    if (isInApp) {
        initStep2();
        CheckGoToStep2();
    }
    //$("#recoverPasswordSubmit").click(DisableRecoverPasswordBut());
    let placeholder = $("#txt-area-manual").prop("placeholder");
    let labelHTML = $("#area-manual-label").html();

    if (areaAsFt) {
        $("#txt-area-manual").prop("placeholder", placeholder + " " + areaUnitPlaceholderFt);
        $("#area-manual-label").html(labelHTML + " " + areaUnitPlaceholderFt);
    }
    else {
        $("#txt-area-manual").prop("placeholder", placeholder + " " + areaUnitPlaceholderM);
        $("#area-manual-label").html(labelHTML + " " + areaUnitPlaceholderM);
    }
});

function CheckGoToStep2() {
    if ($("#Step").val() === '2') {
        SetLatLng(getFloatComplete($("#lat").val()), getFloatComplete($("#lng").val()));
        goToStep2(true);
    }
}

function hideAll() {
    $(".background-overlay").hide();
    $("#step-1").hide();
    $("#step-2").hide();
    $("#top-navbar").removeClass("bg-dark");
    $("#top-navbar").addClass("bg-transparent");
    $("#butGeolocate").tooltip("hide");
}

function goToStep1() {
    hideAll();
    event.preventDefault();
    showStep1();
}

function goToStep2(isEditing) {
    hideAll();
    if (!isEditing) {
        resetStep2();
    }
    showStep2();
}

