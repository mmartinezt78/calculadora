<?php

$potenciaPanelStok = 450;
$generacionPorKwp = 140;
$precioPonderadoCompraVentaEnergia = 120;
$porcentajeDescuentoAutoinstalacion = 0.3;
$marcaPanelesSoar = "Mono Perc";
$marcaInversor = "Renac";

$kwmes = $_GET['kwmes'];
$cant_respaldos = 0;
if(isset($_GET['respaldo'])){
	$cant_respaldos = $_GET['respaldo'];
}

$potencia = $kwmes / $generacionPorKwp;
$nroDePaneles = $potencia * 1000 / $potenciaPanelStok;

//Valores de minimo y maximo según portencia
$valores_Ongrid_by_potencia = array(
	array('min'=>1.5, 'max'=>2.4, 'valor'=> 1690000),
	array('min'=>2.5, 'max'=>2.99, 'valor'=> 1290000),
	array('min'=>3, 'max'=>4.99, 'valor'=> 1190000),
	array('min'=>5, 'max'=>7.99, 'valor'=> 1090000),
	array('min'=>8, 'max'=>10, 'valor'=> 990000),
	array('min'=>10.1, 'max'=>20, 'valor'=> 950000),
	array('min'=>20, 'max'=>40, 'valor'=> 920000),
	array('min'=>40, 'max'=>80, 'valor'=> 850000)
);

//Valores Respaldo según potencia
$valores_respaldos = array (
	array('valor_kw' => 3, 'valor' => 1690000),
	array('valor_kw' => 5, 'valor' => 2190000),
	array('valor_kw' => 6, 'valor' => 2990000),
	array('valor_kw' => 8, 'valor' => 3690000),
	array('valor_kw' => 10, 'valor' => 3990000),
);


//buscar valor según potencia
$valor_segun_potencia = 0;
foreach($valores_Ongrid_by_potencia as $datos) {
	//potencia mayor al mínimo y menor al máximo configurado
	if($potencia > $datos['min'] && $potencia < $datos['max']) {
		$valor_segun_potencia = $datos['valor'];
		break;
	}
}

$onGridLlaveEnMano = round($potencia * $valor_segun_potencia, -5) - 10000;

$onGridAutoinstalacion = -10000 + ceil($onGridLlaveEnMano * (1 - $porcentajeDescuentoAutoinstalacion) / 100000) * 100000;


echo '<br>';
echo 'KW por mes: '.$kwmes;
 
echo '<br>';
echo 'Potencia: '.$potencia;

echo '<br>';
echo 'Nro de Paneles: '.$nroDePaneles;

//echo '<br>';
//echo 'Valor Según potencia: '.$valor_segun_potencia;

echo '<br>';
echo '<hr>';
echo '<h3>Valores</h3>';
echo 'valor Ongrid llave en mano: $'. number_format($onGridLlaveEnMano, 0, ',', '.');
echo '<br>';
echo 'valor Ongrid autoinstalación: $'. number_format($onGridAutoinstalacion, 0, ',', '.');



if ($cant_respaldos > 0) {
	$valor_r = 0;
	echo '<br>';
	echo '<hr>';
	echo '<h3>Valores más respaldo</h3>';
	echo '<strong>cant respaldos</strong>: '.$cant_respaldos.'KW <br>';
	
	
	//debe seleccionar de lista la cantidad de respaldo a calcular
	
	foreach($valores_respaldos as $valor_respaldo) {
		if($cant_respaldos <= $valor_respaldo['valor_kw']) {
			$valor_r = $valor_respaldo['valor'];
			break;
		}
	}
	
	$onGridLlaveEnManoMasRespaldo = -10000 + ceil(($onGridLlaveEnMano + $valor_r) / 100000) * 100000;
	echo 'valor Ongrid llave en mano más respaldo: $'. number_format($onGridLlaveEnManoMasRespaldo, 0, ',', '.');
	
	echo '<br>';
	$onGridAutoinstalacionMasRespaldo = -10000 + ceil($onGridLlaveEnManoMasRespaldo * (1 - $porcentajeDescuentoAutoinstalacion) / 100000) * 100000;
	echo 'valor Ongrid autoinstalación más respaldo: $'. number_format($onGridAutoinstalacionMasRespaldo, 0, ',', '.');
	
}


echo '<br>';
echo '<hr>';

$ahorroAnual = $kwmes * $precioPonderadoCompraVentaEnergia * 12;
echo 'Ahorro anual: '. number_format($ahorroAnual, 0, ',', '.');


echo '<br>';
$RecuperacionInversiónAutoinstalacion = round($onGridAutoinstalacion / 1.19 / $ahorroAnual, 1);
echo 'Recuperación de la Inversión Autoinstalación: '.number_format($RecuperacionInversiónAutoinstalacion, 1, ',', '.').' Años';


echo '<br>';
$RentabilidadAutoinstalacion = $ahorroAnual / ($onGridAutoinstalacion / 1.19) * 100;
echo 'Rentabilidad autoinstalacion: '.number_format($RentabilidadAutoinstalacion, 0, ',', '.').'%';


echo '<br>';
$RecuperacionInversiónLlaveEnMano = round($onGridLlaveEnMano / 1.19 / $ahorroAnual, 1);
echo 'Recuperación de la Inversión llave en mano: '.number_format($RecuperacionInversiónLlaveEnMano, 1, ',', '.').' Años';


echo '<br>';
$RentabilidadLlaveEnMano = $ahorroAnual / ($onGridLlaveEnMano / 1.19) * 100;
echo 'Rentabilidad autoinstalacion: '.number_format($RentabilidadLlaveEnMano, 0, ',', '.').'%';


echo '<br>';
$ToneladasCO2Anual = 0.00044 * $kwmes * 12;
echo 'Toneladas CO2 Anual: '.number_format($ToneladasCO2Anual, 1, ',', '.').'%';





?>