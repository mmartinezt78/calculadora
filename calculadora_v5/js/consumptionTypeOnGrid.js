var moreInfo = "";
var lessInfo = "";

$(document).ready(function () {
    $("#range-price").on("input", rangePowerChanged);
    $("#but-add-file").click(addFileClick);
    $("#add-file").change(addFileChange);
    $("#but-delete-file").click(deleteFileClick);
    $("#read-more-link-invoice").click(swapTextInvoice);
    initForm();
});



function initForm() {
    if ($("#invoice-file-id").val() !== "") {
        $("#file-attached").show();
    }
    if (currentCulture === "en-US") {
        moreInfo = "Más información";
        lessInfo = "Menos información";
    }
    else {
        moreInfo = "Más información";
        lessInfo = "Menos información";
    }
    rangePowerChanged();
}

function rangePowerChanged() {
    let priceValue = $("#range-price").val();
    if (priceValue == "0") {
        priceValue = 100;
    }
    priceValue = parseFloat(priceValue);
    var coeficientConsumption = getFloat($("#coeficientConsumption").val());
    var pricePerKw = getFloat($("#PricePerKw").val());
    $("#PricePerKw").val(toLocalNumberComplete(pricePerKw));
    $("#pricePerKwVal").val(toLocalNumberComplete(pricePerKw));

    // Precio mensual seleccionado * 0,99 / valor de compañia electrica
    let powerValue = (priceValue * coeficientConsumption) / pricePerKw;
    powerValue = parseInt(powerValue);

    $("#range-power-value").val(powerValue);
    $("#powerLabel").html(powerValue);
    $("#range-power-value-aside").html(powerValue);

    let pricePower = "$ " + priceValue;
    $("#powerPrice").html(pricePower);

}

function addFileChange() {
    let files = $("#add-file")[0].files;
    if (!files) {
        $("#file-name").html("");
        $("#file-attached").hide();
        return;
    }
    $("#invoice-file-id").val("");
    let fileName = files[0].name;
    $("#file-name").html(fileName);
    $("#file-attached").show();
}

function addFileClick() {
    event.preventDefault();
    $("#add-file").click();
}

function deleteFileClick() {
    event.preventDefault();
    $("#file-attached").hide();
    $("#invoice-file-id").val("");
    $("#file-name").html("");
    $("#add-file").val(null);
}

function swapTextInvoice(e) {
    var x = document.getElementById("read-more-link-invoice");
    if (x.innerHTML === moreInfo + " <i class=\"fal fa-angle-down\"></i>") {
        x.innerHTML = lessInfo + " <i class=\"fal fa-angle-up\"></i>";
    } else {
        x.innerHTML = moreInfo + " <i class=\"fal fa-angle-down\"></i>";
    }
    let elemToCollapse = $("#read-more-link-invoice").prop("hash");
    $(elemToCollapse).collapse('toggle');
    e.preventDefault();
}
