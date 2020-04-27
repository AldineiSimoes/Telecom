<?php
include 'views/relatorios.php';
?>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<div id='custosPrincipal'>Desempenho do Grupo
    <div class='divform'>
        <form method="POST" id="formDesempnhoGrupo">
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
                    <td>Operação:</td>
                    <td class='td2'>
                        <select name="operacao" id="operacao" required>
                            <?php foreach ($operacao_list as $l): ?>
                              <option id="opLIST" value="<?php echo $l['ID_TIPOOPERACAO']; ?>">
                                    <?php echo $l['TO_DESC']; ?>
                              </option>
                            <?php endforeach; ?>
                            </select>
                    </td>
                </tr>
                <tr>
                    <td>Campanha:</td>
                    <td class='td2'>
                        <select name="camp" id="camp" required>
                            <option  value="0">Todas</option>
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
                        <select name="grupo" id="grupo">
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
        <div id='relResumo1' class="w-100">
            <div class="PeriodoSel panel panel-primary" id="resumoGrupo" style="width: 2000px;">
                <div class="panel-heading  text-center">Desenpenho dos Grupo</div>
                <table id="tb1" style="text-align: center;font-size:12px;" class="table w-100" >
        			<thead>
                    <tr class="cabecalho"  >
                        <td >HORA</td>
                        <td >LOGADOS</td>
                        <td >DISPAROS</td>
                        <td >AT.RAMAL</td>
                        <td style="width: 400px;">%&nbsp;&nbsp;</td>
                        <td >NÃƒO ATENDIDA</td>
                        <td style="width: 400px;">%&nbsp;&nbsp; </td>
                        <td >OCUPADO</td>
                        <td style="width: 400px;">%&nbsp;&nbsp; </td>
                        <td >NÃƒO EXISTE</td>
                        <td style="width: 400px;">%&nbsp;&nbsp; </td>
                        <td >FORA DE SERVIÃ‡O</td>
                        <td style="width: 400px;">%&nbsp;&nbsp; </td>
                        <td >CX.POSTAL</td>
                        <td style="width: 400px;">%&nbsp;&nbsp; </td>
                        <td >CANCELADAS</td>
                        <td style="width: 400px;">%&nbsp;&nbsp; </td>
                        <td >ABANDONO RAMAL</td>
                        <td style="width: 400px;">%&nbsp;&nbsp; </td>
                        <td >ABANDONO FILA</td>
                        <td style="width: 400px;">&nbsp;%&nbsp; </td>
                        <td >NO AGENT</td>
                        <td style="width: 400px;">&nbsp;%&nbsp; </td>
                    </tr>
                    </thead>
                </table>
        </div>
    </div>
</div>
