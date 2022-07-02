

<?php
    session_start();
	$valoresPost = $_REQUEST;
    $_SESSION["step4"] = $valoresPost;
	
	

    $valor_distribuidora = $valoresPost['valor_distribuidora'];
    $valor_coeficiente = $valoresPost['ConsumptionWizard_Countries_CoeficientConsumption'];
    $valor_consumo_mensual_kw = $valoresPost['ConsumptionWizard_ConsumptionPowerPerMonth'];
    $valor_pago_mensual_pesos = $valoresPost['pago_mensual'];

    $direccion = $_SESSION["fullAddress"];
    $paso3 = $_SESSION['step3'];

    $area = $paso3['ConsumptionWizard_RoofArea'];
    $tipo_producto = $paso3['ConsumptionWizard_ConsumptionTypeOnGrid'] == 'true' ? 'On-Grid': 'Off-Grid';
    $consumoPromedio = $valoresPost['ConsumptionWizard_ConsumptionPowerPerMonth'];


    // VALIDAR SI SE HA CARGADO FORMULARIO PREVIAMENTE
    $f1_nombre   = isset($_SESSION["f1_nombre"])? $_SESSION["f1_nombre"]: '';
    $f1_apellido = isset($_SESSION["f1_apellido"])? $_SESSION["f1_apellido"]: '';
    $f1_telefono = isset($_SESSION["f1_telefono"])? $_SESSION["f1_telefono"]: '';
    $f1_email    = isset($_SESSION["f1_email"])? $_SESSION["f1_email"]: '';

    
    echo '<pre>';
        print_r($_SESSION);
    echo '</pre>';
    die();
    

    // todo pedir datos (primer formulario) ver en solarLatam, configurar api a activecampaing
    // todo revisar los valores en duro
    // todo enviar todo lo relevante al paso 5
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="styles/font-awesome.css" crossorigin="anonymous" referrerpolicy="no-referrer"/-->

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/bootstrap.min.css"-->
    <link rel="stylesheet" href="styles/bootstrap.min.css">

	<!--link rel="stylesheet" href="https://www.solarlatam.com/styles/bootstrap.min.css"-->

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/styles.css?v=js-I5em-LpiJQE2ysqEsBxEpEMA6dh-Qt9ieFioOs6w"-->
    <link rel="stylesheet" href="styles/styles.css">

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/theme.css?v=1Po5AOYAWokTbQk4yLaqe-gHKFpGNgBWvdC2gdzXzCs"-->
    <link rel="stylesheet" href="styles/theme.css">

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/all.min.css"-->
    <link rel="stylesheet" href="styles/all.min.css">

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/noty.css"-->
    <link rel="stylesheet" href="styles/noty.css">

    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css" /-->

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <title>ENERLIFE-CALCULADORA</title>
    <meta property="og:locale" content="es_CL" />
    <meta property="og:title" content="Enerlife | Energía Solar" />
    <meta property="og:url" content="http://enerlife.cl/" />
    <meta property="og:site_name" content="Enerlife | Energía Solar" />
    <meta property="og:image" content="https://enerlife.cl/wp-content/uploads/2020/05/Logo-60x40-1.png" />
    <meta property="og:description" content=" [&hellip;]" />
    <meta property="og:type" content="website" />

    <link rel="icon" href="/img/favicon.png" sizes="150x150" />
    <link rel="apple-touch-icon" href="/img/favicon.png" />
    <meta name="msapplication-TileImage" content="~/img/favicon.png" />

</head>

