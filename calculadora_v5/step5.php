
<?php 

	$valoresPost = $_REQUEST;
    session_start();
    $paso4 = $_SESSION['step4'];
    $paso3 = $_SESSION['step3'];

    $tipoSistema = $paso3['ConsumptionWizard_ConsumptionTypeOnGrid'] == "true"? 'On-Grid': 'Of-Grid';
    $area = $paso3['ConsumptionWizard_RoofArea'];

    /*
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    die();
    */



    $consumoMensual = $paso4['ConsumptionWizard_ConsumptionPowerPerMonth'];


    $f1_nombre   = isset($_SESSION['f1_nombre'])? $_SESSION['f1_nombre']: '';
    $f1_apellido = isset($_SESSION['f1_apellido'])? $_SESSION['f1_apellido']: '';
    $f1_telefono = isset($_SESSION['f1_telefono'])? $_SESSION['f1_telefono']: '';
    $f1_email    = isset($_SESSION['f1_email'])? $_SESSION['f1_email']: '';

	/*
	echo '<pre>';
		print_r($valoresPost);
	echo '</pre>';
	die();
    */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/bootstrap.min.css"-->
    <link rel="stylesheet" href="styles/bootstrap.min.css">

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/styles.css?v=js-I5em-LpiJQE2ysqEsBxEpEMA6dh-Qt9ieFioOs6w"-->
    <link rel="stylesheet" href="styles/styles.css">

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/theme.css?v=1Po5AOYAWokTbQk4yLaqe-gHKFpGNgBWvdC2gdzXzCs"-->
    <link rel="stylesheet" href="styles/theme.css">

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/all.min.css"-->
    <link rel="stylesheet" href="styles/all.min.css">

    <!--link rel="stylesheet" href="https://www.solarlatam.com/css/noty.css"-->
    <link rel="stylesheet" href="styles/noty.css">

    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css" /-->
    <link rel="stylesheet" href="styles/datepicker.css" />

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
<div class="row">
    <div class="col-lg-8 col-xl-9">
        <section>

            <input type="hidden" id="street_number" data-val="true" data-val-required="Ingrese la numeraci&#xF3;n" name="ConsumptionWizard.StreetNumber" value="1080" />
            <input type="hidden" id="route" data-val="true" data-val-required="Ingrese la calle" name="ConsumptionWizard.Street" value="El Parque" />
            <input type="hidden" id="locality" data-val="true" data-val-required="Ingrese la ciudad" name="ConsumptionWizard.City" value="Santiago" />
            <input type="hidden" id="administrative_area_level_1" data-val="true" data-val-required="Ingrese la provincia" name="ConsumptionWizard.State" value="Regi&#xF3;n Metropolitana" />
            <input type="hidden" id="postal_code" data-val="true" data-val-required="Ingrese el c&#xF3;digo postal" name="ConsumptionWizard.ZipCode" value="" />
            <input type="hidden" id="country" data-val="true" data-val-required="Ingrese el pa&#xED;s" name="ConsumptionWizard.Country" value="Chile" />
            <input type="hidden" id="batteryPrice" data-val="true" data-val-number="The field BatteryPrice must be a number." data-val-required="The BatteryPrice field is required." name="ConsumptionWizard.BatteryPrice" value="0" />
            <form id="form-checkout" method="post" action="step6.php">
                <input type="hidden" id="consumptionWizardId" data-val="true" data-val-required="The ConsumptionWizardId field is required." name="ConsumptionWizard.ConsumptionWizardId" value="683a49ef-d5a3-404d-83f3-dcfc117eb5da" />
                <input type="hidden" id="countries" name="ConsumptionWizard.Countries" value="" />
                <input type="hidden" id="totalPower" name="ConsumptionWizard.TotalKWString" value="5,98" />
                <input type="hidden" id="totalPriceValue" value="9015000,0000" />
                <input type="hidden" id="batteryPrice" value="0" />
                <input type="hidden" id="countryId" value="4" />
                <input type="hidden" id="hdnInterestRate" data-val="true" data-val-number="The field InterestRate must be a number." data-val-required="The InterestRate field is required." name="ConsumptionWizard.Countries.InterestRate" value="0" />
                <input type="hidden" id="hdnFinancedMonths" data-val="true" data-val-required="The FinancedQuotes field is required." name="ConsumptionWizard.Countries.FinancedQuotes" value="3" />
                <input type="hidden" data-val="true" data-val-required="The CountryId field is required." id="ConsumptionWizard_Countries_CountryId" name="ConsumptionWizard.Countries.CountryId" value="4" />
                <input type="hidden" data-val="true" data-val-required="Ingrese el nombre del pipeline en hubspot" id="ConsumptionWizard_Countries_HubspotPipeline" name="ConsumptionWizard.Countries.HubspotPipeline" value="Pipeline Chile" />
                <input type="hidden" data-val="true" data-val-required="Ingrese el precio m&#xE1;xima" id="ConsumptionWizard_Countries_MaxPrice" name="ConsumptionWizard.Countries.MaxPrice" value="500000" />
                <input type="hidden" data-val="true" data-val-required="Ingrese el precio m&#xED;nimo" id="ConsumptionWizard_Countries_MinPrice" name="ConsumptionWizard.Countries.MinPrice" value="20000" />
                <input type="hidden" id="ConsumptionWizard_Countries_Name" name="ConsumptionWizard.Countries.Name" value="Chile" />
                <input type="hidden" id="ConsumptionWizard_Countries_HubspotPipeline" name="ConsumptionWizard.Countries.HubspotPipeline" value="Pipeline Chile" />
                <div class="accordion" id="checkout-accordion">
                    <div class="card">
                        <div class="card-header" id="heading-user"  data-target="#collapse-user" aria-expanded="true" aria-controls="collapse-user">
                            <h3 class="mb-0">
                                <i class="fal fa-w fa-id-card"></i> Datos Personales <i class="fal float-right" style="display:none;" id="user-validation-icon"></i>
                            </h3>
                        </div>
                        <div id="collapse-user" class="collapse show to-validate" aria-labelledby="heading-user" data-parent="#checkout-accordion" data-validation="user-validation" data-result="user-validation-icon">
                            <div class="card-body">

                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Nombre</label>
                                            <input type="text" class="form-control user-validation" data-val="true" data-val-required="Ingresa tu nombre" id="ConsumptionWizard_User_FirstName" name="FirstName" value="<?=$f1_nombre?>">
                                            <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.User.FirstName" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Apellido</label>
                                            <input type="text" class="form-control user-validation" data-val="true" data-val-required="Ingresa tu apellido" id="ConsumptionWizard_User_LastName" name="LastName" value="<?=$f1_apellido?>">
                                            <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.User.LastName" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Email</label>
                                            <input type="email" class="form-control user-validation" data-val="true" data-val-email="Email inv&#xE1;lido" data-val-required="Ingresa tu email" id="ConsumptionWizard_User_Email" name="Email" value="<?=$f1_email?>">
                                            <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.User.Email" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Tel&#xE9;fono</label>
                                            <input type="tel" class="form-control" data-val="true" data-val-required="Ingresa tu tel&#xE9;fono" id="ConsumptionWizard_User_Phone" name="Phone" value="<?=$f1_telefono?>">

                                        </div>
                                    </div>

                                </div>
                                <hr />
                                <!--div class="row">
                                    <div class="col-md-8 mb-3" id="div-discount-apply">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="C&#xF3;digo de Descuento" aria-label="C&#xF3;digo de Descuento" aria-describedby="button-addon2" id="discount-code">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-info" type="button" id="apply-discount-code">Aplicar</button>
                                            </div>
                                        </div>
                                        <small id="invoice-help" class="form-text text-muted">
                                            Ingresar el c&#xF3;digo de referido o descuento
                                        </small>
                                        <small class="text-danger" id="discount-code-invalid" style="display:none;">El c&#xF3;digo ingresado es inv&#xE1;lido</small>
                                    </div>
                                    <div class="col-md-8 mb-3" id="div-discount-applied" style="display:none;">
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="close" id="discount-code-delete" aria-label="Close" data-toggle="tooltip" title="Eliminar c&#xF3;digo de descuento"><span aria-hidden="true">&times;</span></button>
                                            C&#xF3;digo de descuento aplicado: <span id="discount-code-text"></span>
                                        </div>
                                    </div>

                                </div-->
                                <div class="text-right">
                                    <button class="btn btn-primary" type="button" id="continue-personal-data">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="heading-address"  data-target="#collapse-address" aria-expanded="false" aria-controls="collapse-address">
                            <h3 class="mb-0"><i class="fal fa-w fa-map-marker-alt"></i> Direcci&#xF3;n de instalaci&#xF3;n <i class="fal float-right" style="display:none;" id="address-validation-icon"></i></h3>
                        </div>
                        <div id="collapse-address" class="collapse to-validate" aria-labelledby="heading-address" data-parent="#checkout-accordion" data-validation="address-validation" data-result="address-validation-icon">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Calle</label>
                                            <input type="text" class="form-control address-change address-validation" id="address-autocomplete" data-val="true" data-val-required="Ingrese la calle" name="Street" value="">
                                            <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.Street" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Numeraci&#xF3;n</label>
                                            <input type="text" class="form-control address-change address-validation" id="address-streetNumber" data-val="true" data-val-required="Ingrese la numeraci&#xF3;n" name="StreetNumber" value="">
                                            <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.StreetNumber" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Ciudad</label>
                                            <input type="text" class="form-control address-change address-validation" id="address-city" data-val="true" data-val-required="Ingrese la ciudad" name="City" value="">
                                            <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.City" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Provincia/Estado</label>
                                            <input type="text" class="form-control address-change address-validation" id="address-state" data-val="true" data-val-required="Ingrese la provincia" name="State" value="">
                                            <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.State" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Pa&#xED;s</label>
                                            <input type="text" class="form-control address-change address-validation" id="address-country" data-val="true" data-val-required="Ingrese el pa&#xED;s" name="Country" value="Chile">
                                            <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.Country" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                            <!--label for="select-invoice-type">C&#xF3;digo Postal</label-->
                                            <input type="hidden" class="form-control address-validation" id="address-ZipCode" data-val="true" data-val-required="Ingrese el c&#xF3;digo postal" name="ZipCode" value="" />
                                            <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.ZipCode" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="text-right">
                                    <button class="btn btn-primary" type="button" id="continue-address">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading-technical-visit"  data-target="#collapse-technical-visit" aria-expanded="false" aria-controls="collapse-technical-visit">
                            <h3 class="mb-0"><i class="fal fa-cog"></i> Visita t&#xE9;cnica <i class="fal float-right" style="display:none;" id="technical-visit-validation-icon"></i></h3>
                        </div>
                        <div id="collapse-technical-visit" class="collapse to-validate" aria-labelledby="heading-technical-visit" data-parent="#checkout-accordion" data-validation="technical-visit-validation" data-result="technical-visit-validation-icon">
                            <div class="card-body">
                                <p>
                                    El primer paso es concretar la visita t&#xE9;cnica. Confirmar fecha y hora que desea realizar la misma::
                                </p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Fecha</label>
                                            <input type="text" id="technicalVisitDateId" class="form-control technical-visit-validation datepicker" autocomplete="off" value="09/07/2021" onchange="setVisitDate()" data-val="true" data-val-required="Ingrese la fecha para la visita t&#xE9;cnica" name="TechnicalVisitDate">
                                            <small id="invoice-help" class="form-text text-muted ">dd/mm/aaaa</small>
                                            <span id="technicalVisitDateError" class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.TechnicalVisitDate" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="select-invoice-type">Hora</label>
                                            <div>
                                                <select id="technicalVisitTimeId" class="selectpicker show-menu-arrow form-control" data-live-search="true" onchange="setVisitTime()" data-val="true" data-val-required="Ingrese el horario para la visita t&#xE9;cnica" name="TechnicalVisitTime">
                                                    <option value="">Seleccione</option>
                                                    <option value="08:00">08:00 AM a 11:00 AM</option>
                                                    <option value="11:00">11:00 AM a 02:00 PM</option>
                                                    <option value="14:00">02:00 PM a 06:00 PM</option>
                                                </select>
                                            </div>
                                            <span id="technicalVisitTimeError" class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.TechnicalVisitTime" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <input name="__RequestVerificationToken" type="hidden" value="CfDJ8MrlhXhP13BElZQRYKbTyN0fpiCe9yd3JPYC5xLcAamDu1me5Uf9dJNGRWSzk_JOZ_cQ5vSren9E_OIhL35OYfSAOJL9kiA8UDbhqFzdnyaGcnQIPz7dtHxSka9dpDqshOvGp3M-hXS6-cuhkvZ9erWEIFBeG0wvtiPKoCaNDFatDybdcrJHOe4e2__86PPGpg" />
			<input name="form_n" value="second_form" type="hidden">
			
			</form>
            <hr>
        </section>
    </div>
    <input type="hidden" id="investment-benefit" value="0" />
    <input type="hidden" id="battery-price" value="0" />
    <div class="col-lg-4 col-xl-3">
        <aside class="sticky-top">
            <h3>Resumen</h3>
            <input type="hidden" id="hdn-total-price" value="9015000" />
            <div class="address">
                <span class="d-block" id="full-address"></span>
                <small><a href="/es/cl/home/index/683a49ef-d5a3-404d-83f3-dcfc117eb5da">Modificar</a></small>
            </div>
            <hr>
            <dl class="row consume-about no-gutters">
                <dt class="col-7">Superficie</dt> 
                <dd class="col-5 text-right"><a href="#"><?=$area?><span class="area-unit"></span></a></dd>
                <dt class="col-7">Tipo de consumidor</dt>
                <dd class="col-5 text-right">
                    <a data-toggle="tooltip" data-placement="top" title="Conectado a la red" href="#"><?=$tipoSistema?></a>
                </dd>
                <dt class="col-6">Consumo promedio</dt>
                <dd class="col-6 text-right">
                    <span id="range-power-value-aside"><?=$consumoMensual?></span>kWh / mes
                </dd>
            </dl>

            <hr>

            <dl class="row costs no-gutters">
                <dt class="col-7">Sistema Solar de 5,98 kW</dt>
                <dd class="col-5 text-right">$<span id="system-price">9.015.000 </span></dd>
                <dt class="col-7" style="display:none;">Bater&#xED;as <small>0hs de backup</small></dt>
                <dd class="col-5 text-right" style="display:none;">$<span id="battery-price-resume">0</span></dd>
                <dt class="col-7 investment-benefit-resume" style="display:none;">Beneficios de inversi&#xF3;n</dt>
                <dd class="col-5 text-right investment-benefit-resume" style="display:none;">-$<span id="investment-benefit-price">0</span></dd>
            </dl>

            <dl class="row costs no-gutters">
                <dt class="col-7 resume-discount" style="display:none">Descuento <small>Mediante un cup&#xF3;n</small></dt>
                <dd class="col-5 text-right resume-discount" style="display:none">-$<span id="resume-discount-total"></span></dd>

            </dl>
            <hr>
            <ul class="nav nav-tabs justify-content-md-center justify-content-xl-between row no-gutters" id="cash-financed" role="tablist">
                <li class="nav-item col-6 text-center" role="presentation">
                    <a class="nav-link active" id="cash-tab" data-toggle="tab" href="#cash" role="tab" aria-controls="cash"
                       aria-selected="true">Contado</a>
                </li>
                    <li class="nav-item col-6 text-center" role="presentation">
                        <a class="nav-link" id="financed-tab" data-toggle="tab" href="#financed" role="tab" aria-controls="financed" aria-selected="false">Financiado</a>
                    </li>
            </ul>

            <div class="tab-content" id="cash-financed-content">
                <div class="tab-pane fade show active" id="cash" role="tabpanel" aria-labelledby="cash-tab">
                    <dl class="row price no-gutters">
                        <dt class="col-7">Total <small>con IVA</small></dt>
                        <dd class="col-5 text-right" id="total-price-cash">$9.015.000</dd>
                    </dl>
                </div>
                    <div class="tab-pane fade" id="financed" role="tabpanel" aria-labelledby="financed-tab">
                        <dl class="row price no-gutters">
                            <dt class="col-7">3 cuotas</dt>
                            <dd class="col-5 text-right" id="totalPriceQuote">$3.005.000</dd>
                            <dt class="col-7 d-none">Total <small>con IVA</small></dt>
                            <dd class="col-5 text-right d-none" id="total-price-financed">$9.015.000</dd>
                        </dl>
                    </div>
            </div>

            <div id="technicalVisitDiv">
                <hr />
                <h3>Visita t&#xE9;cnica</h3>
                <dl class="row costs no-gutters">

                    <dt class="col-7">Fecha</dt>
                    <dd class="col-5 text-right"><span id="visitaTecnicaDate">09/07/2021</span></dd>
                    <dt class="col-4">Horario  <span></span></dt>
                    <dd class="col-8 text-right"><span id="techincalVisitTime"></span></dd>
                    <dt class="col-7">Costo</dt>
                    <dd class="col-5 text-right">$<span id="visit-price">30.000</span></dd>
                </dl>
            </div>
            <a href="#" class="btn btn-block btn-primary trans" id="butContinueCheckout">Confirmar</a>
            <div class="mt-2">
                <small>
                    Fecha: 08/07/2021. Propuesta válida por 15 días.
                        <br />Tipo de Cambio de la fecha de cotización                </small>
            </div>
        </aside>
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
    <script src="js/datepicker.js"></script>

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
    <script src="js/datepicker.es.js"></script>

    <!--script src="https://www.solarlatam.com/js/globalization.js?v=9L9DZTRwBdACnP6nRDagV_8gJTNr225QlkQrvq-N4vA"></script-->
    <script src="js/globalization.js"></script>

    <!--script src="https://www.solarlatam.com/js/region.js?v=R89xTCrcKoXw4p3vwBrqEISgBkggola3jlQpbtsRlNQ"></script-->
    <script src="js/region.js"></script>

    <script>
        var currentCountry = 'cl';
        var companyName = "Enerlife";
    </script>
    
    <!--script src="https://www.solarlatam.com/js/views/wizard/checkout.js?v=TDdLlHlvqSNfi5EI1kPHBfu6pwSSTk0HLR-3SzzlLyU"></script-->
    <script src="js/checkout.js"></script>

    <!--script src="https://www.solarlatam.com/js/GoogleMapHelper.js?v=9s-jUB0GLtuClZGmv-XVLAxVTveyb7ZLAq3_0HCk_ws"></script-->
    <script src="js/GoogleMapHelper.js"></script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places,geometry&key=AIzaSyBRmaPYAooWQ4CFedveeKZu4Ao85rrgxgg&callback=initAddressAutocomplete"></script>

    <script src="js/enerlife_resources.js?v=22333215647287634"></script>

</body>
</html>


<script>
    function validateFormOnSubmit() {
        let data = $('#form-checkout').serializeArray();
        function sendForm(re) {
            sendDataToAC(data);
            re();
        }
        sendForm(function () {
            alert('Solicitud ingresada correctamente, nos pondremos en contacto');
            $("#modal-user-login").modal("hide");
        });
    }
</script>