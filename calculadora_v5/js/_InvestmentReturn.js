//var Finance = require('financejs');
var currencyId = {
    Argentina: "1",
    Uruguay: "2",
    Chileno: "3",
    CostaRica: "4",
    USA: "5"
}
var validGraph = true;

var chartMonthSavings = null;
var chartAccumulatedSavings = null;
var chartAccumulatedSavingsElectricityIncrease2 = null;
var electricityIncreaseRate1 = "1" + decimalSeparator + $("#hdnElectricityIncrease1").val();
var electricityIncreaseRate2 = "1" + decimalSeparator + $("#hdnElectricityIncrease2").val();


var withSolarLatam = "Con " + companyName;
var withoutSolarLatam = "Sin " + companyName;

var savings = "Ahorro";
var expenditure = "Gasto";

var graphTab1 = true;
var monthSavingTotal = 0;
var totalPrice = 0;

$(document).ready(function () {
    totalPrice = $("#totalPriceValue").val();
    $(".cashTab").click(cash_tabChange);
});

function setLanguage() {
    if (currentCulture === "en-US") {
        withSolarLatam = "With " + companyName;
        withoutSolarLatam = "Without " + companyName;
        savings = "Saving";
        expenditure = "Electric Expense";
    }
}

function cash_tabChange() {

    if ($(this).prop('id') === 'cash-tab') {
        totalPrice = getFloat($("#totalPriceValue").val());
    } else {
        totalPrice = getFloat($("#totalFinancedValue").val());
    }
    renderGraphs(true);
}

function investmentReturnInitialize() {
    try {
        setLanguage();
        totalPrice = getFloat($("#totalPriceValue").val());
        $("#electricityIncreaseRate2").html($("#hdnElectricityIncrease2").val());
        $("#electricityIncreaseRate1").html($("#hdnElectricityIncrease1").val());
        renderGraphs(true);
    } catch (err) {
        alert(err);
    }
}

function showGraph(tab1) {
    graphTab1 = tab1;
    renderGraphs(false);
}

async function renderGraphs(reRenderMonthSaving) {
    if (reRenderMonthSaving) {
        monthSavingTotal = makeMonthSavingGraph();
    }

    if (graphTab1) {
        let inflacion = ($("#hdnElectricityIncrease1").val() / 100) + 1;
        makeAccumulatedGraph(monthSavingTotal, inflacion, "myChart2");
    }
    else {
        let inflacion = ($("#hdnElectricityIncrease2").val() / 100) + 1;
        makeAccumulatedGraph(monthSavingTotal, inflacion, "myChart3");
    }
}

