<?php include VIEW.'header.php';?>
<h1 class="display-1 text-center">Trenings logg</h1>
<img class="mx-auto d-block" src="/img/logo.png">
<div class='container'>
	<form class='' action='/login/valid_login' method='post'>
		<div class="form-group">
			<label for="email">Epost:</label>
			<input class="form-control" type='text' name='email' id="email">
		</div>
		<div class="form-group">
			<label for="password">Passord:</label>
			<input class="form-control" type='password' name='password'>
		</div>
		<div class="form-group">
			<input class='btn btn-primary' type='submit' value='Logg inn'>
		</div>
		<div class="form-group">
			<a href='/login/register'>Registrer deg</a>
		</div>
		<div class="form-group">
			<a href='/login/forgotten_password'>Glemt passord</a>
		</div>
	</form>
</div>
<?php 
	if(!$this->viewData[0]){
		echo "<h1>Feil epost,passord eller ikke bekreftet epost</h1>";
	}
?>
<?php include VIEW.'footer.php';?>

