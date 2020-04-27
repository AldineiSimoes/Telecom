<?php
include 'views/relatorios.php';
?>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<div id='custosPrincipal'>Tabulações

	<div class='divform'>
		<form method="POST" id="formTabulacao">
			<table>
				<tr>
					<td>Período de:</td>
					<td class='td2'><input name="data_inicio" type=date value="<?php echo date('Y-m-d'); ?>"></td>
				</tr>
				<tr>
  					<td></td>
					<td class='td2'><input name="hora_inicio" type=time value="00:00:00"></td>
				</tr>
				<tr>
					<td>Até:</td>
					<td class='td2'><input name="data_fim"type=date value="<?php echo date('Y-m-d'); ?>"></td>
				</tr>
				<tr>
  					<td></td>
					<td class='td2'><input name="hora_fim" type=time value="23:59:00"></td>
				</tr>
				<tr>
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
				</tr>
				<tr>
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
					<td>Grupo:</td>
					<td class='td2'>
						<select name="grupo" id="grupo" required>
     					  <option class="gr" value="0">TODOS</option>
						<?php foreach ($group_list as $l): ?>
						  <option id="opgrupo" class="gr" value="<?php echo $l['id_grupo']; ?>">
														 <?php echo $l['descricao']; ?>
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
					<td>Tabulação:</td>
					<td class='td2'>
						<select name="tipotab" id="tipotab" required>
     					  <option  value="0">TODOS</option>
						<?php foreach ($tipotab_list as $l): ?>
						  <option id="optipotab" value="<?php echo $l['idtipo']; ?>">
														 <?php echo $l['desctipo']; ?>
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
					<td>Ficha</td>
					<td class='td2'><input name="id"></td>
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
<div style="margin-top:70px;position: fixed;left:320px;z-index: 1; height: 500px;width: 1024px; overflow-x:auto;overflow-y:auto;">
	<div id='relResumo1' class="w-100">
		<div class="PeriodoSel panel panel-primary" id="tabulacaoDetalhe" style="width: 1700px;">
		</div>
	</div>
</div>
