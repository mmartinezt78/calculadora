
<!DOCTYPE html>
<html>
<head>
	<title>::CALCULADORA::</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
  <h2>CALCULADORA DE PRECIOS ENERLIFE</h2>
  <form name="form" id="form" class="form-horizontal" action="javascript:validateFormOnSubmit();">
    <div class="form-group">
      <label class="control-label col-sm-2" for="kwmes" required>Kwh mes:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="kwmes" placeholder="252" name="kwmes">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="respaldo">Respaldo:</label>
      <div class="col-sm-10">          
		<select class="form-control" name="respaldo" id="respaldo">
		  <option value="volvo">0</option>
		  <option value="3">3</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		  <option value="8">8</option>
		  <option value="10">10</option>
		</select>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Calcular</button>
      </div>
    </div>
  </form>
</div>

<div class="container">	
	<div id="respuesta"></div>
</div>

</body>

</html>

<script>
function validateFormOnSubmit() {
	if ($('#kwmes').val() == "") {
		alert('Ingresar Kw por mes');
	} else {
		$.ajax({
		  method: "GET",
		  url: "func.php",
		  data: { 
			kwmes: $('#kwmes').val(),
			respaldo: $('#respaldo').val()
		  }
		})
		.done(function( response ) {
			$('#respuesta').html(response);
		});
	}
}
</script>

