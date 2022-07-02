var currentCulture = 'es-AR';
var decimalSeparator = ',';
var groupSeparator = '.';

var areaUnitFt = "ft<sup>2</sup>";
var areaUnitPlaceholderFt = "ft2";
var volumeUnitGal = "galones";

var areaUnitM = "m<sup>2</sup>";
var areaUnitPlaceholderM = "m2";
var volumeUnitL = "litros";

var fechaNoPuedeSerMenorAHoy = 'La fecha no puede ser menor a hoy';
var horarioNoPuedeSerMenorAHoy = 'El horario no puede ser menor a la hora actual';


function getDateFromString(dateString) {
    let dd = dateString.split("/")[0].padStart(2, "0");
    let mm = dateString.split("/")[1].padStart(2, "0");
    let yyyy = dateString.split("/")[2].split(" ")[0];
    mm = (parseInt(mm) - 1).toString(); // January is 0
    return new Date(yyyy, mm, dd);
}