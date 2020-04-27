<?php
include 'views/relatorios.php';
?>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<div id="divrelligacoes" >
    <div id='custosPrincipal'>Ligações

        <div class='divform'>
            <form method="GET" id="formreligacoes" onsubmit="return setReportLig(this)">
                <table class="table">
                    <tr>
                        <td>Data Inicio:</td>
                    </tr>
                    <tr>
			            <td class='td2'><input name="data_inicio" type=date value="<?php echo date('Y-m-d'); ?>"></td>
			            <td class='td2'><input name="hora_inicio" type=time value="00:00:00"></td>
                    </tr>
                    <tr>
                        <td>Data Fim:</td>
                    </tr>
                    <tr>
                        <td class='td2' width="100"><input name="data_fim"type=date value="<?php echo date('Y-m-d'); ?>"></td>
			            <td class='td2'><input name="hora_fim" type=time value="23:59:00"></td>
                    </tr>
                    <tr>
                        <td>Operação:</td>
			            <td class='td2'>
                            <select name="oper" id="oper" required>
            				<?php foreach ($operacao_list as $c): ?>
                                <option value="<?php echo $c['ID_TIPOOPERACAO']; ?>">
                                	 <?php echo $c['TO_DESC']; ?>
				                </option>
				            <?php endforeach; ?>
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
                        <td>Operadora:</td>
                        <td class='td2'>
                            <select name="OperadoraLig" id="operadoraLig" required>
                                <option  value="0">TODOS</option>
                                <?php foreach ($operadoras_list as $l): ?>
                                    <option id="ligOperadora" value="<?php echo $l['ID_OPERADORA']; ?>">
                                        <?php echo $l['OPE_DESC']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <!-- <tr>
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
                        <td colspan=2 style="background-color:#B03060"></td>
                    </tr>
                    <tr>
                        <td colspan=2 class="btbuscar btbuscar3"><input class="btbuscar btbuscar2" type="submit" value="LOCALIZAR"></td>
                    </tr>

                </table>
            </form>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report.js"></script>
        </div>

    </div>
	<div class="container divarealig">
       <div id="areaLigacoes" class="container"></div>
   </div>
</div>