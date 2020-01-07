<?php include VIEW.'clean_header.php';?>
<form id='sendMailPasswordTokenForm'>
<input name='email' type='text'>
<input type='submit' value='Send passord reset link'>
</form>
<script src=/script.js></script>
<script>
enableJavascriptForm('/login/send_password_link','sendMailPasswordTokenForm',appendParagraph);
</script>
<?php include VIEW.'footer.php';?>