<body>
    <header>
        <nav id="top-navbar" class="navbar navbar-expand-xl navbar-dark bg-transparent fixed-top trans">
            <a class="navbar-brand" href="#">
                <img src="img/logo_header.png" alt="ENERLIFE" class="img-fluid">
            </a>
        </nav>
    </header>
    <main>
        <div class="background-overlay"></div>
        <div class="container">
        <a class="btn btn-outline-light go-back" href="javascript: history.go(-1)"><i class="fal fa-angle-left"></i> Regresar</a>
        <div class="row" id="select-product-data">
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" type="text/javascript"></script-->
        <script src="js/Chart.min.js" type="text/javascript"></script>

        <form id="form-power-change">
            <input type="hidden" name="Lat" value="-33,4593629" />
            <input type="hidden" name="Lng" value="-70,6577938" />
            <input type="hidden" name="RoofArea" value="67,76" />
            <input type="hidden" name="ProductCategoryId" value="2" />
            <input type="hidden" name="MaxPowerPercentage" value="65" />
            <input type="hidden" name="MaxPowerTarget" value="9,994697215025903186498022956" />
            <input type="hidden" name="ConsumptionPowerPerMonth" value="2145" />
            <input type="hidden" name="PowerPercentageSelected" id="powerPercentageSelected" value="50" />
            <input type="hidden" name="ConsumptionWizardId" id="consumptionWizardId" value="7b14f7f8-200c-4144-b628-384d1d289543" />
            <input type="hidden" name="CurrentAutonomy" id="currentAutonomy" value="0" />
            <input type="hidden" name="AddAutonomy" id="addAutonomy" value="true" />
            <input type="hidden" name="OnGrid" value="True" />
            <input type="hidden" name="CountryId" value="4" />
            <input type="hidden" name="MinOffGridInverterPower" value="0" />
        </form>

        <div class="col-lg-8 col-xl-9">
            <!-- kits -->
            <input type="hidden" id="hdnPrice" data-val="true" data-val-number="The field TotalPrice must be a number." data-val-required="The TotalPrice field is required." name="ConsumptionWizard.TotalPrice" value="10897000,0" />
            <input type="hidden" id="hdnAmortization" data-val="true" data-val-required="The Amortization field is required." name="ConsumptionWizard.InvestmentReturn.Amortization" value="7" />
            <input type="hidden" id="hdnInvestmentReturn" data-val="true" data-val-required="The InvestmentReturn field is required." name="ConsumptionWizard.InvestmentReturn.InvestmentReturn" value="25" />
            <input type="hidden" id="hdnMonthlySave" data-val="true" data-val-required="The MonthlySave field is required." name="ConsumptionWizard.InvestmentReturn.MonthlySave" value="25" />
            <input type="hidden" id="hdnReforestation" data-val="true" data-val-number="The field Reforestation must be a number." data-val-required="The Reforestation field is required." name="ConsumptionWizard.EnviromentalImpact.Reforestation" value="132,562498218052505006790" />
            <input type="hidden" id="hdnCoEmision" data-val="true" data-val-number="The field CoEmision must be a number." data-val-required="The CoEmision field is required." name="ConsumptionWizard.EnviromentalImpact.CoEmision" value="79,5374992489815" />
            <input type="hidden" id="hdnFuel" data-val="true" data-val-number="The field Fuel must be a number." data-val-required="The Fuel field is required." name="ConsumptionWizard.EnviromentalImpact.Fuel" value="48667,5" />
            <input type="hidden" id="hdnInterestRate" data-val="true" data-val-number="The field InterestRate must be a number." data-val-required="The InterestRate field is required." name="ConsumptionWizard.Country.InterestRate" value="0" />
            <input type="hidden" id="hdnFinancedMonths" data-val="true" data-val-required="The FinancedQuotes field is required." name="ConsumptionWizard.Country.FinancedQuotes" value="3" />
            <input type="hidden" id="hdnConsumptionType" data-val="true" data-val-required="The ConsumptionTypeOnGrid field is required." name="ConsumptionWizard.ConsumptionTypeOnGrid" value="True" />
            <input type="hidden" id="hdnElectricityIncrease1" data-val="true" data-val-required="The ElectricityAnnualIncrease1 field is required." name="ConsumptionWizard.Country.ElectricityAnnualIncrease1" value="3" />
            <input type="hidden" id="hdnElectricityIncrease2" data-val="true" data-val-required="The ElectricityAnnualIncrease2 field is required." name="ConsumptionWizard.Country.ElectricityAnnualIncrease2" value="5" />
            <input type="hidden" id="totalFinancedValue" value="10897000,0" />
            <input type="hidden" id="totalPriceValue" value="10897000,0" />
            <input type="hidden" id="hdnInjectionCoeficient" data-val="true" data-val-number="The field InjectionCoeficient must be a number." data-val-required="The InjectionCoeficient field is required." name="ConsumptionWizard.InjectionCoeficient" value="0,5" />
            <input type="hidden" id="hdnInjectionRate" data-val="true" data-val-number="The field InjectionRate must be a number." data-val-required="The InjectionRate field is required." name="ConsumptionWizard.InjectionRate" value="63" />
            <input type="hidden" id="hdnFinalPrice" />
            <input type="hidden" id="hdnTotalKW" name="ConsumptionWizard.TotalKWString" value="7,82" />
            <input type="hidden" id="hdnRoundPriceToThounsands" data-val="true" data-val-required="The RoundPriceToThousands field is required." name="ConsumptionWizard.Country.RoundPriceToThousands" value="True" />
            <input type="hidden" id="hdnDiscountRate" data-val="true" data-val-number="The field DiscountRate must be a number." data-val-required="Ingrese la tasa de descuento" name="ConsumptionWizard.Country.DiscountRate" value="8" />
            <input type="hidden" id="hdnAnnualDegradation" data-val="true" data-val-number="The field AnnualDegradation must be a number." name="ConsumptionWizard.ProductsToQuote.SolarPanel.AnnualDegradation" value="0,5" />
            <input type="hidden" id="hdnPVOut" data-val="true" data-val-required="The PVOut field is required." name="ConsumptionWizard.PVOut" value="1760" />
            <input type="hidden" id="hdnPricePerKW" data-val="true" data-val-number="The field PricePerKW must be a number." data-val-required="The PricePerKW field is required." name="ConsumptionWizard.PricePerKW" value="120,0000" />
            <input type="hidden" id="hdnStep" value="5000" />
            <section>

        <h3>Dise&#xF1;e su sistema solar</h3>

        <form id="form-select-product" method="post" action="step5.php">
            <input type="hidden" data-val="true" data-val-required="The DownloadPDF field is required." id="DownloadPDF" name="DownloadPDF" value="False" />
            <input type="hidden" id="hdnProductCategoryId" data-val="true" data-val-required="The ProductCategoryId field is required." name="ConsumptionWizard.ProductCategoryId" value="2" />
            <input type="hidden" data-val="true" data-val-required="The ConsumptionWizardId field is required." id="ConsumptionWizard_ConsumptionWizardId" name="ConsumptionWizard.ConsumptionWizardId" value="7b14f7f8-200c-4144-b628-384d1d289543" />
            <input type="hidden" id="hdnAutonomy" data-val="true" data-val-number="The field Autonomy must be a number." data-val-required="The Autonomy field is required." name="ConsumptionWizard.Autonomy" value="0" />
            <input type="hidden" id="coeficientConsumption" data-val="true" data-val-number="The field CoeficientConsumption must be a number." data-val-required="Ingrese el coeficiente de consumo" name="ConsumptionWizard.Country.CoeficientConsumption" value="0,99" />
            <input type="hidden" id="range-power-valueMonth" data-val="true" data-val-required="The ConsumptionPowerPerMonth field is required." name="ConsumptionWizard.ConsumptionPowerPerMonth" value="2145" />
            <input type="hidden" id="rateConsumption" data-val="true" data-val-number="The field PricePerKW must be a number." data-val-required="The PricePerKW field is required." name="ConsumptionWizard.PricePerKW" value="120,0000" />
            <input type="hidden" id="maxPowerTarget" data-val="true" data-val-number="The field MaxPowerTarget must be a number." data-val-required="The MaxPowerTarget field is required." name="ConsumptionWizard.MaxPowerTarget" value="9,994697215025903186498022956" />
            <input type="hidden" id="countryId" data-val="true" data-val-required="The CountryId field is required." name="ConsumptionWizard.Country.CountryId" value="4" />
            <input type="hidden" id="totalPrice" name="ConsumptionWizard.SystemPriceString" value="10.897.000" />
            <input type="hidden" id="totalKwVal" data-val="true" data-val-number="The field CheckOutPrice must be a number." name="ConsumptionWizard.CheckOutPrice" value="" />
            <input type="hidden" id="totalKw" data-val="true" data-val-number="The field CheckoutKW must be a number." name="ConsumptionWizard.CheckoutKW" value="" />
            <input type="hidden" data-val="true" data-val-required="The InvestmentBenefit field is required." id="ConsumptionWizard_InvestmentBenefit" name="ConsumptionWizard.InvestmentBenefit" value="0" />
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="range text-center mb-4">
                        <h2>
                            <span id="range-power-value">50</span>% <br>
                            <small class="text-muted">cobertura de energ&#xED;a deseada</small>
                        </h2>
                        <input onchange="powerRangeChange();" type="range" class="custom-range" id="range-power" min="25" max="100" value="50" step="5" data-val="true" data-val-required="The PowerPercentageSelected field is required." name="ConsumptionWizard.PowerPercentageSelected">
                        <p class="text-muted" id="power-target-percentage"><span id="consumption-power-month">1072</span> kWh / mes</p>
                    </div>
                    <!--div role="group" class="btn-group btn-switch d-none d-sm-flex">
                        <button type="button" class="btn btn-category active" id="btn-category-2" data-category="2">Sistema B&#xE1;sico</button>
                        <button type="button" class="btn btn-category " id="btn-category-1" data-category="1">Sistema Premium</button>
                    </div>
                    <div role="group" class="btn-group btn-switch d-flex d-sm-none">
                        <button type="button" class="btn btn-category active" id="btn-category-2" data-category="2">B&#xE1;sico</button>
                        <button type="button" class="btn btn-category " id="btn-category-1" data-category="1">Premium</button>
                    </div-->
                </div>
            </div>

            <div class="row panels-powerbank">
                <div class="col-12 text-center mb-4 mb-md-0">
                    <img src="img/casa-50.jpg" alt="" id="imgHouse" class="img-fluid">
                </div>
                <!--div class="col-sm-6 col-md-4 powerbank text-center d-flex align-items-center justify-content-center" id="powerbank-no">
                    <a href="#" id="show-add-battery" class="btn btn-outline-info">
                        <i class="fal fa-bolt"></i> Agregar bater&#xED;as
                    </a>
                </div-->
                <div class="col-sm-5 col-md-4 powerbank d-none" id="powerbank-yes">
                    <h4 class="text-center">Agrega bater&#xED;as</h4>
                    <div class="row align-items-center">
                        <div class="col-6 col-md-4 offset-md-1 col-xl-4 offset-xl-1 text-center">
                            <!--img src="/img/powerbank.png" class="img-fluid"-->
                        </div>
                        <div class="col-6 col-md-7 col-xl-6 text-center">
                            <h1 style="font-size:1.8rem;">
                                <span id="battery-backup-hour"></span><small>hs</small><br>
                                <small class="text-muted">autonom&#xED;a</small>
                            </h1>
                            <div class="input-group input-group-number input-group-sm mb-2 mb-lg-0 justify-content-center">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-quantity change-battery" id="less-battery" data-quantity="-1" type="button"><i class="fal fa-minus-circle"></i></button>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-quantity change-battery" id="more-battery" data-quantity="1" type="button"><i class="fal fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="read-more">
                <a id="read-more-link-kits" href="#collapse-kits" role="button" aria-expanded="false" aria-controls="collapse-kits" class="toggle-more-text">M&#xE1;s informaci&#xF3;n <i class="fal fa-angle-down"></i></a>
            </div>
            <div class="collapse" id="collapse-kits">
                <div class="more-information">
                    <h3>Sistema Solar de <span class="total-kW">7,82</span> kW</h3>
                    <p>
                        An&#xE1;lisis basado en el consumo indicado de 2145 kWh por mes y la superficie disponible de 67,76 <span class="area-unit"></span>.
                    </p>
                    <div class="alert alert-secondary" role="alert">
                        <h4>La instalaci&#xF3;n incluye</h4>
                        <dl class="row no-gutters mb-0">
                            <dt class="col-9"><span id="solar-panel-quantity">17 paneles solares</span> de <span id="solar-panel-power">460 W</span> <span id="solar-panel-brand">Jinko Solar</span></dt>
                            <dd class="col-3 text-right" id="next-inverters">
                                <a id="solar-panel-data-sheet" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver Data Sheet" class="" href="/es/cl/file/get/ccfc8279-2925-4706-bf89-2248541d000c"><i class="fal fa-paperclip"></i></a>
                            </dd>
                                <dt class="col-9 inverter">
                                        <span>
                                            1 inverter de 8,00 kW
                                        </span>
                                    Voltronic
                                </dt>
                                <dd class="col-3 text-right inverter">
                                </dd>
                            <dt class="col-9 battery-resume" style="display:none;"><span id="battery-quantity"></span> de <span id="battery-power"></span> <span id="battery-brand"></span></dt>
                            <dd class="col-3 text-right battery-resume" style="display:none;">
                                <a id="battery-data-sheet" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver Data Sheet" class="d-none" href="/es/cl/file/get"><i class="fal fa-paperclip"></i></a>
                            </dd>
                                <dt class="col-9 fixed-product">Instalaci&#xF3;n SOLARLATAM</dt>
                                <dd class="col-3 text-right fixed-product">
                                </dd>
                                <dt class="col-9 fixed-product">Ingenier&#xED;a, permisos y log&#xED;stica SOLARLATAM</dt>
                                <dd class="col-3 text-right fixed-product">
                                </dd>
                                <dt class="col-9 fixed-product">Materiales El&#xE9;ctricos SOLARLATAM</dt>
                                <dd class="col-3 text-right fixed-product">
                                </dd>
                        </dl>
                    </div>
                </div>
            </div>
        <input name="__RequestVerificationToken" type="hidden" value="CfDJ8MrlhXhP13BElZQRYKbTyN0sJhPkrXye5req4dU-5KVuYyMs-ZsNqcFDtKjMEKZ-JTClKpgnSDSUa2Y3jCzaap6Blks9pCetdbadkc1tr_qiApXa7MPT9aoXhJbdn3i0GIlqInugfHWzazMuZtMOcY8" /></form>
    </section>
    <!-- /kits -->

    <!-- return of investment -->
    <section>
        <input type="hidden" id="hdnAmortization" value="7" />
        <h3>Retorno de la Inversi&#xF3;n</h3>
        <ul class="row list-unstyled">
            <li class="col-sm-6 col-md-3">
                <div class="pill mb-4 mb-md-0">
                    <h5>$<span id="save25Yearss"></span></h5>
                    <small class="fact">Ahorro en 25 a&#xF1;os</small>
                </div>
            </li>
            <li class="col-sm-6 col-md-3">
                <div class="pill mb-4 mb-md-0">
                    <h5>$<span id="saveMonthly"></span></h5>
                    <small class="fact">Ahorro mensual</small>
                </div>
            </li>
            <li class="col-sm-6 col-md-3">
                <div class="pill mb-4 mb-md-0">
                    <h5><span id="amortizationValue"></span> a&#xF1;os</h5>
                    <small class="fact">Amortizaci&#xF3;n</small>
                </div>
            </li>
            <li class="col-sm-6 col-md-3">
                <div class="pill mb-4 mb-md-0">
                    <h5 id="tir">25 %</h5>
                    <small class="fact">Retorno de Inversi&#xF3;n</small>
                </div>
            </li>
        </ul>
        <div class="read-more">
            <a style="display: none;" id="read-more-link-roi" href="#collapse-roi" role="button"
               aria-expanded="false" aria-controls="collapse-roi" class="toggle-more-text">
                M&#xE1;s informaci&#xF3;n <i class="fal fa-angle-down"></i></a>
        </div>
        <div class="collapse" id="collapse-roi" style="">
            <div class="more-information">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <h4>Ahorro mensual</h4>
                        <canvas id="canvas-month-saving-chart" height="400" readonly></canvas>
                    </div>
                    <div class="col-md-8 text-center">
                        <h4>Ahorro Acumulado</h4>
                        <div class="tab-content" id="long-term-content">
                            <div class="tab-pane fade show active pt-3" id="option-a" role="tabpanel"
                                 aria-labelledby="option-a-tab">
                                <canvas id="myChart2" height="170"></canvas>
                            </div>
                            <div class="tab-pane fade pt-3" id="option-b" role="tabpanel" aria-labelledby="option-b-tab">
                                <canvas id="myChart3" height="170"></canvas>
                            </div>
                        </div>
                        <ul class="nav nav-tabs justify-content-center justify-content-xl-between pb-3"
                            id="long-term" role="tablist">
                            <li class="nav-item">
                                <span class="nav-link">Aumento anual de la electricidad</span>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="option-a-tab" data-toggle="tab" href="#option-a"
                                   role="tab" aria-controls="option-a" onclick="showGraph(true)">
                                    <span id="electricityIncreaseRate1"></span>%
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="option-b-tab" data-toggle="tab" href="#option-b"
                                   role="tab" aria-controls="option-b" aria-selected="false"
                                   onclick="showGraph(false)"><span id="electricityIncreaseRate2"></span>%</a>
                            </li>
                        </ul>
                        <small class="text-left text-info">
                            <i class="fal fa-info-circle"></i>C&#xE1;lculo de ahorro estimado.
                            Realizado con aumentos proyectados de costo de energ&#xED;a.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /return of investment -->


    <!-- impact -->
    <section>
        <h3>Impacto ambiental</h3>
        <ul class="row list-unstyled mb-0">
            <li class="col-sm-6 col-md-4">
                <div class="pill pill-group mb-4 mb-md-0 d-flex align-items-start">
                    <i class="fal fa-trees fa-fw icon"></i>
                    <div class="pill-group-content">
                        <h2 id="reforestationId" class="reforestation-value">133 &#xC1;rboles</h2>
                        <h5>Reforestation</h5>
                        <small class="fact">
                            El ahorro de CO<sub>2</sub> generado es similar a reforestar <span class="reforestation-value"></span> árboles.
                        </small>
                    </div>
                </div>
            </li>
            <li class="col-sm-6 col-md-4">
                <div class="pill pill-group mb-4 mb-md-0 d-flex align-items-start">
                    <i class="fal fa-industry-alt fa-fw icon"></i>
                    <div class="pill-group-content">
                        <h2><span id="coEmision" class="coEmision-value">80</span> tn de C0<sub>2</sub></h2>
                        <h5>Emisiones de CO<sub>2</sub></h5>
                        <small class="fact">
                            El sistema compensará <span class="coEmision-value"></span> toneladas de CO<sub>2</sub> por año
                        </small>
                    </div>
                </div>
            </li>
            <li class="col-sm-6 col-md-4">
                <div class="pill pill-group mb-4 mb-md-0 d-flex align-items-start">
                    <i class="fal fa-gas-pump fa-fw icon"></i>
                    <div class="pill-group-content">
                        <h2><span id="fuel" class="fuel-value">48.668</span> <span class="volume-unit"></span></h2>
                        <h5>Combustible</h5>
                        <small class="fact">
                            El impacto ambiental del sistema equivale a <span class="fuel-value"></span> <span class="volume-unit"></span> de
        combustible por año.
                        </small>
                    </div>
                </div>
            </li>
        </ul>
    </section>
    <!-- /impact -->
