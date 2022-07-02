

<?php 


	$valoresUrl = $_GET;
	
	$Lat = $valoresUrl['Lat'];
	$Lng = $valoresUrl['Lng'];
	$StreetNumber = $valoresUrl['StreetNumber'];
	$Street = $valoresUrl['Street'];
	$City = $valoresUrl['City'];
	$State = $valoresUrl['State'];
	$ZipCode = $valoresUrl['ZipCode'];
	$CountryName = $valoresUrl['CountryName'];
	$ConsumptionTypeOnGrid = $valoresUrl['ConsumptionTypeOnGrid'];
	$Step = $valoresUrl['Step'];
	$addressSetted = $valoresUrl['addressSetted'];
	
	$calleNumero = '';
	if ($Street != '' && $StreetNumber != '') {
		$calleNumero = $Street." ".$StreetNumber.", ";
	}
	
	$cityWithComa = '';
	if($City != ''){
		$cityWithComa = $City.", ";
	}
	
	$StateWithComa = '';
	if ($State != '') {
		$StateWithComa = $State.", ";
	}
	
	$fullAddress = $calleNumero.$cityWithComa.$StateWithComa.$CountryName;

	
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
	
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
			<div style="height: 80vh;" class="row search-form justify-content-center align-items-center" id="step-1">
				<div class="col-lg-8 ">
					<div class="card">
						<div class="card-body">
							<div class="heading">
								<h1>Comenzar Cotizaci&#xF3;n</h1>
							</div>
							<div class="row">
								<div class="col-md-8 pr-md-0">
									<label class="small sr-only">Comenzar Cotizaci&#xF3;n</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fal fa-map-marker-alt"></i></span>
										</div>
										<input type="text" class="form-control location-search-input" placeholder="Ingrese su direcci&#xF3;n" id="address-autocomplete" name="ConsumptionWizard.FullAddress" value="<?=$fullAddress?>">
										<div class="input-group-append">
											<button class="btn btn-light dropdown-toggle" id="lblConectadoRed" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conectado a la red</button>
											<div class="dropdown-menu" style="">
												<a class="dropdown-item ongrid-change" data-ongrid="true" href="#">Conectado a la red</a>
												<a class="dropdown-item ongrid-change" data-ongrid="false" href="#">Desconectado de la red</a>
											</div>
										</div>
									</div>
								</div>
								<div role="group" class="col-md-4 btn-group d-flex">
									<button type="button" class="flex-grow-1 btn btn-primary" id="butSearchAddress">Comenzar</button>
									<button type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Utilizar mi ubicaci&#xF3;n" class="btn btn-primary" id="butGeolocate"><i class=" fas fa-location-arrow"></i></button>
								</div>
							</div>
							<div class="heading">
								<p>Al hacer click en comenzar se están aceptando los <a href="#" data-toggle="modal" data-target="#modal-terms-conditions" style="color:whitesmoke">términos y condiciones</a></p>
							</div>
						</div>

					</div>
				</div>
				<div class="modal fade" id="modal-address-incomplete" tabindex="-1" role="dialog" aria-labelledby="modal-address-incomplete-label">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<p>
									Para continuar ten&#xE9;s que ingresar la direcci&#xF3;n
								</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="modal-terms-conditions" tabindex="-1" role="dialog" aria-labelledby="modal-terms-conditions-label">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<h1 style="color:black"> Terminos y condiciones</h1>
								<hr>
								1.- Terminos y condiciones de enerlife....
								<br>
								2.- Terminos y condiciones de enerlife....
								<br>
								3.- Terminos y condiciones de enerlife....
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row" id="step-2" style="display:none;">
				<div style="width:100%;">
					<div id="map-container-google" class="z-depth-1-half map-container" style="height: calc(100vh - 66px);position: absolute;top: 66px;left: 0;right: 0;bottom: 0;"></div>
					<div class="col-lg-4 col-xl-3 offset-lg-8 offset-xl-8">
						<aside class="sticky-top">
							<form id="form-save" method="post" action="step3.php">
								<input type="hidden" id="ConsumptionWizardId" name="ConsumptionWizard.ConsumptionWizardId" value="" />
								<input type="hidden" id="lat" value="<?=$Lat?>" data-val="true" data-val-number="The field Lat must be a number." data-val-required="The Lat field is required." name="ConsumptionWizard.Lat" />
								<input type="hidden" id="lng" value="<?=$Lng?>" data-val="true" data-val-number="The field Lng must be a number." data-val-required="The Lng field is required." name="ConsumptionWizard.Lng" />
								<input type="hidden" id="street_number" name="ConsumptionWizard.StreetNumber" value="<?=$StreetNumber?>" />
								<input type="hidden" id="route" name="ConsumptionWizard.Street" value="<?=$Street?>" />
								<input type="hidden" id="locality" name="ConsumptionWizard.City" value="<?=$City?>" />
								<input type="hidden" id="administrative_area_level_1" name="ConsumptionWizard.State" value="<?=$State?>" />
								<input type="hidden" id="postal_code" name="ConsumptionWizard.ZipCode" value="<?=$ZipCode?>" />
								<input type="hidden" id="country" name="ConsumptionWizard.Country" value="<?=$CountryName?>" />
								<input type="hidden" id="roofPolygonPath" name="ConsumptionWizard.RoofPolygonPath" value="" />
								<input type="hidden" id="roofArea" data-val="true" data-val-number="The field RoofArea must be a number." data-val-required="The RoofArea field is required." name="ConsumptionWizard.RoofArea" value="0" />
								<input type="hidden" id="roofAreaManualInput" data-val="true" data-val-required="The RoofAreaManualInput field is required." name="ConsumptionWizard.RoofAreaManualInput" value="False" />
								<input type="hidden" id="consumptionTypeOnGrid" value="<?=$ConsumptionTypeOnGrid?>" data-val="<?=$ConsumptionTypeOnGrid?>" data-val-required="The ConsumptionTypeOnGrid field is required." name="ConsumptionWizard.ConsumptionTypeOnGrid" />
								<input name="__RequestVerificationToken" type="hidden" value="CfDJ8MrlhXhP13BElZQRYKbTyN1zKP0XIoI55GZc8mqPJhOPO55FTkigjVrppIOzaNYR8Nd4TktD7Q8Hb1A5n9n8l5LjAeNk1KOx07W89JeGLqBmuv5suLTYLsRONQ9x-9c0ogaCQLLGTjkobr7kQGOX7Xk" /></form>
							<h3 class="d-none d-md-block mb-0">Resumen</h3>
							<div class="d-flex justify-content-between align-items-center d-md-none">
								<h3 class="mb-0">
									<a id="collapse-aside-button" href="#collapse-aside" role="button" aria-expanded="false" aria-controls="collapse-map" class="collapsed">
										Resumen <i id="collapse-aside-icon" class="fal fa-angle-up"></i>
									</a>
								</h3>
								<div class="showWhenCollapse text-center" style="display:none; line-height:1;">
									<span class="polygonArea">0.00</span><span class="area-unit"></span><br />
									<small class="text-muted">Superficie</small>
								</div>
								<a href="#" class="btn btn-primary trans butSubmit showWhenCollapse btn-xs-collapse" style="display:none;"><i class="fa fa-chevron-right"></i></a>
							</div>

							<div class="collapse show mt-4" id="collapse-aside">
								<div class="address">
									<span class="d-block" id="address-label"></span>
									<small><a href="#" id="changeAddress">Modificar</a></small>
								</div>

								<hr>

								<dl class="row consume-about no-gutters" id="area-calculated">
									<dt class="col-7">
										Superficie
										<small><a href="#" id="delete-polygon">Volver a comenzar</a></small>
									</dt>
									<dd class="col-5 text-right"><span class="polygonArea">0.00</span><span class="area-unit"></span></dd>
								</dl>

								<hr>

								<div class="custom-control custom-switch mb-2">
									<input type="checkbox" class="custom-control-input" id="area-input-method" >
									<label class="custom-control-label" for="area-input-method" style="color:unset;">Ingresar manualmente</label>
								</div>

								<div class="form-label-group mb-4" id="area-manual" style="display:none;">
									<label for="select-invoice-type" id="area-manual-label" class="sr-only">Superficie en</label>

									<input class="form-control" placeholder="Superficie en" id="txt-area-manual" type="text" data-val="true" data-val-number="The field RoofArea must be a number." data-val-required="The RoofArea field is required." name="ConsumptionWizard.RoofArea" value="0">
								</div>
								<a href="#" class="btn btn-block btn-primary trans butSubmit" style="background:#90cb3A; border-color: #90cb3A;" id="butContinueHomeStep2">Continuar</a>
							</div>
						</aside>



						<div id="modal-learn-map" class="modal text-center" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-body">
										<h3>Marca tu techo sobre el mapa</h3>
										<p>Marca punto a punto toda la superficie disponible de tu techo.</p>
										<img src="img/roof.gif" alt="" class="img-fluid">

									</div>
									<div class="modal-footer justify-content-center">
										<button type="button" class="btn btn-primary" data-dismiss="modal" id="butTutorialAccept">&#xA1;Entendido!</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" data-val="true" data-val-required="The Step field is required." id="Step" name="Step" value="2" />
        </div>
    </main>
    <div id="div-general-message"></div>


	<!--script src="https://www.solarlatam.com/lib/jquery/dist/jquery.min.js"></script-->
	<script src="js/jquery.min.js"></script>
    <!--script src="https://www.solarlatam.com/js/bootstrap.bundle.min.js"></script-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.unobtrusive-ajax.min.js"></script>
    <!--script src="https://www.solarlatam.com/lib/jquery-validation/dist/jquery.validate.js"></script-->
    <script src="js/jquery.validate.js"></script>
    <script src="js/jquery.validate.unobtrusive.min.js"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script-->
    <script src="js/datepicker.js"></script>
    <!--script src="https://www.solarlatam.com/js/site.js?v=DyNrCmo1_5cTVlEYFY8Ml46c7net2naqA5NiTuWO5as"></script-->
    <script src="js/site.js"></script>
    <script src="js/site.urls.js"></script>
    <!--script src="https://www.solarlatam.com/js/ajaxRequest.js?v=UWCm1rtoGroVDhySqnRyLSU31UrprzTqycGbVa3OnIM"></script-->
    <script src="js/ajaxRequest.js"></script>
    <script src="js/site.message-control.js"></script>
    <!--script src="https://www.solarlatam.com/js/localStorageManager.js?v=4t_7JvnBWDeEMpFrVXIFXButM3Totmy-DFi6KadXAYk"></script-->
    <script src="js/localStorageManager.js"></script>
    <!--script src="https://www.solarlatam.com/js/noty.min.js"></script-->
    <script src="js/noty.min.js"></script>
	<!--script src="https://www.solarlatam.com/js/datepicker.es.js"></script-->
	<script src="js/datepicker.es.js"></script>
	<!--script src="https://www.solarlatam.com/js/globalization.js?v=9L9DZTRwBdACnP6nRDagV_8gJTNr225QlkQrvq-N4vA"></script-->
	<script src="js/globalization.js"></script>
	<!--script src="https://www.solarlatam.com/js/region.js?v=R89xTCrcKoXw4p3vwBrqEISgBkggola3jlQpbtsRlNQ"></script-->
	<script src="js/region.js"></script>
	

    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" type="text/javascript"></script-->
    <script src="js/Chart.min.js" type="text/javascript"></script>
	

    <script>
        var currentCountry = 'cl';
        var companyName = "Enerlife";
    </script>
	
    <!--script src="https://www.solarlatam.com/js/views/home/indexWWW.js?v=1yZyQ_NUfCY9ry_ris7lJX1ol50CR951Ii7Sq6i8bb8"></script-->
	<!--script src="https://www.solarlatam.com/js/views/home/index.js?v=OGM61_-N3t0u_eIj5iTHuwbqzZEo8dFfJ7Vm5B7mKhg"></script-->
	<!--script src="/js/views/wizard/step1.js?v=WuJixL7rk_whnqPW0B5hNIzIKIKKVDzPS4Hhi9RtN9w"></script-->
	<script src="js/index.js"></script>
    <script src="js/step1.js"></script>
    <script src="js/indexWWW.js"></script>
	
    <!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places,geometry&key=AIzaSyDds9Vh-wKnHzim-ySu3i1m88esLt5MyHM&callback=initAddressAutocomplete"></script-->
	<script type="text/javascript"    src="https://maps.googleapis.com/maps/api/js?libraries=places,geometry&key=AIzaSyBRmaPYAooWQ4CFedveeKZu4Ao85rrgxgg&callback=initAddressAutocomplete"></script>
    

    
    <!--script src="https://app.solarlatam.com/js/views/wizard/step2.js?v=oOmIucD1qf7deQpgwCuYhuxnikfk46QQRU3d3Aa3jX8"></script-->
    <script src="js/step2.js?"></script>
    <!--script src="https://app.solarlatam.com/js/GoogleMapHelper.js?v=9s-jUB0GLtuClZGmv-XVLAxVTveyb7ZLAq3_0HCk_ws"></script-->
    <script src="js/GoogleMapHelper.js"></script>
   
    <script>
        var isInApp = true;
		SetLatLng($('#lat').val(), $('#lng').val())
		showStep2();
    </script>

    
</body>
</html>
