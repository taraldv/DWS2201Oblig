
<?php include VIEW.'header.php';?>
<form id='addWorkoutForm'>
	<input type='text' name='name'>
	<input type='submit' value='Legg til øvelse'>
</form>
<table>
<tr><th>Øvelse navn</th><th>Slett knapp</th></tr>
<?php
foreach ($this->viewData as $arr){
	$id=$arr['workoutId'];
	$name=$arr['name'];
	echo "<tr><td>$name</td><td><div class='deleteButton' data=$id>Slett</div></td></tr>";
}
?>
</table>
<script>
enableDeleteButton('workoutId','deleteButton','delete_workout');
enableJavascriptForm('/workout/add_workout','addWorkoutForm');
</script>
<?php include VIEW.'footer.php';?>
