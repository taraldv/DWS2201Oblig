
<?php include VIEW.'header.php';?>
<form action='' method='post'>
	<input type='text' name='name'>
	<input type='submit' value='Legg til øvelse'>
</form>
<table>
<tr><th>Øvelse navn</th></tr>
<?php
foreach ($this->viewData as $arr){
	$id=$arr['workoutId'];
	$name=$arr['name'];
	echo "<tr><td data=$id>$name</td></tr>";
}
?>
</table>
<?php include VIEW.'footer.php';?>