</div>

<div class="col-lg-4 col-xl-3">
    <aside class="sticky-top">
        <h3>Resumen</h3>

        <div class="address">
            <span class="d-block"><?=$direccion?></span>
            <small><a href="javascript: history.go(-3)">Modificar</a></small>
        </div>

        <hr>

        <dl class="row consume-about no-gutters">
            <dt class="col-7">Superficie</dt>
            <dd class="col-5 text-right"><a href="javascript: history.go(-2)"><?=$area?><span class="area-unit"></span></a></dd>
            <dt class="col-7">Tipo de consumidor</dt>
            <dd class="col-5 text-right">
                <a data-toggle="tooltip" data-placement="top" title="Conectado de la red" href="javascript: history.go(-3)"><?= $tipo_producto?></a>
            </dd>
            <dt class="col-6">Consumo promedio</dt>
            <dd class="col-6 text-right">
                <a id="consumptionPowerPerMonth" href="#"><span><?= $consumoPromedio ?></span>kWh / mes</a>
            </dd>
        </dl>

        <hr>

        <input type="hidden" id="battery-price" />
        <input type="hidden" id="investment-benefit" value="0" />
        <dl class="row costs no-gutters">
            <dt class="col-7">Sistema Solar de <span class="total-kW">7,82</span>kW</dt>
            <dd class="col-5 text-right">$<span id="system-price">10.897.000</span></dd>
            <dt class="col-7 battery-resume" style="display:none;">Bater&#xED;as <small><span id="autonomy-resume"></span>hs de backup</small></dt>
            <dd class="col-5 text-right battery-resume" style="display:none;">$<span id="battery-price-resume"></span></dd>
            <dt class="col-7 investment-benefit-resume" style="display:none;">Beneficios de inversi&#xF3;n</dt>
            <dd class="col-5 text-right investment-benefit-resume" style="display:none;">-$<span id="investment-benefit-price">0</span></dd>
        </dl>

        <ul class="nav nav-tabs justify-content-md-center justify-content-xl-between row no-gutters" id="cash-financed" role="tablist">
            <li class="nav-item col-6 text-center" role="presentation">
                <a class="nav-link active cashTab" id="cash-tab" data-toggle="tab" href="#cash" role="tab" aria-controls="cash"
                   aria-selected="true">Contado</a>
            </li>
                <li class="nav-item col-6 text-center" role="presentation">
                    <a class="nav-link cashTab" id="financed-tab" data-toggle="tab" href="#financed" role="tab" aria-controls="financed"
                       aria-selected="false">Financiado</a>
                </li>
        </ul>

        <div class="tab-content" id="cash-financed-content">
            <div class="tab-pane fade show active" id="cash" role="tabpanel" aria-labelledby="cash-tab">
                <dl class="row price no-gutters">
                    <dt class="col-7">Total <small>con IVA</small></dt>
                    <dd class="col-5 text-right" id="total-price-cash">10.897.000</dd>
                </dl>
            </div>
                <div class="tab-pane fade" id="financed" role="tabpanel" aria-labelledby="financed-tab">
                    <dl class="row price no-gutters">
                        <dt class="col-7">3 cuotas</dt>
                        <dd class="col-5 text-right" id="totalPriceQuote">3.632.333</dd>
                        <dt class="col-7 d-none">Total <small>con IVA</small></dt>
                        <dd class="col-5 text-right d-none" id="total-price-financed">$10.897.000</dd>
                    </dl>
                </div>
        </div>
        <hr />
        <h3>Visita t&#xE9;cnica</h3>
        <dl class="row costs no-gutters">

            <dt class="col-7">Fecha</dt>
            <dd class="col-5 text-right"><span id="visitaTecnicaDate">- </span></dd>
            <dt class="col-4">Horario  <span></span></dt>
                <dd class="col-8 text-right">-</dd>
            <dt class="col-7 technicalVisitCost">Costo</dt>
            <dd class="col-5 text-right technicalVisitCost">$<span id="visit-price">30.000</span></dd>
        </dl>
        <a href="#" id="butContinueSelectProducts" class="btn btn-block btn-primary trans">Continuar</a>
        <!--a href="#" id="download-pdf" class="btn btn-block btn-primary trans">Descargar propuesta</a-->
        <div class="mt-2">
            <small>
                Fecha: 08/07/2021. Propuesta válida por 15 días.
                    <br />Tipo de Cambio de la fecha de cotización            </small>
        </div>
    </aside>