function makeMonthSavingGraph() {

    let consumptionPerMonth = $("#range-power-valueMonth").val();
    let rateConsumption = getFloat($("#rateConsumption").val());
    let step = parseInt($("#hdnStep").val());
    let coeficientConsumption = getFloat($("#coeficientConsumption").val());
    let maxPowerTarget = getFloat($("#maxPowerTarget").val());
    let rangePower = getFloat($("#range-power").val());
    let injectionCoeficient = getFloat($("#hdnInjectionCoeficient").val());
    let injectionRate = getFloat($("#hdnInjectionRate").val());
    let systemKW = getFloat($("#hdnTotalKW").val());
    let expensesWithoutSolarLatam = Math.ceil(((consumptionPerMonth * rateConsumption) / coeficientConsumption) / step) * step;
    let roundPriceToThounsands = $("#hdnRoundPriceToThounsands").val() === "True";

    let totalVariable = expensesWithoutSolarLatam * coeficientConsumption;
    //if (roundPriceToThounsands) {
    //    totalVariable = Math.round(totalVariable / 1000) * 1000;
    //}
    let monthSavings = totalVariable * rangePower / 100;
    monthSavings = (monthSavings * (1 - injectionCoeficient)) + (consumptionPerMonth * injectionCoeficient * injectionRate);
    if (roundPriceToThounsands) {
        monthSavings = Math.round(monthSavings / 1000) * 1000;
    }
    if (rangePower !== "100") {
        rangePower = '0.' + rangePower;
        maxPowerTarget = maxPowerTarget * parseFloat(rangePower);
    }
    let expensesWithSolarLatam = expensesWithoutSolarLatam - monthSavings;

    if (chartMonthSavings !== null) {
        chartMonthSavings.destroy();
    }

    $("#saveMonthly").html(toLocalNumberNoDecimals(monthSavings));

    let ctx = document.getElementById('canvas-month-saving-chart').getContext('2d');

    chartMonthSavings = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [withoutSolarLatam, withSolarLatam],
            datasets: [{
                label: expenditure,
                data: [parseFloat(expensesWithoutSolarLatam).toFixed(2), parseFloat(expensesWithSolarLatam).toFixed(2)],
                backgroundColor: [
                    'rgba(240, 73, 62, 0.2)',
                    'rgba(240, 73, 62, 0.2)'
                ],
                borderColor: [
                    'rgba(240, 73, 62, 1)',
                    'rgba(240, 73, 62, 1)'
                ],
                borderWidth: 1
            },
                {
                    //label: 'Dataset 2',
                    label: savings,
                    data: [0, parseFloat(monthSavings).toFixed(2)],

                    backgroundColor: [
                        'rgba(254, 190, 16, 0.2)',
                        'rgba(254, 190, 16, 0.2)',
                    ],
                    borderColor: [
                        'rgba(254, 190, 16, 1)',
                        'rgba(254, 190, 16, 1)',
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            legend: {
                onClick: (e) => e.stopPropagation()
            },
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: true,
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    return monthSavings;
}

function makeAccumulatedGraph(monthSavings, interestRate, chartId) {
    if (chartAccumulatedSavings !== null) {
        chartAccumulatedSavings.destroy();
    }
    let finance = new Finance();
    let discountRate = getFloat($("#hdnDiscountRate").val());
    let totalkW = getFloat($("#hdnTotalKW").val());
    let PVOut = parseInt($("#hdnPVOut").val());
    let energyPerYear = totalkW * PVOut;
    let pricePerKW = getFloat($("#hdnPricePerKW").val());
    let annualDegradation = getFloat($("#hdnAnnualDegradation").val());
    let injectionCoeficient = getFloat($("#hdnInjectionCoeficient").val());
    let injectionRate = getFloat($("#hdnInjectionRate").val());
    let graphCurrencyTotalRate = 1;
    let ctx2 = document.getElementById(chartId).getContext('2d');
    let roundPriceToThounsands = $("#hdnRoundPriceToThounsands").val() === "True";

    //if (totalPrice === 0 || isNaN(totalPrice)) {
    //    totalPrice = getFloat($("#totalPriceValue").val());
    //}
    $("#smallLabelInterest").html($("#hdnElectricityIncrease1").val());
    //totalPrice = parseInt(totalPrice) * electricityIncreaseRate1;

    if (isNaN(totalPrice)) {
        totalPrice = getFloat(totalPrice);
        if (isNaN(totalPrice)) {
            return;
        }
    }

    let total = parseFloat((-(graphCurrencyTotalRate * totalPrice)));

    let totalSavings = total;
    let values = new Array();
    let years = new Array();
    let nominalAnnualSavingList = new Array();
    let setAmortizacion = true;
    let nominalAnnualSavings = 0;

    for (i = 1; i <= 26; i++) {
        if (i > 1) {
            energyPerYear = energyPerYear - (energyPerYear * annualDegradation / 100);
            pricePerKW = pricePerKW * interestRate;
            nominalAnnualSavings = (energyPerYear * pricePerKW * (1 - injectionCoeficient)) + (energyPerYear * injectionCoeficient * injectionRate);
            let annualSavingPresentValue = finance.PV(discountRate, nominalAnnualSavings);
            totalSavings += annualSavingPresentValue;
            values.push(totalSavings);
            nominalAnnualSavingList.push(nominalAnnualSavings);
        }
        else {
            nominalAnnualSavingList.push(total);
            values.push(totalSavings);
        }

        if (totalSavings > 0 && setAmortizacion) {
            $("#amortizationValue").html(i - 1);
            setAmortizacion = false;
        }
    }
    let save25Years = totalSavings;
    if (roundPriceToThounsands) {
        save25Years = Math.round(save25Years / 1000) * 1000;
    }
    $("#save25Years").html(toLocalNumberNoDecimals(save25Years));
    try {
        let tir = finance.IRR({ depth: 1000, cashFlow: nominalAnnualSavingList });
        $("#tir").html(tir + " %");
    }
    catch (err) {

    }

    let year = new Date().getFullYear();
    for (i = 0; i <= 25; i++) {
        years.push((year + i).toString());
    }

    chartAccumulatedSavings = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: years,
            datasets: [{
                label: '',
                data: values,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        let label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ';
                        }
                        label += toLocalNumberNoDecimals((tooltipItem.yLabel * 100) / 100);
                        return label;
                    }
                }
            },
            scales: {
                yAxes: [{
                    stacked: true,
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return '$ ' + toLocalNumberNoDecimals(value);
                        }
                    }
                }]
            }
        }
    });


}

