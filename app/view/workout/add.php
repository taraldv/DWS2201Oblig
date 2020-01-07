
<?php include VIEW.'header.php';?>
<div class='container'>
<form id='addWorkoutForm'>
	<div class ='form-group'>
	<label for='name'>Øvelse navn:</label>
	<input id='name' class='form-control' type='text' name='name'>
	</div>
	<div class='form-group'>
	<input class='btn btn-primary' type='submit' value='Legg til øvelse'>
	</div>
</form>
<table class='table table-striped'>
<thead class='thead-dark'>
<tr><th>Øvelse navn</th><th>Slett knapp</th></tr>
</thead>
<?php
foreach ($this->viewData as $arr){
	$id=$arr['workoutId'];
	$name=$arr['name'];
	echo "<tr><td>$name</td><td><button class='btn btn-secondary btn-block deleteButton' data=$id>Slett</button></td></tr>";
}
?>
</table>
</div>
<script>
enableDeleteButton('workoutId','deleteButton','delete_workout');
enableJavascriptForm('/workout/add_workout','addWorkoutForm',appendTable);
</script>
<?php include VIEW.'footer.php';?>
