<?php include VIEW.'clean_header.php';?>

<form action='/login/add_user' method='post'>
<input type='text' name='email'>
<input type='password' name='password'>
<input type='submit' value='Registrer deg'>
</form>
<?php 
if(isset($this->viewData[0])){
	if($this->viewData[0]){
		echo '<h1>Sjekk epost for bekreftelse</h1>';
	} else {
		echo '<h1>Epost er i bruk, prøv glemt passord</h1>';
	}
}
?>
<?php include VIEW.'footer.php';?>

