<!DOCTYPE html>
<html>
<head>
	<title>Admin Menu</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="<?php echo URL; ?>js/jquery.js"></script>
	<link rel="stylesheet" href="<?php echo URL; ?>css/pure-min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>css/grids-responsive-min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>css/font-awesome/css/font-awesome.min.css" type="text/css">
	<style type="text/css">

		.contenitore {
			
			text-align: center;
			background-color: rgb(66,184,221);
		}

		body {
			background-color: #F6F1ED;
		}

		.contenitore1, .contenitore-ultimo {

			margin-left: 30%;
			margin-right: 30%;
			margin-top: 10%
		}

		.pure-menu-link {
			color: white;
		}

		.pure-menu-link:hover {
			color: #666;
		}

		.contenitore2 {

			margin-left: 34%;
			margin-right: 34%;
			text-align: center;
			margin-top: 2%;
			margin-bottom: 1%;
		}
		tr, td {
			text-align: center;
		}

	</style>
</head>
<body>
	<div class="pure-menu pure-menu-horizontal contenitore">
		<a href="<?php echo URL; ?>admin/aggiungistudente" class="pure-menu-heading pure-menu-link">Admin</a>
		<ul class="pure-menu-list">
			<li class="pure-menu-item"><a href="<?php echo URL; ?>admin/aggiungistudente" class="pure-menu-link">Aggiungi</a></li>
			<li class="pure-menu-item"><a href="<?php echo URL; ?>admin/classifica" class="pure-menu-link">Classifica</a></li>
			<li class="pure-menu-item"><a href="<?php echo URL; ?>admin/generaPettorine" class="pure-menu-link">Pettorine</a></li>
			<li class="pure-menu-item"><a href="<?php echo URL; ?>admin/elenco" class="pure-menu-link">Elenchi</a></li>
			<li class="pure-menu-item"><a href="<?php echo URL; ?>admin/correzione" class="pure-menu-link">Correzione</a></li>
		</ul>
	</div>
