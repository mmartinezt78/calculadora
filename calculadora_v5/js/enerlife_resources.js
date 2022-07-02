
function sendDataToAC(data) {

    function prepararDat(lre) {
        console.log('FormData', data);
        let frm = "";
        let nombre, apellido, email, telefono = "";
        let calle, numeroCalle, ciudad, region, pais, codigoPostal, fechaVisitaTecnica, horaVisitaTecnica = "";
        $.each(data, function (i, elem) {
            if(elem.name === "FirstName") {
                nombre = elem.value;
            } else if(elem.name === "LastName") {
                apellido = elem.value;
            } else if(elem.name === "Email") {
                email = elem.value;
            } else if(elem.name === "Phone") {
                telefono = elem.value;
            } else if (elem.name === "Street") {
                calle = elem.value;
            } else if (elem.name === "StreetNumber") {
                numeroCalle = elem.value;
            } else if (elem.name === "City") {
                ciudad = elem.value;
            } else if (elem.name === "State") {
                region = elem.value;
            } else if (elem.name === "Country") {
                pais = elem.value;
            } else if (elem.name === "ZipCode") {
                codigoPostal = elem.value;
            } else if (elem.name === "TechnicalVisitDate") {
                fechaVisitaTecnica = elem.value;
            } else if (elem.name === "TechnicalVisitTime") {
                horaVisitaTecnica = elem.value;
            } else if (elem.name === "form_n") {
                frm = elem.value;
            }
        });
        lre(nombre, apellido, email, telefono, calle, numeroCalle, ciudad,
            region, pais, codigoPostal, fechaVisitaTecnica, horaVisitaTecnica, frm);
    }

    prepararDat(function (nombre, apellido, email, telefono, calle, numeroCalle, ciudad,
                          region, pais, codigoPostal, fechaVisitaTecnica, horaVisitaTecnica, frm) {
        $.ajax({
            // url: 'https://enerlife.api-us1.com/api/3/contact/sync',
            url: 'core/api/motodos.php',
            type: 'post',
            data: {
                "action"    : "ctac",
                "email"     : email,
                "firstName" : nombre,
                "lastName"  : apellido,
                "phone"     : telefono,
                "calle"              : calle,
                "ciudad"             : ciudad,
                "region"             : region,
                "pais"               : pais,
                "numeroCalle"        : numeroCalle,
                "codigoPostal"       : codigoPostal,
                "fechaVisitaTecnica" : fechaVisitaTecnica,
                "horaVisitaTecnica"  : horaVisitaTecnica,
                "frm"  : frm
                /*
                 "contact": {
                    "email": email,
                    "firstName": nombre,
                    "lastName": apellido,
                    "phone": telefono,
                    "fieldValues":[
                        {
                            "field":"5",
                            "value":"calc.v3"
                        }, {
                            "field":"6",
                            "value":"On-Grid"
                        }, {
                            "field":"7",
                            "value":"20"
                        }
                    ]
                }
                */
            },
            /*
            headers: {
                "Api-Token": "628a6254a955256654552ed1c2fd43bf2612749778e53c5bfe1b3274ad816d03b3779909"
            },
            */
            // dataType: 'json',
            success: function (data) {
                jsonResponse = JSON.parse(data);
                if(jsonResponse.status == "SUCCESS") {
                    console.info(jsonResponse);
                    console.log('Formulario guardado correctamente');
                }
            }, error: function (data) {
                console.log("error", data);
            }, complete: function () {
                console.log(':::::::PROCESAMIENTO DE FORMULARIO TERMINADO:::::::');
            }
        });
    });

}