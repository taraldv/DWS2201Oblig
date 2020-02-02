<?php include VIEW.'header.php';?>
<?php include VIEW.'nav.php';?>
<h1 class="display-4 text-center">Øvelse historikk</h1>
<br>
<div class='container'>
	<form>
		<div class='form-group'>
			<label for='workoutSelect'>Velg Øvelse</label>
			<select class='form-control' id='workoutSelect'>
				<?php
					//Generates select with data from controller
					foreach ($this->viewData[0] as $selectArr){
						$id=$selectArr['workoutId'];
						$name=$selectArr['name'];
						echo "<option data=$id>$name</option>";
					}
				?>
			</select>
		</div>
	</form>
	<table id='logTable' class='table w-auto table-dark table-striped'><thead class="thead-dark">
		<tr><th>Reps</th><th>Kilo</th><th>Dato</th><th id='deleteButtonColumn'></th></tr></thead>
		<tbody id='logTableBody'></tbody>
	</table>
</div>
<script>
	applyIndexEventListener();
</script>
<?php include VIEW.'footer.php';?>
