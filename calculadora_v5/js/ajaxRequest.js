async function httpGet(url, data, errorCallback) {
    let response;
    await $.get(url, data)
        .done(function (data) {
            response = {
                "success": true,
                "data": data
            };
        })
        .fail((XMLHttpRequest, textStatus, errorThrown) => {
            response = { "success": false };
            if (errorCallback) {
                errorCallback(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    return response;
}


async function httpPost(url, data, errorCallback) {
    let response;
    await $.post(url, data)
        .done(function (result) {
            response = {
                "success": true,
                "data": result
            };
        })
        .fail(function (XMLHttpRequest, textStatus, errorThrown) {
            response = { "success": false };
            if (errorCallback) {
                errorCallback(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    return response;
}