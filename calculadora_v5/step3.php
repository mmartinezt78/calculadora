

<?php 

	$valoresPost = $_REQUEST;
    session_start();
    $_SESSION["step3"] = $valoresPost;

    /*
    echo '<pre>';
	print_r($valoresPost);
    print_r($_SESSION);
	echo '</pre>';
	die();
    */

    $areaSeleccionada = $valoresPost['ConsumptionWizard_RoofArea'];
    $onGrid = $valoresPost['ConsumptionWizard_ConsumptionTypeOnGrid'];
	
	$StreetNumber = $valoresPost['ConsumptionWizard_StreetNumber'];
	$Street = $valoresPost['ConsumptionWizard_Street'];
	$City = $valoresPost['ConsumptionWizard_City'];
	$State = $valoresPost['ConsumptionWizard_State'];
	$CountryName = $valoresPost['ConsumptionWizard_Country'];
	
	$calleNumero = '';
	if ($Street != '' && $StreetNumber != '') {
		$calleNumero = $Street." ".$StreetNumber.", ";
	}
	
	$cityWithComa = '';
	if($City != '') {
		$cityWithComa = $City.", ";
	}
	
	$StateWithComa = '';
	if ($State != '') {
		$StateWithComa = $State.", ";
	}
	
	$fullAddress = $calleNumero.$cityWithComa.$StateWithComa.$CountryName;
    $_SESSION["fullAddress"] = $fullAddress;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/theme.css">
    <link rel="stylesheet" href="styles/all.min.css">
    <link rel="stylesheet" href="styles/noty.css">
    
	<!--
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	-->
	<!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /-->
	<link rel="stylesheet" href="styles/font-awesome.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <a class="navbar-brand" href="">
            <img src="img/logo_header.png" alt="ENERLIFE" class="img-fluid">
        </a>
    </nav>
</header>


    <main>
        <div class="background-overlay"></div>
        <div class="container">
            <!--a class="btn btn-outline-light go-back" id="butBackOnGrid" href="/es/cl/home/index/93a7b96d-ec00-4358-af6f-e8d1406673b6?step=2"><i class="fa fa-angle-left"></i> Regresar</a-->
            <a class="btn btn-outline-light go-back" href="javascript: history.go(-1)"><i class="fa fa-angle-left"></i> Regresar</a>
