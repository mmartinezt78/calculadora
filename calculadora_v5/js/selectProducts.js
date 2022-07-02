var currencyId = {
    Argentina: "1",
    Uruguay: "2",
    Chileno: "3",
    CostaRica: "4",
    USA: "5"
}

var moreInfo = "";
var lessInfo = "";
var _reloadPage = true;

$(document).ready(function () {
    pageLoaded(true);
});

function pageLoaded(showLogin) {
    $("#show-add-battery").click(showAddBattery);
    $(".change-battery").click(changeBatteryQuantity);
    $(".toggle-more-text").click(toggleMoreText);
    $("#range-power").change(powerRangeChange);
    $("#range-power").on("input", powerRangeOnInput);
    $(".btn-category").click(categoryTypeChange);
    $("#butContinueSelectProducts").click(submitForm);
    $("#download-pdf").click(downloadPDF);
    $("#open-login").click(openLogin);
    $("#modal-login").on('hidden.bs.modal', function () {
        modalLoginHidden();
    });
    $("#modal-recover-password").on('hidden.bs.modal', function () {
        modalRecoverPasswordHidden();
    });
    $("#recover-password").click(recoverPasswordClick);
    //$("#recoverPasswordClose").click(recoverPasswordClose);

    if (currentCulture === "en-US") {
        moreInfo = "More info";
        lessInfo = "Less info";
    }
    else {
        moreInfo = "Más información";
        lessInfo = "Menos información";
    }
    initForm(showLogin);
}

function initForm(showLogin) {
    if (showLogin && $("#modal-user-login")) {
        $("#modal-user-login").modal("show");
    }

    if ($("#hdnProductCategoryId").val() === "1") {
        $("#category-type-switch").attr("checked", "checked");
        $(".switch .switch-slider").toggleClass("active");
    }

    let total = getFloat($("#hdnPrice").val());

    let consumptionType = $("#hdnConsumptionType").val();

    if (consumptionType === "False") {
        showAddBattery();
    }
    else {
        cashFinancedTotal(total);
    }
    validateHouseImage();

    setImpact();

}

function setImpact() {
    $(".coEmision-value").html($("#coEmision").html());
    $(".reforestation-value").html($("#reforestationId").html());
    $(".fuel-value").html($("#fuel").html());
}

function openLogin() {
    event.preventDefault();
    $("#modal-user-login").modal("hide");
    $("#modal-login").modal("show");
}

function modalLoginHidden() {
    if (_reloadPage) {
        window.location.reload();
    }
    _reloadPage = true;
}

function modalRecoverPasswordHidden() {
    window.location.reload();
}


function recoverPasswordClick() {
    _reloadPage = false;
}


async function categoryTypeChange(e) {
    let categoryTypeId = $(e.currentTarget).data("category");

    if (parseInt($("#hdnProductCategoryId").val()) === categoryTypeId) {
        return;
    }

    $("#modal-loading").modal("show");

    $("#hdnProductCategoryId").val(categoryTypeId);


    let id = $("#consumptionWizardId").val();
    let powerPercentage = $("#range-power").val();
    //if ($("#power-range-changed").val() === "0") {
    //    powerPercentage = 100;
    //}

    let data = { "Id": id, "powerPercentageSelected": powerPercentage };

    if (categoryTypeId === 1) {
        $("#btn-category-2").removeClass("active");
        $("#btn-category-1").addClass("active");
    }
    else {
        $("#btn-category-2").addClass("active");
        $("#btn-category-1").removeClass("active");
    }

    let response = await httpGet(siteUrls.consumptionWizard.selectProductPartial, data, showAjaxErrorModal);
    if (!response.success) {
        $("#modal-loading").modal("hide");
        return;
    }
    $("#select-product-data").html(response.data);

    let totalPrice = $("#hdnPrice").val();
    totalPrice = getFloat(totalPrice);
    cashFinancedTotal(totalPrice);
    pageLoaded(false);
    $("#modal-loading").modal("hide");
}

async function showAddBattery() {
    if (event) {
        event.preventDefault();
    }
    $("#powerbank-no").removeClass("d-flex");
    $("#powerbank-no").addClass("d-none");
    $("#powerbank-yes").removeClass("d-none");
    $(".battery-resume").show();
    await batteryQuantityChanged(true);
}

