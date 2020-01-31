
<?php include VIEW.'header.php';?>

<form action='/login/update_password' method='post'>
<input type='password' name='password'>
<input type='submit' value='Send inn nytt passord'>
<input hidden name='token' value='<?php echo "$this->viewData" ?>'>
</form>

<?php include VIEW.'footer.php';?>

