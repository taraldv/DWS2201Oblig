<?php include VIEW.'clean_header.php';?>

<form action='/login/add_user' method='post'>
<input type='text' name='email'>
<input type='password' name='password'>
<input type='submit' value='Registrer deg'>
</form>
<?php 
if(!$this->viewData[0]){
	echo '<h1> email in use </h1>';
}
?>
<script>

</script>
<?php include VIEW.'footer.php';?>