</div>

</div>

<input type="hidden" id="power-range-changed" value="0" />

<div class="modal fade" id="modal-loading" tabindex="-1" role="dialog" aria-labelledby="modal-loading-label" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <i class="fad fa-spinner fa-spin fa-3x"></i>
                    <h2 class="pt-3">Cargando...</h2>
                </div>
            </div>
        </div>
    </div>
</div>

    
<div class="modal fade" tabindex="-1" role="dialog" id="modal-user-login" data-backdrop="static" data-keyboard="false">
<!--div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"-->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--form method="post" data-ajax-success="registerSuccess" data-ajax="true" data-ajax-failure="showAjaxErrorModal" data-ajax-mode="replace" action="/es/cl/Auth/RegisterClientPartial"-->
            <form id="firstContact" method="post" onsubmit="return false;">
                <div class="modal-header">
                    <h4 class="modal-title">Ingrese sus datos para continuar</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" data-val="true" data-val-required="The ConsumptionWizardId field is required." id="ConsumptionWizardId" name="ConsumptionWizardId" value="7b14f7f8-200c-4144-b628-384d1d289543" />
                    <div class="form-group text-center">
                        <p><a href="#" class="btn btn-outline-infoo" id="open-loginn">Ingrese sus datos</a></p>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label class="form-control-label">Nombre</label>
                        <input type="text" autofocus class="form-control" data-val="true" data-val-required="Ingresa tu nombre" id="FirstName" name="FirstName" value="<?=$f1_nombre?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="FirstName" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Apellido</label>
                        <input type="text" class="form-control" data-val="true" data-val-required="Ingresa tu apellido" id="LastName" name="LastName" value="<?=$f1_apellido?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="LastName" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Email</label>
                        <input type="text" class="form-control" data-val="true" data-val-email="Email inv&#xE1;lido" data-val-required="Ingresa tu email" id="Email" name="Email" value="<?=$f1_email?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Tel&#xE9;fono</label>
                        <input type="text" class="form-control" data-val="true" data-val-required="Ingresa tu tel&#xE9;fono" id="Phone" name="Phone" value="<?=$f1_telefono?>">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Phone" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <!--label class="form-control-label">C&#xF3;digo de referido</label-->
                        <input type="hidden" class="form-control" id="ReferenceCode" name="ReferenceCode" value="">
                    </div>
                </div>
                <div class="modal-footer text-left justify-content-center">
                    <button type="submit" id="butLoginSelectProducts" class="btn btn-primary align-self-center">Aceptar</button>
                    <hr />
                    <p class="text-center"></p>
                </div>
            <input name="__RequestVerificationToken" type="hidden" value="CfDJ8MrlhXhP13BElZQRYKbTyN0sJhPkrXye5req4dU-5KVuYyMs-ZsNqcFDtKjMEKZ-JTClKpgnSDSUa2Y3jCzaap6Blks9pCetdbadkc1tr_qiApXa7MPT9aoXhJbdn3i0GIlqInugfHWzazMuZtMOcY8" />
            <input name="form_n" value="first_form" type="hidden">
            </form>
        </div>
    </div>
