/// <reference path="../../googlemaphelper.js" />
let geolocation;
let firstAddress = true;


var countryId = {
    Argentina: "1",
    Panama: "2",
    CostaRica: "3"
}

var referenceCodeType = {

    MontoFijo: "1",
    Porcentaje: "2",
    VisitaTecnica: "3"
}

var tipoCodigoVisita = false;

$(document).ready(function () {

    $(".address-change").on("input", setFullAddress);

    $("#checkout-accordion .collapse").on("hide.bs.collapse", validateSection);
    $("#continue-personal-data").click(constinuePersonalData);
    $("#continue-address").click(continueAddress);
    $("#apply-discount-code").click(applyDiscountCode);
    $("#discount-code-delete").click(deleteDiscountCode);

    $("#address-autocomplete").change(searchAddress());
    $("#address-ZipCode").keyup(setZipCode);
    initPage();

    let discountCode = $("#discount-code").val();
    if (discountCode !== "") {
        applyDiscountCode();
    }
});

function initPage() {
    setFullAddress();
    //  $("form").data("validator").settings.ignore = "";

    $("#butContinueCheckout").prop('disabled', true).addClass('disabled').css("background-color", "grey");

    totalPrice = $("#totalPriceValue").val();
    $("#hdnFinalPrice").val(totalPrice);
    // cashFinancedTotal(totalPrice);

    //$("#visitaTecnicaDate").html("-");
    $("#techincalVisitTime").html("-");
}

function setZipCode() {
    $("#postal_code").val($("#address-ZipCode").val());
}

function setFullAddress() {
    let street = $("#address-autocomplete").val();
    let streetNumber = $("#address-streetNumber").val();
    let city = $("#address-city").val();
    let state = $("#address-state").val();
    let country = $("#address-country").val();
    let postal_code = $("#address-ZipCode").val();
    //let administrative_area_level_1 = $("#address-state").val();
    let fullStreet = street;
    fullStreet += (fullStreet !== "" ? " " : "") + streetNumber;
    let addressParts = [fullStreet, city, state, country, postal_code].filter(x => x);
    $("#full-address").html(addressParts.join(", "));
}

function constinuePersonalData() {
    let $section = $("#collapse-user");
    if (!validate($section)) {
        return;
    }
    $("#collapse-address").collapse("show");
}

function continueAddress() {

    let $section = $("#collapse-address");
    if (!validate($section)) {
        return;
    }
    $("#collapse-technical-visit").collapse("show");

    $("#butContinueCheckout").prop('disabled', false);
    $("#butContinueCheckout").removeClass("disabled").css("background-color", "");
    $("#butContinueCheckout").click(submitForm);

    initDatePicker();
}

async function applyDiscountCode() {
    $("#discount-code-invalid").hide();
    let discountCode = $("#discount-code").val();
    if (discountCode === '') {
        return;
    }
    let data = { "DiscountCode": discountCode, "ConsumptionWizardId": $("#consumptionWizardId").val() };
    let response = await httpPost(siteUrls.consumptionWizard.checkDiscount, data, showAjaxErrorModal);
    if (!response.success) {
        return;
    }
    if (!response.data.codeIsValid) {
        $("#discount-code-invalid").show();
        return;
    }
    if (response.data.technicalVisitDiscount === true) {
        $("#visit-price").css("text-decoration", "line-through");
    }

    $("#div-discount-applied").show();
    $("#discount-code-text").html($("#discount-code").val());
    $("#discount-code").val("");
    $(".resume-discount").hide();
    if (response.data.technicalVisitDiscount) {
        setTotalPrice(0);
    }
    else {
        $(".resume-discount").show();
        $("#resume-discount-total").html(toLocalNumberNoDecimals(response.data.discountAmount));
        setTotalPrice(response.data.discountAmount);

        totalPrice = getFloat($("#totalPriceValue").val());
        discountPrice = response.data.discountAmount;


        totalPrice = totalPrice - discountPrice;

        cashFinancedTotal(totalPrice);

    }
}

