<?php include VIEW.'clean_header.php';?>

<form action='' method='post'>
<input type='text' name='email'>
<input type='password' name='password'>
<input type='submit' value='Registrer deg'>
</form>
<?php 
if(isset($_POST['email'])&&isset($_POST['password'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$this->viewData->register($email,$password);
}
?>
<?php include VIEW.'footer.php';?>

