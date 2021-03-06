<?php include VIEW.'header.php';?>
<?php include VIEW.'nav.php';?>
<h1 class="display-4 text-center">Legg til øvelse</h1>
<br>
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
	<table class='table w-auto table-dark table-striped'>
		<thead class='thead-dark'>
			<tr><th>Øvelse navn</th><th id='deleteButtonColumn'></th></tr>
		</thead>
		<tbody>
			<?php
				/* Builds table from controller data */
				foreach ($this->viewData as $arr){
					$id=$arr['workoutId'];
					$name=$arr['name'];
					echo "<tr><td>$name</td><td><button class='btn btn-secondary btn-block deleteButton' data=$id>Slett</button></td></tr>";
				}
			?>
		</tbody>
	</table>
</div>
<script>
	applyAddEventListener();
</script>
<?php include VIEW.'footer.php';?>
