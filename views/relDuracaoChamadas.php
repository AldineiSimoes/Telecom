<?php
include 'views/relatorios.php';
?>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<div id='custosPrincipal'>Duração das Chamadas

	<div class='divform'>
		<form method="POST" id="formDuracaoChamadas">
			<table>
				<tr>
					<td>Data Inicio:</td>
					<td class='td2'><input name="data_inicio" type=date value="<?php echo date('Y-m-d'); ?>"></td>
				</tr>
				<tr>
					<td>Data Fim:</td>
					<td class='td2'><input name="data_fim"type=date value="<?php echo date('Y-m-d'); ?>"></td>
				</tr>
				<tr>
					<td>Grupo:</td>
					<td class='td2'>
						<select name="grupo" id="grupo" required>
     					  <option  value="0">TODOS</option>
						<?php foreach ($group_list as $l): ?>
						  <option id="opgroup" value="<?php echo $l['id_grupo']; ?>">
														 <?php echo $l['descricao']; ?>
						  </option>
						<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan=2 class="tdvazio"></td>
				</tr>
				<tr>
					<td colspan=2 class="btbuscar btbuscar3"><input class="btbuscar btbuscar2" type="submit" value="LOCALIZAR"></td>
				</tr>

			</table>
		</form>
	</div>

</div>
<div id='duracaoChamadas'>
</div>
