<?php include VIEW.'clean_header.php';?>
<div class='container' >
<form id='sendMailPasswordTokenForm'>
<div class='form-group'>
	<label for='email'>Epost:</label>
	<input class='form-control' name='email' type='text' id='email'>
</div>
<div class='form-group'>
	<input class='btn btn-primary' type='submit' value='Send passord reset link'>
</div>
</form>
</div>
<script src=/script.js></script>
<script>
enableJavascriptForm('/login/send_password_link','sendMailPasswordTokenForm',appendParagraph);
</script>
<?php include VIEW.'footer.php';?>