async function applyInvestmentBenefit() {

    var countryIdAddress;
    var country = $("#address-country").val();

    if (country === "Argentina") {
        countryIdAddress = countryId.Argentina;
    }
    else if (country === "Costa Rica") {
        countryIdAddress = countryId.CostaRica;
    }
    else if (country === "Panamá") {
        countryIdAddress = countryId.Panama;
    }

    let data = {
        "ConsumptionWizardId": $("#consumptionWizardId").val(), "CountryId": countryIdAddress, "State": $("#address-state").val(), "Power": parseInt($("#totalPower").val()), "TotalAmount": parseInt($("#totalPriceValue").val()) };
    let response = await httpPost(siteUrls.investmentBenefit.checkInvestmentBenefit, data, showAjaxErrorModal);
    if (!response.success) {
        return;
    }
    if (!response.data.hasBenefit) {
        $(".investment-benefit-resume").hide();
        $("#investment-benefit-price").html(response.data.totalBenefit);
        setTotalPrice(0);
        return;
    }

    $(".investment-benefit-resume").show();
    $("#investment-benefit-price").html(response.data.totalBenefit);
    setTotalPrice(response.data.totalBenefit);
}

async function deleteDiscountCode() {
    let data = { "Id": $("#consumptionWizardId").val() };
    let response = await httpPost(siteUrls.consumptionWizard.deleteDiscount, data, showAjaxErrorModal);
    if (!response.success) {
        return;
    }
    $(".resume-discount").hide();
    $("#div-discount-applied").hide();
    $("#visit-price").css("text-decoration", "");

    totalPrice = getFloat($("#totalPriceValue").val());

    cashFinancedTotal(totalPrice);
}

function setTotalPrice(discountPrice) {
    let price = getFloat($("#totalPriceValue").val());
    price -= discountPrice;
    $("#total-price-cash").html("$" + toLocalNumberNoDecimals(price));

    cashFinancedTotal(price);

}


function validateSection(e) {
    let $target = $(e.currentTarget);
    validate($target);
    validate($target);
}

function validate($target) {
    let $validationFields = $("." + $target.data("validation"));
    let $resultTarget = $("#" + $target.data("result"));
    let isValid = true;
    if ($validationFields.length) {
        isValid = $validationFields.valid();
    }
    $resultTarget.removeClass("fa-check-circle");
    $resultTarget.removeClass("fa-times-circle");
    $resultTarget.removeClass("text-success");
    $resultTarget.removeClass("text-danger");
    if (isValid) {
        $resultTarget.addClass("fa-check-circle");
        $resultTarget.addClass("text-success");
    }
    else {
        $resultTarget.addClass("fa-times-circle");
        $resultTarget.addClass("text-danger");
    }
    $resultTarget.show();
    return isValid;
}


function submitForm(e) {
    e.preventDefault();

    let isValid = true;

    $validationElements = $(".to-validate");
    $validationElements.each(function (index, elem) {
        isValid = validate($(elem)) && isValid;
    });

    if (isValid) {
        isValid = validateDateTime();
    }

    if (isValid) {
        validateFormOnSubmit();
        // $("#form-checkout").submit();
    }
}


let componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function initAddressAutocomplete() {

    let addressAutocomplete = new google.maps.places.Autocomplete(document.getElementById('address-autocomplete'), { types: ['geocode'] });
    addressAutocomplete.setFields(['address_component', 'geometry']);
    addressAutocomplete.addListener('place_changed', function () {
        fillInAddress(addressAutocomplete.getPlace());
        //goToStep2(false);
    });
}

function searchAddress() {
    // event.preventDefault();
    if ($("#address-autocomplete").val() === "") {
        $("#modal-address-incomplete").modal("show");
        return;
    }
    if (!firstAddress) {
        let geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': $("#address-autocomplete").val() }, function (results, status) {
            processGeocodeResponse(results, status);
        });
    }
    firstAddress = false;
}

function fillInAddress(place) {
    for (let component in componentForm) {
        document.getElementById(component).value = '';
    }

    for (let i = 0; i < place.address_components.length; i++) {
        let addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }
    SetLatLng(place.geometry.location.lat(), place.geometry.location.lng());

    $("#address-streetNumber").val($("#street_number").val());
    $("#address-city").val($("#locality").val());
    $("#address-state").val($("#administrative_area_level_1").val());
    $("#address-country").val($("#country").val());
    $("#address-ZipCode").val($("#postal_code").val());
    $("#address-autocomplete").val($("#route").val());

    setFullAddress();
    applyInvestmentBenefit()
}

function setAddress() {
    let geocoder = new google.maps.Geocoder();
    geocoder.geocode({ location: geolocation }, function (results, status) {
        processGeocodeResponse(results, status);
    });
}


