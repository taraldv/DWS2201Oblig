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
<nav>
	<ul>
		<li><a href="/workout/index" <?php echo ($action == 'index' ? 'class=active' : '') ?>>Home</a></li>
		<li><a href="/workout/add" <?php echo ($action == 'add' ? 'class=active' : '') ?>>Add</a></li>
		<li><a href="/workout/log" <?php echo ($action == 'log' ? 'class=active' : '') ?>>Log</a></li>
		<li><a href="/login/logout" <?php echo ($action == 'logout' ? 'class=active' : '') ?>>Logout</a></li>
	</ul>
</nav>