function hideAddBattery() {

    $("#powerbank-yes").addClass("d-none");
    $("#powerbank-no").addClass("d-flex");
    $("#powerbank-no").removeClass("d-none");
    $(".battery-resume").hide();
    $("#currentAutonomy").val(0);
    $("#hdnAutonomy").val(0);
    $("#battery-price-resume").html(0);
    $("#battery-price").val(0);
    let totalPrice = $("#hdnPrice").val();
    totalPrice = getFloat(totalPrice);
    cashFinancedTotal(totalPrice);

}

async function changeBatteryQuantity(e) {
    e.preventDefault();
    let $btn = $(e.currentTarget);
    let consumptionType = $("#hdnConsumptionType").val();
    if ($btn.hasClass("disabled")) {
        return;
    }
    let addAutonomy = parseInt($btn.data("quantity"));

    await batteryQuantityChanged(addAutonomy > 0);
}

async function batteryQuantityChanged(addAutonomy) {
    $("#addAutonomy").val(addAutonomy);
    let totalPrice = $("#hdnPrice").val();
    let data = $("#form-power-change").serialize();
    let consumptionType = $("#hdnConsumptionType").val();
    let response = await httpPost(siteUrls.consumptionWizard.batteryChanged, data, showAjaxErrorModal);
    if (!response.success) {
        return;
    }
    if (!response.data || response.data.autonomy === 0) {
        if (consumptionType === "False") {
            return;
        }
        hideAddBattery();
        powerRangeChange();
        return;
    }
    //let batteryName = response.data.battery.name;
    //if (batteryName.includes("Baterías")) {

    //    batteryName = batteryName.replace('Baterías', '');

    //}
    //batteryName = "Banco de baterías de" + batteryName;
    //$("#battery-name").html(batteryName);
    $("#currentAutonomy").val(toLocalNumber(response.data.autonomy));
    $("#hdnAutonomy").val(toLocalNumber(response.data.autonomy));
    $("#battery-backup-hour").html(response.data.autonomyString);
    $("#autonomy-resume").html(response.data.autonomyString);
    $("#battery-price-resume").html(response.data.totalPriceString);
    $("#battery-price").val(response.data.totalPrice);
    $("#more-battery").removeClass("disabled");
    if (!response.data.hasMoreAutonomy) {
        $("#more-battery").addClass("disabled");
    }
    let batteryQty = response.data.battery.quantity;
    if (currentCulture === "en-US") {
        $("#battery-quantity").html(`${batteryQty} ${pluralize("battery", batteryQty, true)}`);
    }
    else {
        $("#battery-quantity").html(`${batteryQty} ${pluralize("banco", batteryQty)} de baterías`);
    }

    $("#battery-power").html(response.data.battery.powerString);
    $("#battery-brand").html(response.data.battery.brand);

    if (response.data.battery.dataSheetFileId) {
        $("#battery-data-sheet").removeClass("d-none");
        $("#battery-data-sheet").attr("href", `${siteUrls.file.get}/${response.data.battery.dataSheetFileId}`);
    }
    else {
        $("#battery-data-sheet").addClass("d-none");
    }

    totalPrice = ParseFormattedNumber(totalPrice, ",", ".");

    powerRangeChange();
}

async function cashFinancedTotal(totalPrice) {

    if (typeof totalPrice === 'string') {
        totalPrice = parseFloat(totalPrice);
    }
    $("#system-price").html(toLocalNumberNoDecimals(totalPrice));
    let investmentBenefit = parseFloat($("#investment-benefit").val());

    let batteryPrice = parseFloat($("#battery-price").val());

    if (!isNaN(batteryPrice)) {
        $("#battery-price-resume").html(toLocalNumberNoDecimals(batteryPrice));
        $("#battery-price").val(batteryPrice);
        totalPrice = totalPrice + batteryPrice;
    }

    //if (investmentBenefit !== "") {
    //    totalPrice = totalPrice - investmentBenefit;
    //}

    let interestRate = parseFloat($("#hdnInterestRate").val());
    let months = parseInt($("#hdnFinancedMonths").val());
    let monthInterest = (interestRate / 12) * months;
    let financedTotalPrice = totalPrice + (totalPrice * monthInterest / 100);

    let financedMonthPrice = financedTotalPrice / months;

    $("#totalPriceQuote").html("$" + toLocalNumberNoDecimals(financedMonthPrice));

    $("#total-price-cash").html("$" + toLocalNumberNoDecimals(totalPrice));
    $("#total-price-financed").html("$" + toLocalNumberNoDecimals(financedTotalPrice));


    $("#total-price").html(toLocalNumberNoDecimals(totalPrice));
    $("#totalPrice").html("$" + toLocalNumberNoDecimals(totalPrice));
    $("#total-price").val(totalPrice);
    $("#totalPrice").val(totalPrice);
    totalPrice = totalPrice.toFixed(2);
    $("#hdnFinalPrice").val(totalPrice);

    if ($("#hdnConsumptionType").val() === "True") {
        investmentReturnInitialize();
    }
}


