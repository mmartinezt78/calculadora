var localStrageKeys = {
    roofDemoAlreadyShown: "roofDemoAlreadyShown"
}


function setLocalStorage(key, value) {
    localStorage.setItem(key, value);
}

function getLocalStorage(key) {
    return localStorage.getItem(key);
}

function delLocalStorage(key) {
    localStorage.removeItem(key);
}

function clearFilters() {
    let keys = Object.keys(localStorage);
    let i = keys.length;
    while (i--) {
        if (keys[i].indexOf("form-") > -1) {
            delLocalStorage(keys[i]);
        }
    }
}