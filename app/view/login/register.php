<?php include VIEW.'header.php';?>
<h1 class="display-1 text-center">Trenings logg</h1>
<img class="mx-auto d-block" src="/img/logo.png">
<div class='container'>
	<form action='/login/add_user' method='post'>
		<div class='form-group'>
			<label for='email'>Epost:</label>
			<input class='form-control' id='email' type='text' name='email'>
		</div>
		<div class='form-group'>
			<label for='password'>Passord:</label>
			<input class='form-control' id='password'type='password' name='password'>
		</div>
		<div class='form-group'>
			<input class='btn btn-primary' type='submit' value='Registrer deg'>
		</div>
	</form>
</div>
<?php 
	if(isset($this->viewData[0])){
		if($this->viewData[0]){
			echo '<h1>Sjekk epost for bekreftelse</h1>';
		} else {
			echo '<h1>Epost er i bruk, kontakt nettside administrator eller bruk en annen epost</h1>';
		}
	}
?>
<?php include VIEW.'footer.php';?>