<form method="post" enctype="multipart/form-data" action="step4.php">
    <input type="hidden" data-val="true" data-val-required="The ConsumptionWizardId field is required." id="ConsumptionWizard_ConsumptionWizardId" name="ConsumptionWizard.ConsumptionWizardId" value="93a7b96d-ec00-4358-af6f-e8d1406673b6" />
    <input type="hidden" id="rateConsumptionPrice" data-val="true" data-val-number="The field RateConsumptionPrice must be a number." data-val-required="Ingrese el precio" name="ConsumptionWizard.Countries.RateConsumptionPrice" value="120,0000" />
    <input type="hidden" id="coeficientConsumption" data-val="true" data-val-number="The field CoeficientConsumption must be a number." data-val-required="Ingrese el coeficiente de consumo" name="ConsumptionWizard.Countries.CoeficientConsumption" value="0,99" />
    <input type="hidden" data-val="true" data-val-required="Ingrese el precio m&#xE1;xima" id="ConsumptionWizard_Countries_MaxPrice" name="ConsumptionWizard.Countries.MaxPrice" value="500000" />
    <input type="hidden" id="range-power-value" data-val="true" data-val-required="The ConsumptionPowerPerMonth field is required." name="ConsumptionWizard.ConsumptionPowerPerMonth" value="2145" />
    <input type="hidden" id="pricePerKwVal" data-val="true" data-val-number="The field PricePerKW must be a number." data-val-required="Ingrese la tarifa por kW/h" name="ConsumptionWizard.PricePerKW" value="155,0000" />
    <div class="row">
        <div class="col-lg-8 col-xl-9">
            <section>
                <h3><strong>Ingresa tu gasto mensual en electricidad</strong></h3>
                <p>
                    Para dise&#xF1;ar el sistema solar, indique el consumo el&#xE9;ctrico a cubrir.<br>
                    Este dato se puede encontrar en su boleta el&#xE9;ctrica.
                    <!--span style="cursor: pointer;" class="text-primary" data-toggle="popover" data-trigger="focus" tabindex="0" data-html="true" data-placement="bottom" data-content="<img src='/es/ar/file/get/7e3fd8d9-41b3-461e-abb9-bc447bac0f8b' class='img-fluid'>">
                        ver ejemplo aqu&#xED;
                    </span-->
                </p>

                <div class="row align-items-stretch mb-4">
                    <div class="col-md-6 offset-md-3">
                        <div class="range text-center mb-4">
                            <h2>
                                <span id="powerPrice"></span> / mes
                            </h2>
                            <input type="range" data-val="true" name ="pago_mensual" class="custom-range" id="range-price" min="20000" max="350000" autofocus step="5000" value="80000">
                            <h2 style="display:none;">
                                <span id="powerLabel">2145</span>
                                <small class="text-muted">kWh / mes</small>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="read-more">
                    <a id="read-more-link-invoice" href="#collapse-invoice" role="button" aria-expanded="false" aria-controls="collapse-invoice" class="toggle-more-text swapText">M&#xE1;s informaci&#xF3;n <i class="fa fa-angle-down"></i></a>
                </div>
                <div class="collapse" id="collapse-invoice" style="">
                    <div class="more-information">
                        <div class="row align-items-center">
                            <div class="col-md-6  mb-4">
                                <div class="form-label-group">
                                    <label for="select-invoice-type">Selecci&oacute;n de distribuidora</label>
									<select data-val="true" name="valor_distribuidora" class="form-control" onchange="actValorKw(this)" type="text" >
										<option value="155">ENEL</option>
										<option value="163">CHILQUINTA</option>
										<option value="168">CGE</option>
										<option value="163">SAESA</option>
										<option value="165">FRONTEL</option>
										<option value="160">COPELEC</option>
										<option value="160">OTRA</option>
                                    </select>
                                    <input data-val="true" class="form-control" placeholder="Tarifa $ x kW/h" id="PricePerKw" onchange="rangePowerChanged()" type="hidden" name="ConsumptionWizard.PricePerKWString" value="155,000">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="ConsumptionWizard.PricePerKW" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <!--div class="col-md-6 mb-4">
                                <div class="add-invoice ">
                                    <div class="attach-file">
                                        <a href="#" class="btn btn-outline-info mb-2" id="but-add-file">
                                            <i class="fa fa-paperclip"></i>Adjuntar factura
                                        </a>
                                        <small class="text-muted d-block">Paso opcional</small>
                                        <input data-val="true" type="file" id="add-file" accept="image/*, .pdf" hidden name="ConsumptionWizard.InvoiceFile" />
                                        <input data-val="true" type="hidden" id="invoice-file-id" name="ConsumptionWizard.InvoiceFileId" value="" />
                                        <div id="file-attached" style="display:none;">
                                            <span id="file-name"></span>
                                            <a href="#" id="but-delete-file" class="text-danger"><i class="fa fa-trash-alt"></i></a>
                                        </div>
                                    </div>

                                    <div class="info small">
                                        <i class="fa fa-info-circle"></i> Soporta .pdf, .jpg, .png hasta 5MB
                                    </div>
                                </div>
                            </div-->
                        </div>
                    </div>
                </div>

            </section>

        </div>
        <div class="col-lg-4 col-xl-3">
            <aside class="sticky-top">
                <h3>Resumen</h3>

                <div class="address">
                    <span class="d-block"><?=$fullAddress?></span>
                    <!--small><a href="/es/cl/home/index/93a7b96d-ec00-4358-af6f-e8d1406673b6">Modificar</a></small-->
                    <small><a href="index.html">Modificar</a></small>
                </div>

                <hr>

                <dl class="row consume-about no-gutters">
                    <dt class="col-7">Superficie</dt>
                    <!--dd class="col-5 text-right"><a href="/es/cl/home/index/93a7b96d-ec00-4358-af6f-e8d1406673b6?step=2">15,00<span class="area-unit"></span></a></dd-->
                    <dd class="col-5 text-right"><a><?=$areaSeleccionada?></span></a></dd>
                    <dt class="col-7">Tipo de consumidor</dt>
                    <dd class="col-5 text-right">
                        <!--a data-toggle="tooltip" data-placement="top" title="Conectado a la red" href="/es/cl/home/index/93a7b96d-ec00-4358-af6f-e8d1406673b6">On-Grid</a-->
						<a data-toggle="tooltip" data-placement="top"> <?=$onGrid == 'true'? 'OnGrid':'OffGrid' ?></a>
                    </dd>
                    <dt class="col-6">Consumo promedio</dt>
                    <dd class="col-6 text-right">
                        <span id="range-power-value-aside"></span>kWh / mes
                    </dd>
                </dl>
                <button type="submit" class="btn btn-block btn-primary trans" id="butContinueOnGrid">Continuar</button>
            </aside>
        </div>
    </div>
    <input name="__RequestVerificationToken" type="hidden" value="CfDJ8MrlhXhP13BElZQRYKbTyN3mu46qB_NtVWjr-H3eozIBDAvzdlZvO32OYDR_8hjt54IsgZFheAO_yXVQ8KEklzAYupSsUF9HjmzI0GPveQX3-kFyfMi5a6NRfypzJR0v1lBdzNRkPuQo0PR1pvOQFgU" />

</form>

<style type="text/css">
    .popover {
        max-width: 800px;
    }
</style>


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

    <!--script src="https://www.solarlatam.com/js/datepicker.es.js"></script-->
    <!--script src="js/datepicker.es.js"></script-->

	<!--script src="https://www.solarlatam.com/js/globalization.js?v=9L9DZTRwBdACnP6nRDagV_8gJTNr225QlkQrvq-N4vA"></script-->
    <script src="js/globalization.js"></script>

	<!--script src="https://www.solarlatam.com/js/region.js?v=R89xTCrcKoXw4p3vwBrqEISgBkggola3jlQpbtsRlNQ"></script-->
    <script src="js/region.js"></script>

	<!--script src="https://app.solarlatam.com/js/views/wizard/consumptionTypeOnGrid.js?v=FzNomyZ_m98XdjEWkn0X4rbyDzs7nPYYtn-RgETMFhc"></script-->
    <script src="js/consumptionTypeOnGrid.js"></script>
	
    <script>
        var currentCountry = 'cl';
        var companyName = "Enerlife";
		
		function actValorKw(v) {
			$('#PricePerKw').val($(v).val());
            rangePowerChanged();
		}
    </script>
   
    
</body>
</html>
