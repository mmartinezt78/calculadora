

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $datelis = $_POST;
    session_start();
    $paso3 = $_SESSION['step3'];
    $paso4 = $_SESSION['step4'];


    if(isset($_POST['action']) && (trim($_POST['action']) != '' )) {

        $n_form = $_POST['frm'];

        if ($n_form == 'first_form') {
            $datos = validaDatosPrimerFormulario($paso3);

            /* CARGAR PARAMETROS DE BD */
            $final_url = 'https://enerlife.api-us1.com';
            $apiKey = '628a6254a955256654552ed1c2fd43bf2612749778e53c5bfe1b3274ad816d03b3779909';

            api_save_data($n_form, $final_url, $apiKey, $datos);
        } else if ($n_form == 'second_form') {
            $datos = validaDatosSegundoFormulario($paso3, $paso4);

            /* CARGAR PARAMETROS DE BD */
            $final_url = 'https://enerlife.api-us1.com';
            $apiKey = '628a6254a955256654552ed1c2fd43bf2612749778e53c5bfe1b3274ad816d03b3779909';

            api_save_data($n_form, $final_url, $apiKey, $datos);
        } else {
            exit('Invalid Request');
        }
    } else {
        exit('Invalid Request');
    }

} else {
    exit('Invalid Request');
}

    function validaDatosSegundoFormulario($paso3_, $paso4_) {
        if (isset($_POST['email']) && isset($_POST['phone'])
            && isset($_POST['firstName']) && isset($_POST['lastName'])) {
            $datosValidados = array (
                'email' => $_POST['email'],
                'telefono' => $_POST['phone'],
                'nombre' => $_POST['firstName'],
                'apellido' => $_POST['lastName'],
                'calle' => $_POST['calle'],
                'numeroCalle' => $_POST['numeroCalle'],
                'ciudad' => $_POST['ciudad'],
                'region' => $_POST['region'],
                'pais' => $_POST['pais'],
                'codigoPostal' => $_POST['codigoPostal'],
                'fechaVisitaTecnica' => $_POST['fechaVisitaTecnica'],
                'horaVisitaTecnica' => $_POST['horaVisitaTecnica'],
                'fullDireccion' => $_POST['calle'].' '. $_POST['numeroCalle']. ', '.$_POST['ciudad'].', '.$_POST['region'],

                'area' => $paso3_['ConsumptionWizard_RoofArea'],
                'producto' => $paso3_['ConsumptionWizard_ConsumptionTypeOnGrid'] == "true"? 'On-Grid': 'Of-Grid',

                'pagoMensual' => $paso4_['pago_mensual'],
                'consumoMes' => $paso4_['ConsumptionWizard_ConsumptionPowerPerMonth'],

                'label' => 'form2'
            );
            return $datosValidados;
        } else {
            exit('ERROR DATA');
        }
    }

    function validaDatosPrimerFormulario($paso3_) {
        if (isset($_POST['email']) && isset($_POST['phone'])
            && isset($_POST['firstName']) && isset($_POST['lastName'])) {
            $datosValidados = array(
                'email' => $_POST['email'],
                'telefono' => $_POST['phone'],
                'nombre' => $_POST['firstName'],
                'apellido' => $_POST['lastName'],
                'calle' => '',
                'numeroCalle' => '',
                'ciudad' => '',
                'region' => '',
                'pais' => '',
                'codigoPostal' => '',
                'fechaVisitaTecnica' => '',
                'horaVisitaTecnica' => '',
                'fullDireccion' => '',

                'area' => $paso3_['ConsumptionWizard_RoofArea'],
                'producto' => $paso3_['ConsumptionWizard_ConsumptionTypeOnGrid'] == "true"? 'On-Grid': 'Of-Grid',

                'pagoMensual' => '',
                'consumoMes' => '',

                'label' => 'form1',
            );
            return $datosValidados;
        } else {
            exit('ERROR DATA');
        }
    }

    function api_save_data($n_form_, $url_, $apiKey_, $datos) {

        $url = $url_;

        $params = array(
            'api_key'      => $apiKey_,
            'api_action'   => $n_form_ == 'first_form' ? 'contact_add' : 'contact_sync',

            // define the type of output you wish to get back
            // possible values:
            // - 'xml'  :      you have to write your own XML parser
            // - 'json' :      data is returned in JSON format and can be decoded with
            //                 json_decode() function (included in PHP since 5.2.0)
            // - 'serialize' : data is returned in a serialized format and can be decoded with
            //                 a native unserialize() function
            'api_output'   => 'serialize',
        );

        // here we define the data we are posting in order to perform an update
        $post = array(
            'email'                    => $datos['email'],
            'first_name'               => $datos['nombre'],
            'last_name'                => $datos['apellido'],
            //'ip4'                    => '127.0.0.1',
            'phone'                    => $datos['telefono'],
            'customer_acct_name'       => '',
            'tags'                     => 'Nueva Calculadora',
            'label'                     => $datos['label'],

            // any custom fields
            //'field[345,0]'           => 'field value', // where 345 is the field ID
            'field[%DIRECCION_INSTALACION%,0]'      => $datos['fullDireccion'],
            'field[%FECHA_VISITA_TECNICA%,0]'      => $datos['fechaVisitaTecnica'],
            'field[%HORA_VISITA_TECNICA%,0]'      => $datos['horaVisitaTecnica'],
            'field[%REA_INGRESADA%,0]'      => $datos['area'],
            'field[%TIPO_SISTEMA%,0]'      => $datos['producto'],
            'field[%TIPO_PRODUCTO%,0]'      => $datos['producto'],

            'field[%PAGO_MENSUAL%,0]'      => $datos['pagoMensual'],
            'field[%CONSUMO_POR_MES%,0]'      => $datos['consumoMes'],

            // assign to lists:
            'p[3]'                   => 3, // example list ID (REPLACE '123' WITH ACTUAL LIST ID, IE: p[5] = 5)
            'status[123]'              => 1, // 1: active, 2: unsubscribed (REPLACE '123' WITH ACTUAL LIST ID, IE: status[5] = 1)
            //'form'          => 1001, // Subscription Form ID, to inherit those redirection settings
            //'noresponders[123]'      => 1, // uncomment to set "do not send any future responders"
            //'sdate[123]'             => '2009-12-07 06:00:00', // Subscribe date for particular list - leave out to use current date/time
            // use the folowing only if status=1
            'instantresponders[123]' => 1, // set to 0 to if you don't want to sent instant autoresponders
            //'lastmessage[123]'       => 1, // uncomment to set "send the last broadcast campaign"

            //'p[]'                    => 345, // some additional lists?
            //'status[345]'            => 1, // some additional lists?
        );

        // This section takes the input fields and converts them to the proper format
        $query = "";
        foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
        $query = rtrim($query, '& ');

        // This section takes the input data and converts it to the proper format
        $data = "";
        foreach( $post as $key => $value ) $data .= urlencode($key) . '=' . urlencode($value) . '&';
        $data = rtrim($data, '& ');

        // clean up the url
        $url = rtrim($url, '/ ');

        // This sample code uses the CURL library for php to establish a connection,
        // submit your request, and show (print out) the response.
        if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

        // If JSON is used, check if json_decode is present (PHP 5.2.0+)
        if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
            die('JSON not supported. (introduced in PHP 5.2.0)');
        }

        // define a final API request - GET
        $api = $url . '/admin/api.php?' . $query;

        $request = curl_init($api); // initiate curl object
        curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
        curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
        //curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

        $response = (string)curl_exec($request); // execute curl post and store results in $response

        // additional options may be required depending upon your server configuration
        // you can find documentation on curl options at http://www.php.net/curl_setopt
        curl_close($request); // close curl object

        if ( !$response ) {
            die('Nothing was returned. Do you have a connection to Email Marketing server?');
        }

        // This line takes the response and breaks it into an array using:
        // JSON decoder
        //$result = json_decode($response);
        // unserializer
        $result = unserialize($response);
        // XML parser...
        // ...


        $resultado = $result['result_code'] ? 'SUCCESS' : 'FAILED';

        // REGISTRO DE DATOS GUARDADO, SI USUARIO VUELVE A CARGAR FORMULARIO
        if ($resultado == 'SUCCESS') {
            session_start();
            $_SESSION["f1_nombre"] = $datos['nombre'];
            $_SESSION["f1_apellido"] = $datos['apellido'];
            $_SESSION["f1_telefono"] = $datos['telefono'];
            $_SESSION["f1_email"] = $datos['email'];
        } else {
            unset($_SESSION['f1_nombre']);
            unset($_SESSION['f1_apellido']);
            unset($_SESSION['f1_telefono']);
            unset($_SESSION['f1_email']);
        }

        echo '{"status": "' . $resultado . '" }';


        // Result info that is always returned
        echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';

        echo 'Message: ' . $result['result_message'] . '<br />';

        // The entire result printed out
        echo 'The entire result printed out:<br />';
        echo '<pre>';
        print_r($result);
        echo '</pre>';

        // Raw response printed out
        echo 'Raw response printed out:<br />';
        echo '<pre>';
        print_r($response);
        echo '</pre>';

        // API URL that returned the result
        echo 'API URL that returned the result:<br />';
        echo $api;

        echo '<br /><br />POST params:<br />';
        echo '<pre>';
        print_r($post);
        echo '</pre>';
    }

?>