function toggleMoreText(e) {
    let $target = $(e.currentTarget);
    let $elemToCollapse = $($target.prop("hash"));
    if (!$elemToCollapse.hasClass("show")) {
        $target.html(lessInfo + " <i class=\"fal fa-angle-up\"></i>");
    }
    else {
        $target.html(moreInfo + " <i class=\"fal fa-angle-down\"></i>");
    }
    $elemToCollapse.collapse('toggle');
    e.preventDefault();
}

function powerRangeOnInput() {
    let newPower = $("#range-power").val();
    let consumptionPowerMonth = $("#range-power-valueMonth").val();
    $("#range-power-value").html(newPower);
    $("#consumption-power-month").html(parseInt(consumptionPowerMonth * newPower / 100));

    validateHouseImage();
}



async function powerRangeChange() {
    let newPower = $("#range-power").val();
    $("#powerPercentageSelected").val(newPower);
    $("#range-power-value").html(newPower);
    $("#power-range-changed").val(1);
    let data = $("#form-power-change").serialize();
    // let response = await httpPost(siteUrls.consumptionWizard.powerChanged, data, showAjaxErrorModal);
   let response = {
       data: {
           totalPrice: 5000000,
           totalPriceString: 5000000,
           enviromentalImpact: {
               coEmision: 80,
               reforestation: 332,
               fuel: 69525
           },
           totalFinancedPriceString: 5000000,
           systemPriceString: 4,
           totalKWString: 45550,
           fuel: 3065,
           productsToQuote: {
               solarPanel: {
                   productId: "2af09b04-40fa-4ae4-a315-26c794356c63",
                   name: "JinkoSolar 460Wp",
                   price: 238000.0,
                   power: 460,
                   productTypeId: 1,
                   showToClient: true,
                   isMicroInverter: false,

                   quantity: 23,
                   annualDegradation: 0.5,
                   powerString: "460 W",
                   brand: "Marca Producto",
                   dataSheetFileId: "a9621e07-282f-4073-9c98-c4043bed3982"
               },
               inverters: {}
           }
       }
   }

    /*
    if (!response.success) {
        return;
    }
    */

    updateInfo(response.data);

    $("#hdnPrice").val(response.data.totalPrice);

    let totalPrice = $("#hdnPrice").val();

    cashFinancedTotal(totalPrice);

}

