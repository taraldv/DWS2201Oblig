<?php include VIEW.'clean_header.php';?>

<form action='/login/valid_login' method='post'>
<input type='text' name='email'>
<input type='password' name='password'>
<input type='submit' value='Logg inn'>
</form>
<a href='/login/register'>Registrer deg</a>
<br>
<a href='/login/forgotten_password'>Glemt passord</a>
<?php 
if(!$this->viewData[0]){
	echo "<h1>Feil epost,passord eller ikke bekreftet epost</h1>";
}
?>
<?php include VIEW.'footer.php';?>

