/// <reference path="../home/index.js" />
/// <reference path="../../googlemaphelper.js" />
let googleMap;
let currentWidth = 0;
function initStep2() {
    $("#changeAddress").click(goToStep1);
    $("#area-input-method").change(areaInputMethodChange);
    $("#txt-area-manual").change(areaChange);
    $(".butSubmit").click(trySubmitForm);
    $("#delete-polygon").click(deletePolygon);
    $("#collapse-aside-button").click(showHideAside);

    currentWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

    if (currentWidth <= 768) {
        showHideAside();
    }

    let resizeTimeout;
    $(window).resize(function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function () {
            let newWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
            if (newWidth > 768 && $("#collapse-aside").is(":hidden")) {
                showHideAside();
            }
            else if (newWidth <= 768 && $("#collapse-aside").is(":visible")) {
                showHideAside();
            }
            currentWidth = newWidth;
        }, 200);
    })
}

function resetStep2() {
    $("#txt-area-manual").val("");
    $("#area-input-method").prop("checked", false);
    if (googleMap) {
        deletePolygon();
    }
}

function showStep2() {
    hideAll();
    googleMap = null;
    $("#step-2").show();

    let roofDemoAlreadyShown = getLocalStorage(localStrageKeys.roofDemoAlreadyShown);

    if ($("#ConsumptionWizardId").val() === '' && !roofDemoAlreadyShown) {
        $('#modal-learn-map').modal("show");
    } else {
        $('#modal-learn-map').modal("show");
	}
    $("#top-navbar").addClass("bg-dark");
    $("#top-navbar").removeClass("bg-transparent");
    setAddressStep2();
    let polygonPoints = [];
    let polygonString = $("#roofPolygonPath").val();
    if (polygonString !== '') {
        polygonPoints = JSON.parse(polygonString);
    }

    let googleLatLngs = [];

    for (i = 0; i < polygonPoints.length; i++) {
        googleLatLngs.push(new google.maps.LatLng({ lat: polygonPoints[i].lat, lng: polygonPoints[i].lng }));
    }

    googleMap = $("#map-container-google").GoogleMap({
        initLat: geolocation.lat,
        initLng: geolocation.lng,
        addInitMarker: false,
        addPolygons: true,
        newAreaCallback: newPolygonArea,
        newPolygonVertex: newPolygonVertex,
        cursor: 'crosshair',
        polygonPoints: googleLatLngs,
        polygonFillColor: '#90cb3A',
        polygonStrokeColor: '#90cb3A',
        mapTypeControl: false,
        fullscreenControl: false
    });

    areaInputMethodChange();
    setLocalStorage(localStrageKeys.roofDemoAlreadyShown, true);
}

function setAddressStep2() {
    $("#address-label").html($("#address-autocomplete").val());
}

function areaChange() {
    let newArea = 0;
    if ($("#area-input-method").prop("checked")) {
        newArea = getFloat($("#txt-area-manual").val());
        newArea = newArea / areaCoeficient;
    }
    else {
        if (googleMap) {
            newArea = googleMap.GetPolygonArea();
        }
    }
    if (isNaN(newArea)) {
        $("#area-input-method").val("");
        $("#roofArea").val(toLocalNumber(0));
    }
    else {
        $("#roofArea").val(toLocalNumber(newArea));
    }
}

function newPolygonArea(area) {
    area = area * areaCoeficient;
    $(".polygonArea").html(toLocalNumber(area));
    areaChange();
}

function newPolygonVertex(polygonVertices) {
    let vertices = [];
    for (i = 0; i < polygonVertices.length; i++) {
        let vertex = polygonVertices.getAt(i);
        vertices.push({ lat: vertex.lat(), lng: vertex.lng() });
    }
    $("#roofPolygonPath").val(JSON.stringify(vertices));
}


function areaInputMethodChange() {
    $("#area-manual").hide();
    $("#area-calculated").css("text-decoration", "");
    $("#roofAreaManualInput").val(false);
    if ($("#area-input-method").prop("checked")) {
        $("#area-manual").show();
        $("#area-calculated").addClass("muted");
        $("#area-calculated").css("text-decoration", "line-through");
        $("#roofAreaManualInput").val(true);
    }
    areaChange();
}

function trySubmitForm() {
    event.preventDefault();
    let area = $("#roofArea").val();
    let areaNumber = getFloat(area);
    if (isNaN(areaNumber) || areaNumber === 0) {
        if (currentCulture === "en-US") {
            alert("Please enter the surface area");
        }
        else {
            alert("Debe ingresar el área");
        }
        return;
    }
    else if (areaNumber < 10) {
        if (currentCulture === "en-US") {
            alert("The surface area must be greater than " + (10 * areaCoeficient).toFixed(2) + " " + (areaAsFt ? 'ft²' : 'm²'));
        }
        else {
            alert("El área debe ser más grande que " + (10 * areaCoeficient).toFixed(2) + " " + (areaAsFt ? 'ft²' : 'm²'));
        }
        return;
    }
    $("#form-save").submit();
}

function deletePolygon() {
    googleMap.deletePolygons();
}


function showHideAside(e) {
    let x = document.getElementById("collapse-aside-button");
    let $icon = $("#collapse-aside-icon");
    if ($icon.hasClass("fa-angle-down")) {
        $icon.removeClass("fa-angle-down");
        $icon.addClass("fa-angle-up");
    }
    else {
        $icon.removeClass("fa-angle-up");
        $icon.addClass("fa-angle-down");
    }
    let elemToCollapse = $("#collapse-aside-button").prop("hash");
    $(elemToCollapse).collapse('toggle');
    $(".showWhenCollapse").toggle();
    if (e) {
        e.preventDefault();
    }
}