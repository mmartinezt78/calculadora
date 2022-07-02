function showError(error) {
    alert(error);
    //new Noty({
    //    text: error,
    //    type: 'error',
    //    timeout: false
    //}).show();
}

function showMErrorModal(error) {
    alert(error);
    //let noty = new Noty({
    //    text: error,
    //    type: 'alert',
    //    layout: 'center',
    //    modal: true,
    //    animation: {
    //        open: 'animated fadeIn', // Animate.css class names
    //        close: null

    //    },
    //    buttons: [
    //        Noty.button('Aceptar', 'btn btn-gradient-01', function () { noty.close(); })
    //    ]
    //}).show();
}

function showAjaxError(XMLHttpRequest, textStatus, errorThrown) {
    alert(XMLHttpRequest.responseText);
    //new Noty({
    //    text: error,
    //    type: 'error',
    //    timeout: false
    //}).show();
}

function showAjaxErrorModal(XMLHttpRequest, textStatus, errorThrown) {
    alert(XMLHttpRequest.responseText);
    //let noty = new Noty({
    //    text: error,
    //    type: 'alert',
    //    layout: 'center',
    //    modal: true,
    //    animation: {
    //        open: 'animated fadeIn', // Animate.css class names
    //        close: null

    //    },
    //    buttons: [
    //        Noty.button('Aceptar', 'btn btn-gradient-01', function () { noty.close(); })
    //    ]
    //}).show();
}