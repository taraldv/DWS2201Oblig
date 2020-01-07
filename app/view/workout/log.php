
<?php include VIEW.'header.php';?>
<form id='addLogForm'>
	<select id='workoutSelect'>
<?php
foreach ($this->viewData[0] as $selectArr){
	$id=$selectArr['workoutId'];
	$name=$selectArr['name'];
	echo "<option data=$id>$name</option>";
}
?>
	</select>
	<input name='kilo'>
	<input name='reps'>
	<input type='submit' value='Logg øvelse'>
	<input id='workoutName' name='name' hidden value="<?php echo $this->viewData[0][0]['name'] ?>">
	<input id='workoutId' name='workoutId' hidden value="<?php echo $this->viewData[0][0]['workoutId'] ?>">
</form>
<table>
<tr><th>Øvelse navn</th><th>Reps</th><th>Kilo</th><th>Dato</th><th>Slett knapp</th></tr>
<?php
foreach ($this->viewData[1] as $arr){
	$id=$arr['logId'];
	$name=$arr['name'];
	$reps=$arr['reps'];
	$date=$arr['date'];
	$kilo=$arr['kilo'];
	echo "<tr><td>$name</td><td>$reps</td><td>$kilo</td><td>$date</td><td><div data=$id class='deleteButton'>Slett</div></td></tr>";
}
?>
</table>
<script>
getWorkoutSelectId();
enableDeleteButton('logId','deleteButton','delete_log');
enableJavascriptForm('/workout/add_log','addLogForm',appendTable);
</script>
<?php include VIEW.'footer.php';?>
