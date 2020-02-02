<?php include VIEW.'header.php';?>
<h1 class="display-1 text-center">Trenings logg</h1>
<img class="mx-auto d-block" src="/img/logo.png">
<div class='container'>
	<form action='/login/update_password' method='post'>
		<div class='form-group'>
			<label for='password'>Nytt passord:</label>
			<input id='password' class='form-control' type='password' name='password'>
		</div>
		<div class='form-group'>
			<input class='btn btn-primary' type='submit' value='Send inn nytt passord'>
			<input hidden name='token' value='<?php echo "$this->viewData" ?>'>
		</div>
	</form>
</div>
<?php include VIEW.'footer.php';?>

