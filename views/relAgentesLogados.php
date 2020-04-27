<?php
include 'views/relatorios.php';
?>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<div id='custosPrincipal'>Agentes Logados

	<div class='divform'>
		<form method="POST" id="formAgentesLogados">
			<table>
				<tr>
					<td>Data Inicio:</td>
					<td class='td2'><input name="data_inicio" type=date value="<?php echo date('Y-m-d'); ?>"></td>
				</tr>
				<tr>
					<td>Data Fim:</td>
					<td class='td2'><input name="data_fim"type=date value="<?php echo date('Y-m-d'); ?>"></td>
				</tr>
				<!-- <tr>
					<td>Operação:</td>
					<td class='td2'>
						<select name="oper" id="oper" required>
     					  <option  value="0">AMBOS</option>
     					  <option  value="1">ATIVO</option>
     					  <option  value="2">RECEPTIVO</option>
     					  <option  value="3">EVENTO</option>
     					  <option  value="4">MONITORIA</option>
						</select>
					</td>
				</tr> -->
				<!-- <tr>
					<td>Campanha:</td>
					<td class='td2'>
						<select name="camp" id="camp" required>
     					  <option  value="0">TODOS</option>
						<?php foreach ($campanha_list as $c): ?>
						  <option id="opcamp" value="<?php echo $c['ID_CAMPANHA']; ?>">
														 <?php echo $c['CAMP_DESC']; ?>
						  </option>
						<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Agente:</td>
					<td class='td2'>
						<select name="agents" id="agents" required>
     					  <option  value="0">TODOS</option>
						<?php foreach ($agents_list as $a): ?>
						  <option id="opag" value="<?php echo $a['id']; ?>">
														 <?php echo $a['nome']; ?>
						  </option>
						<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>DDD:</td>
					<td class='td2'><input name="ddd" maxlength='2'></td>
				</tr>
				<tr>
					<td>Telefone:</td>
					<td class='td2'><input  name="fone" maxlength='9'></td>
				</tr>
				<tr>
					<td>ID</td>
					<td class='td2'><input name="id"></td>
				</tr> -->
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
<div id="agentesView">
</div>
