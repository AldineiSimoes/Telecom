
<?php
include 'views/relatorios.php';
?>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<<link rel="stylesheet" href="/assets/css/agentesel.css"/>

<div id='custosPrincipal'>Desempenho dos Agentes

	<div class='divform'>
		<form method="POST" id="formDesempenhoAgentes">
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
<div id='relResumo' class="w-100">
    <div class="PeriodoSel panel panel-primary" id="idResumo" style="width: 2000px;">
                <div class="panel-heading  text-center">Desenpenho dos Agentes</div>
		<table id='tbDesempenhoAgente' style="text-align: center;font-size:12px;" class="table w-100" >
			<thead>
			<tr class="cabecalho" >
				<td >DATA</td>
				<td >NOME</td>
				<td >PRIMEIRO AT.</td>
				<td >ULTIMO AT</td>
				<td >LOGIN</td>
				<td >LOGOUT</td>
				<td >TEMPO LOGADO</td>
				<td >TOTAL ATENDIDAS</td>
				<td >TOTAL RECEPTIVO</td>
				<td >TOTAL ATIVO MANUAL</td>
				<td >ATENDIDAS ATIVO DISCADOR</td>
				<td >TEMPO FALADO</td>
				<td >TEMPO CLERICAL</td>
				<td >TOTAL PAUSAS</td>
				<td >TEMPO PAUSAS</td>
				<td >TEMPO DISPONIVEL</td>
				<td >TMA</td>
				<td >TME</td>
			

			</tr>
			</thead>
			<tbody>
				
				
			</tbody>
		</table>
    </div>
</div>
</div>
<script>
  dataDoDia();
</script>