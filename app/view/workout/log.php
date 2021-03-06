<?php include VIEW.'header.php';?>
<?php include VIEW.'nav.php';?>
<h1 class="display-4 text-center">Logg øvelse</h1>
<br>
<div class='container'>
	<form id='addLogForm'>
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
		<div class='form-group'>
			<label for='kilo'>Antall kilo:</label>
			<input class='form-control' id='kilo' name='kilo'>
		</div>
		<div class='form-group'>
			<label for='reps'>Antall reps:</label>
			<input id='reps' class='form-control' name='reps'>
		</div>
		<div class='form-group'>
			<input class='btn btn-primary' type='submit' value='Logg øvelse'>
			<input id='workoutName' name='name' hidden value="<?php echo $this->viewData[0][0]['name'] ?>">
			<input id='workoutId' name='workoutId' hidden value="<?php echo $this->viewData[0][0]['workoutId'] ?>">
		</div>
	</form>
	<table class='table table-striped table-dark w-auto'><thead class="thead-dark">
		<tr><th>Øvelse navn</th><th>Reps</th><th>Kilo</th><th>Dato</th><th id='deleteButtonColumn'></th></tr></thead>
		<tbody>
			<?php
				/* Builds table from controller data */
				foreach ($this->viewData[1] as $arr){
					$id=$arr['logId'];
					$name=$arr['name'];
					$reps=$arr['reps'];
					$date=$arr['date'];
					$kilo=$arr['kilo'];
					echo "<tr><td>$name</td><td>$reps</td><td>$kilo</td><td>$date</td><td><div data=$id class='btn btn-block btn-secondary deleteButton'>Slett</div></td></tr>";
				}
			?>
		</tbody>
	</table>
</div>
<script>
	applyLogEventListener()
</script>
<?php include VIEW.'footer.php';?>
