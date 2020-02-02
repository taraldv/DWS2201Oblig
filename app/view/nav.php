<?php 
$action = $this->getMethod();
?>
<br>
<nav>
	<ul class='nav nav-pills justify-content-center'>
	<li class='nav-item'><a class='nav-link 
		<?php
		if($action == 'index.php'){
			echo 'active';
		}
		?>
		'href="/workout/index">Home</a></li>
	<li class='nav-item'><a class='nav-link 
		<?php
		if($action == 'add.php'){
			echo 'active';
		}
		?>
	'href="/workout/add">Legg til øvelse</a></li>
	<li class='nav-item'><a class='nav-link 
		<?php
		if($action == 'log.php'){
			echo 'active';
		}
		?>
	'href="/workout/log">Logg øvelse</a></li>
		<li class='nav-item'><a class='nav-link' href="/login/logout">Logout</a></li>
	</ul>
</nav>
<br>