function makeAccumulatedGraphRateIncrease2(monthSavings) {
    if (chartAccumulatedSavingsElectricityIncrease2 !== null) {
        chartAccumulatedSavingsElectricityIncrease2.destroy();
    }
    let graphCurrencytotalRate = 1;
    let ctx2 = document.getElementById('myChart3').getContext('2d');

    let totalPrice = $("#hdnFinalPrice").val();
    $("#smallLabelInterest").html($("#hdnElectricityIncrease2").val());
    totalPrice = parseInt(totalPrice) * electricityIncreaseRate2;

    if (isNaN(totalPrice)) {
        return;
    }

    let total = parseFloat((-(graphCurrencytotalRate * totalPrice)));
    let save25years = (total + (monthSavings * 12 * 25)).toFixed(2).toString();
    let setAmortizacion = true;
    for (i = 1; i <= 26; i++) {
        if (i > 1) {
            totalInterestValue = totalInterestValue + yearSavings;
            yearSavings = yearSavings * interestRate;
        }
        values.push(parseInt(totalInterestValue + yearSavings));

        if (totalInterestValue > 0 && setAmortizacion) {
            $("#amortizationValue").html(i - 1);
            setAmortizacion = false;
        }
    }
    save25years = numberWithCommas(save25years);
    $("#save25Years").html(save25years);

    let values = new Array();
    let years = new Array();

    let totalMonthSavings = monthSavings;
    let totalInterestValue = total;

    for (i = 1; i <= 25; i++) {
        values.push(parseInt(totalInterestValue + (totalMonthSavings * (12 * i))));

        // totalInterestValue = totalInterestValue * electricityIncreaseRate2;
        totalMonthSavings = totalMonthSavings * electricityIncreaseRate2;
    }

    let year = new Date().getFullYear();
    for (i = 0; i < 25; i += 1) {
        years.push((year + i).toString());

    }
    years.push((year + 25).toString());
    var amortization = closestZero(total, monthSavings);

    $("#amortizationValue").html(amortization);

    chartAccumulatedSavingsElectricityIncrease2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: years,
            datasets: [{
                label: '',
                data: values,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        let label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ';
                        }
                        label += toLocalNumberNoDecimals((tooltipItem.yLabel * 100) / 100);
                        return label;
                    }
                }
            },
            scales: {
                yAxes: [{
                    stacked: true,
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return '$ ' + toLocalNumberNoDecimals(value);
                        }
                    }
                }]
            }
        }
    });


}


function numberWithCommas(value) {
    var parts = value.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
