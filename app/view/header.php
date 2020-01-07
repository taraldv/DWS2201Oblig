<?php 
$action = $this->getAction();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo (isset($this->pageTitle) ? $this->pageTitle : 'Workout log')?></title>
	<link href="/main.css" type="text/css" media="all" rel="stylesheet">
	<link href="/bootstrap.min.css" type="text/css" media="all" rel="stylesheet">
</head>
<body>
<script src='/script.js'></script>
<nav>
	<ul class='nav nav-pills justify-content-center'>
	<li class='nav-item'><a class='nav-link <?php
		echo ($action == 'index.php' ? 'active' : '')
	?>' href="/workout/index">Home</a></li>
	<li class='nav-item'><a class='nav-link <?php
		echo ($action == 'add.php' ? 'active' : '')
	?>' href="/workout/add">Legg til øvelse</a></li>
	<li class='nav-item'><a class='nav-link <?php
		echo ($action == 'log.php' ? 'active' : '')
	?>' href="/workout/log">Logg øvelse</a></li>
		<li class='nav-item'><a class='nav-link' href="/login/logout">Logout</a></li>
	</ul>
</nav>

