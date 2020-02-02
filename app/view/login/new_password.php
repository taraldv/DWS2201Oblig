<?php include VIEW.'header.php';?>
<h1 class="display-1 text-center">Trenings logg</h1>
<img class="mx-auto d-block" src="/img/logo.png">
<form action='/login/update_password' method='post'>
	<input type='password' name='password'>
	<input type='submit' value='Send inn nytt passord'>
	<input hidden name='token' value='<?php echo "$this->viewData" ?>'>
</form>
<?php include VIEW.'footer.php';?>