</div>



        </div>
    </main>
    <div id="div-general-message"></div>
	


    <!--script src="https://www.solarlatam.com/lib/jquery/dist/jquery.min.js"></script-->
    <script src="js/jquery.min.js"></script>

    <!--script src="https://www.solarlatam.com/js/bootstrap.bundle.min.js"></script-->
    <script src="js/bootstrap.bundle.min.js"></script>

    <!--script src="https://www.solarlatam.com/lib/jquery-unobtrusive-ajax/jquery.unobtrusive-ajax.min.js"></script-->
    <script src="js/jquery.unobtrusive-ajax.min.js"></script>

    <!--script src="https://www.solarlatam.com/lib/jquery-validation/dist/jquery.validate.js"></script-->
    <script src="js/jquery.validate.js"></script>

    <!--script src="https://www.solarlatam.com/lib/jquery-validation-unobtrusive/jquery.validate.unobtrusive.min.js"></script-->
    <script src="js/jquery.validate.unobtrusive.min.js"></script>

    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script-->
    <!--script src="js/datepicker.js"></script-->

    <!--script src="https://www.solarlatam.com/js/site.js?v=DyNrCmo1_5cTVlEYFY8Ml46c7net2naqA5NiTuWO5as"></script-->
    <script src="js/site.js"></script>

    <!--script src="https://www.solarlatam.com/js/site.urls.js?v=WAKX3rytSb4XN20Mg62Y79te84a5BKPTrC610CQK40s"></script-->
    <script src="js/site.urls.js"></script>

    <!--script src="https://www.solarlatam.com/js/ajaxRequest.js?v=UWCm1rtoGroVDhySqnRyLSU31UrprzTqycGbVa3OnIM"></script-->
    <script src="js/ajaxRequest.js"></script>

    <!--script src="https://www.solarlatam.com/js/site.message-control.js?v=4qxikfLevyQmbT1EQtZoEk6B_goQRA4t2Q5QP5RPG7o"></script-->
    <script src="js/site.message-control.js"></script>

    <!--script src="https://www.solarlatam.com/js/localStorageManager.js?v=4t_7JvnBWDeEMpFrVXIFXButM3Totmy-DFi6KadXAYk"></script-->
    <script src="js/localStorageManager.js"></script>

    <!--script src="https://www.solarlatam.com/js/noty.min.js"></script-->
    <script src="js/noty.min.js"></script>

    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" type="text/javascript"></script-->
    <script src="js/Chart.min.js" type="text/javascript"></script>

    <!--script src="https://www.solarlatam.com/js/datepicker.es.js"></script-->


    <!--script src="https://www.solarlatam.com/js/globalization.js?v=9L9DZTRwBdACnP6nRDagV_8gJTNr225QlkQrvq-N4vA"></script-->
    <script src="js/globalization.js"></script>

    <!--script src="https://www.solarlatam.com/js/region.js?v=R89xTCrcKoXw4p3vwBrqEISgBkggola3jlQpbtsRlNQ"></script-->
    <script src="js/region.js"></script>

    <script>
        var currentCountry = 'cl';
        var companyName = "Enerlife";
    </script>
    
    <!--script src="https://www.solarlatam.com/js/views/wizard/selectProducts.js?v=4Srh4XobF7ZLfQdvlcw5x4wZoRvlfGCSGe1sgz9PFlE"></script-->
    <script src="js/selectProducts.js"></script>

    <!--script src="https://www.solarlatam.com/js/finance.js"></script-->
    <script src="js/finance.js"></script>

    <!--script src="https://www.solarlatam.com/js/views/wizard/_InvestmentReturn.js?v=tNM45NC18NiXrNTviSmZ20uknrrJSHxtnYjgg2FbE6c"></script-->
    <script src="js/_InvestmentReturn.js"></script>

    <script src="js/enerlife_resources.js"></script>

    <script>
        $("#firstContact").submit(function(e) {
            e.preventDefault();
            if($('#firstContact').valid()) {
                validateFormOnSubmit();
            }
        });

        function validateFormOnSubmit() {
            let data = $('#firstContact').serializeArray();
            function sendForm(re) {
                sendDataToAC(data);
                re();
            }
            sendForm(function (){
                $("#modal-user-login").modal("hide");
            });
        }
    </script>
    
</body>
</html>