function updateInfo(data) {
    $("#total-price").val(data.totalPrice);
    $("#total-price").html(data.totalPriceString);
    $("#totalPriceValue").val(data.totalPriceString);
    $("#totalFinancedValue").val(data.totalFinancedPriceString);
    $("#system-price").html(data.systemPriceString);

    $(".total-kW").html(data.totalKWString);

    $("#hdnTotalKW").val(data.totalKWString);

    $("#totalKwVal").val(data.totalKWString);

    let coEmision = data.enviromentalImpact.coEmision
    let reforestation = data.enviromentalImpact.reforestation;
    let fuel = data.enviromentalImpact.fuel / volumeCoeficient;

    coEmision = toLocalNumberNoDecimals(coEmision);
    reforestation = toLocalNumberNoDecimals(reforestation);
    fuel = toLocalNumberNoDecimals(fuel);

    $(".coEmision-value").html(coEmision);
    $(".reforestation-value").html(reforestation);
    $(".fuel-value").html(fuel);

    let panelQty = data.productsToQuote.solarPanel.quantity;

    if (currentCulture === "en-US") {
        $("#solar-panel-quantity").html(`${panelQty} solar ${pluralize("panel", panelQty)}`);
    }
    else {
        $("#solar-panel-quantity").html(`${panelQty} ${pluralize("panel", panelQty)} ${pluralize("solar", panelQty)}`);
    }

    $("#hdnAnnualDegradation").val(toLocalNumber(data.productsToQuote.solarPanel.annualDegradation));
    $("#solar-panel-power").html(data.productsToQuote.solarPanel.powerString);
    $("#solar-panel-brand").html(data.productsToQuote.solarPanel.brand);
    if (data.productsToQuote.solarPanel.dataSheetFileId) {
        $("#solar-panel-data-sheet").removeClass("d-none");
        $("#solar-panel-data-sheet").attr("href", `${siteUrls.file.get}/${data.productsToQuote.solarPanel.dataSheetFileId}`);
    }
    else {
        $("#solar-panel-data-sheet").addClass("d-none");
    }
    $(".inverter").remove();
    let inverterHTML = "";
    for (i = 0; i < data.productsToQuote.inverters.length; i++) {
        let inverter = data.productsToQuote.inverters[i];
        inverterHTML += getInverterHTML(inverter);
    }
    $("#next-inverters").after(inverterHTML);
    validateHouseImage();

}

function getInverterHTML(inverter) {
    let inverterHTML = '';
    if (inverter.isMicroInverter) {
        if (currentCulture === "en-US") {
            inverterHTML += `<dt class="col-9 inverter">Micro Inverters System ${inverter.brand}</dt>`;
        }
        else {
            inverterHTML += `<dt class="col-9 inverter">Sistema de Micro Inverters ${inverter.brand}</dt>`;
        }
    }
    else {
        if (currentCulture === "en-US") {
            inverterHTML += `<dt class="col-9 inverter">${inverter.quantity} ${pluralize("inverter", inverter.quantity, true)} of ${inverter.powerString} ${inverter.brand}</dt>`;
        }
        else {
            inverterHTML += `<dt class="col-9 inverter">${inverter.quantity} ${pluralize("inverter", inverter.quantity, true)} de ${inverter.powerString} ${inverter.brand}</dt>`;
        }
    }
    if (currentCulture === "en-US") {
        inverterHTML += `<dd class="col-3 text-right inverter">
                ${inverter.dataSheetFileId ? `<a target="_blank" href="${siteUrls.file.get}/${inverter.dataSheetFileId}" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Data Sheet"><i class="fal fa-paperclip"></i></a>` : ``}
            </dd>`;
    }
    else {
        inverterHTML += `<dd class="col-3 text-right inverter">
                ${inverter.dataSheetFileId ? `<a target="_blank" href="${siteUrls.file.get}/${inverter.dataSheetFileId}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver Data Sheet"><i class="fal fa-paperclip"></i></a>` : ``}
            </dd>`;
    }

    return inverterHTML;
}


function registerSuccess() {
    window.location.reload();
}

function submitForm(e) {
    e.preventDefault();
    $("#DownloadPDF").val(false);
    $("#form-select-product").submit();
}

function downloadPDF(e) {
    e.preventDefault();
    $("#DownloadPDF").val(true);
    $("#form-select-product").submit();
}

function rangePowerChanged() {
    let priceValue = $("#range-price").val();
    if (priceValue === "0") {
        priceValue = 100;
    }
    let powerValue = (priceValue * $("#coeficientConsmption").val()) / $("#rateConsumptionPrice").val();
    powerValue = parseInt(powerValue);

    $("#range-power-value").val(powerValue);
    $("#powerLabel").html(powerValue);
    $("#range-power-value-aside").html(powerValue);

    let pricePower = "$ " + priceValue;
    $("#powerPrice").html(pricePower);

}

function validateHouseImage() {
    var rangePower = parseInt($("#range-power").val());

    if (rangePower === 100) {
        $("#imgHouse").attr('src', 'img/casa-100.jpg')
    }
    else if (rangePower >= 75) { $("#imgHouse").attr('src', 'img/casa-75.jpg'); }
    else if (rangePower >= 55) { $("#imgHouse").attr('src', 'img/casa-60.jpg'); }
    else if (rangePower >= 25) { $("#imgHouse").attr('src', 'img/casa-50.jpg'); }

}