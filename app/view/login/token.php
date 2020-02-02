<?php include VIEW.'header.php';?>
<div class='container'>
	<form action='/login/new_verify' method='post'>
		<div class='form-group'>
			<label for='email'>Epost:</label>
			<input class='form-control' id='email' type='text' name='email'>
		</div>
		<div class='form-group'>
			<h1>Din verifiserings link var ugyldig, du kan prøve igjen eller kontakte nettside administrator</h1>
			<input class='btn btn-primary' type='submit' value='Send ny verifiserings epost'>
		</div>
	</form>
</div>
<?php 
if(isset($this->viewData[0])){
	if($this->viewData[0]){
		echo '<h1>Sjekk epost for ny link</h1>';
	} else {
		echo '<h1>Noe gikk galt, kontakt nettside administrator</h1>';
	}
}
?>
<?php include VIEW.'footer.php';?>