function processGeocodeResponse(results, status) {
    if (status === "OK") {
        if (results[0]) {
            fillInAddress(results[0]);

        } else {
            window.alert("No results found");
        }
    }
    else {
        window.alert("Geocoder failed due to: " + status);
    }
}

function SetLatLng(lat, lng) {
    geolocation = {
        lat: lat,
        lng: lng
    };
    $("#lat").val(lat);
    $("#lng").val(lng);
}


function initDatePicker() {
    $(".datepicker").datepicker();
}

function validateDateTime() {
    let technicalVisitDate = getDateFromString($("#technicalVisitDateId").val());
    let technicalVisitTime = $("#technicalVisitTimeId").val();
    let technicalVisitHour = 0;
    if (technicalVisitTime !== "") {
        technicalVisitHour = parseInt(technicalVisitTime.split(":")[0]);
    }
    let today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate())
    time = parseInt(new Date().getHours());

    if (technicalVisitDate < today) {
        $("#technicalVisitDateError").html(fechaNoPuedeSerMenorAHoy);
        return false;
    }
    if (technicalVisitDate.toLocaleDateString() === today.toLocaleDateString() && technicalVisitHour < time) {
        $("#technicalVisitTimeError").html(horarioNoPuedeSerMenorAHoy);
        return false;
    }

    return true;

}

async function cashFinancedTotal(totalPrice) {

    if (typeof totalPrice === 'string') {
        totalPrice = getFloat(totalPrice);
    }

    //currencyTotalRate = parseFloat(currencyTotalRate).toFixed(2);
    //totalPrice = (totalPrice * currencyTotalRate).toFixed(2);
    //$("#system-price").html(toLocalNumber(totalPrice));
    let investmentBenefit = getFloat($("#investment-benefit").val());

    let batteryPrice = getFloat($("#batteryPrice").val());

    if (!isNaN(batteryPrice)) {
        $("#battery-price-resume").html(toLocalNumber(batteryPrice));
        totalPrice = totalPrice + batteryPrice;
    }

    let visitPrice = $("#visit-price").html();

    //visitPrice = (visitPrice).toFixed(2);

    $("#visit-price").html(toLocalNumber(visitPrice));

    if (investmentBenefit !== "") {
        totalPrice = totalPrice - investmentBenefit;
    }

    let interestRate = getFloat($("#hdnInterestRate").val());
    let months = parseInt($("#hdnFinancedMonths").val());
    let monthInterest = (interestRate / 12) * months;
    let financedTotalPrice = totalPrice + (totalPrice * monthInterest / 100);

    let financedMonthPrice = financedTotalPrice / months;


    $("#totalPriceQuote").html("$" + toLocalNumberNoDecimals(financedMonthPrice));

    $("#total-price-cash").html("$" + toLocalNumberNoDecimals(totalPrice));
    $("#total-price-financed").html("$" + toLocalNumberNoDecimals(financedTotalPrice));

    //$("#total-price").val(totalPrice);
    $("#totalPrice").val(totalPrice);

    let priceQuote = totalPrice / 12;

    totalPrice = totalPrice.toFixed(2);


    $("#total-price-cash").html(toLocalNumberNoDecimals(totalPrice));
    $("#totalPrice").html("$" + toLocalNumberNoDecimals(totalPrice));
}

function setVisitDate() {

    $("#visitaTecnicaDate").val($("#technicalVisitDateId").val());
    $("#visitaTecnicaDate").html($("#technicalVisitDateId").val());

}

function setVisitTime() {
    let technicalVisitTime = $("#technicalVisitTimeId").val();
    let aVal = "a";
    if (currentCulture === "en-US") {
        aVal = "to";
    }
    switch (technicalVisitTime) {

        case "08:00":
            $("#techincalVisitTime").val("08:00 AM a 11:00 AM");
            $("#techincalVisitTime").html("08:00 AM " + aVal + " 11:00 AM");
            break;
        case "11:00":
            $("#techincalVisitTime").val("11:00 AM a 02:00 PM");
            $("#techincalVisitTime").html("11:00 AM " + aVal + " 02:00 PM");
            break;
        case "14:00":
            $("#techincalVisitTime").val("02:00 PM a 06:00 PM");
            $("#techincalVisitTime").html("02:00 PM " + aVal + " 06:00 PM");
            break;
    }
}