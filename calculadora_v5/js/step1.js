/// <reference path="../home/index.js" />
/// <reference path="../../googlemaphelper.js" />
let geolocation;

function initStep1() {
    $("#butGeolocate").click(geolocate);
    $("#butSearchAddress").click(searchAddress);
    //$("#switch-off-grid").change(onGridChange);
    $(".ongrid-change").click(onGridChange);
    //onGridChange();
}

function showStep1() {
    $("#step-1").show();
}

let componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function onGridChange(e) {
    event.preventDefault();
    let $btn = $(e.currentTarget);
    if ($btn.data("ongrid")) {
        $("#lblConectadoRed").html($btn.html());
        $("#consumptionTypeOnGrid").val(true);
    }
    else {
        $("#lblConectadoRed").html($btn.html());
        $("#consumptionTypeOnGrid").val(false);
    }
    //if ($("#switch-off-grid").is(":checked")) {
    //    $("#consumptionTypeOnGrid").val(true);
    //    $("#lbl-conectado").html("Estoy conectado a la red");
    //}
    //else {
    //    $("#consumptionTypeOnGrid").val(false);
    //    $("#lbl-conectado").html("No estoy conectado a la red");        
    //}
}

function initAddressAutocomplete() {
    let addressAutocomplete = new google.maps.places.Autocomplete(document.getElementById('address-autocomplete'), { types: ['geocode'] });
	addressAutocomplete.setComponentRestrictions({
		country: ["cl"]
	});
    addressAutocomplete.setFields(['address_component', 'geometry']);
    addressAutocomplete.addListener('place_changed', function () {
        fillInAddress(addressAutocomplete.getPlace());
        //goToStep2(false);
    });
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
    let addressElems = [];
    addressElems.push($("#route").val() + " " + $("#street_number").val());
    addressElems.push($("#locality").val());
    addressElems.push($("#administrative_area_level_1").val());
    addressElems.push($("#country").val());
    $("#address-autocomplete").val(addressElems.join(", "));
}


function geolocate() {
    event.preventDefault();
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            SetLatLng(position.coords.latitude, position.coords.longitude);
            setAddress();
        });
    }
}

function searchAddress() {
    event.preventDefault();
    if ($("#address-autocomplete").val() === "") {
        $("#modal-address-incomplete").modal("show");
        return;
    }
    let geocoder = new google.maps.Geocoder();
	console.log('valor autocomplete', $("#address-autocomplete").val())
    geocoder.geocode({ 'address': $("#address-autocomplete").val() }, function (results, status) {
        processGeocodeResponse(results, status);
    });
}

function setAddress() {
    let geocoder = new google.maps.Geocoder();
    geocoder.geocode({ location: geolocation }, function (results, status) {
        processGeocodeResponse(results, status);
    });
}

function processGeocodeResponse(results, status) {
	console.log('result', results)
    if (status === "OK") {
        if (results[0]) {
            fillInAddress(results[0]);
            if (isInApp) {
                goToStep2(false);
            }
            else {
                $("#form-save").submit();
            }
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
    if (isInApp) {
        $("#lat").val(toLocalNumberComplete(lat));
        $("#lng").val(toLocalNumberComplete(lng));
    }
    else {
        $("#lat").val(lat);
        $("#lng").val(lng);
    }
}
