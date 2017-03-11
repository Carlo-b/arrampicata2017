<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="<?php echo URL; ?>js/jquery.js"></script>
	<link rel="stylesheet" href="<?php echo URL; ?>css/pure-min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>css/grids-responsive-min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>css/font-awesome/css/font-awesome.min.css" type="text/css">
	<title>Aggiungi uno studente</title>
</head>
<body>
	<div class="contenitore">
		<form class="pure-form pure-form-aligned" action="<?php echo URL; ?>admin/aggiungistudente" method="POST">
			<fieldset>
				<div class="pure-control-group">
					<label for="name">Nome</label>
					<input type="text" name="name" id="name" placeholder="Nome">
				</div>
				<div class="pure-control-group">
					<label for="cognome">Cognome</label>
					<input type="text" name="cognome" id="cognome" placeholder="Cognome">
				</div>
				<div class="pure-control-group">
					<label for="sesso">Sesso</label>
					<select name="sesso">
						<option value="M">M</option>
						<option value="F">F</option>
					</select>
				</div>
				<div class="pure-control-group">
					<label for="data_nascita">Data di nascita</label>
					<input type="date" name="data_nascita" id="data_nascita" placeholder="Data di nascita">
				</div>
				<div class="pure-control-group">
					<label for="scuola">Scuola</label>
					<select name="scuola">
						<?php
							$lista_scuole = $this->model->getAllScuole();
							foreach ($lista_scuole as $lista) {
								echo "<option value=\"$lista->nome_scuola\">" + $lista->nome_scuola +"</option>";
							}
						?>
					</select>
					<?php
							echo "<br>";
							echo "<br>";
							echo "<br>";
							$lista_scuole = $this->model->getAllScuole();
							var_dump($lista_scuole);
							foreach ($lista_scuole as $lista) {
								echo $lista->nome_scuola;
							}
						?>
				</div>
				<div class="pure-controls">
					<button type="submit" class="pure-button pure-button-primary" name="aggiunta_studente">Invia</button>
				</div>
			</fieldset>
		</form>
	</div>
</body>
</html>