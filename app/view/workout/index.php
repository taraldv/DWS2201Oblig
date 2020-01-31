<?php include VIEW.'header.php';?>
<?php include VIEW.'nav.php';?>
<div class='container'>
<form>
	<div class='form-group'>
	<label for='workoutSelect'>Velg Øvelse</label>
	<select class='form-control' id='workoutSelect'>
<?php
foreach ($this->viewData[0] as $selectArr){
	$id=$selectArr['workoutId'];
	$name=$selectArr['name'];
	echo "<option data=$id>$name</option>";
}
?>
	</select>
	</div>
</form>
<table id='logTable' class='table table-striped'><thead class="thead-dark">
<tr><th>Reps</th><th>Kilo</th><th>Dato</th><th>Slett knapp</th></tr></thead>
</table>
</div>
<script>
getWorkoutSelectData();
</script>
<?php include VIEW.'footer.php';?>
