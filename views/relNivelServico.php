<?php
include 'views/relatorios.php';
?>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<div id='custosPrincipal'>Nivel de Serviço Receptivo
    <div class='divform'>
        <form method="POST" id="formNivelServico">
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
                        <select name="operacao" id="operacao" required>
                            <?php foreach ($operacao_list as $l): ?>
                              <option id="opLIST" value="<?php echo $l['ID_TIPOOPERACAO']; ?>">
                                    <?php echo $l['TO_DESC']; ?>
                              </option>
                            <?php endforeach; ?>
                            </select>
                    </td>
                </tr> -->
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
                    <td>Serviço:</td>
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
        <div class="PeriodoSel panel panel-primary" id="nivelServico" style="width: 1700px;">
            <div class="panel-heading  text-center">Nivel de Serviço Receptivo</div>
            <table id="tb1" style="text-align: center;font-size:12px;" class="table w-100" >
                <thead>
                <tr class="cabecalho"  >
                    <td >DATA</td>
                    <td >TOTAL RECEBIDAS</td>
                    <td >TOTAL NÃO ATENDIDAS</td>
                    <td >TOTAL ATENDIDAS</td>
                    <td >ATENDIDAS EM AtÉ 20 Seg</td>
                    <td >ATENDIDAS ENTRE 21 a 40 Seg</td>
                    <td >ATENDIDAS ENTRE 41 a 60 Seg</td>
                    <td >ATENDIDAS ENTRE 61 a 120 Seg</td>
                    <td >ATENDIDAS ACIMA DE 120 Seg</td>
                    <td >TEMPO TOTAL DE ATENDIMENTO</td>
                    <td >TEMPO TOTAL DE ESPERA EM FILA</td>
                    <td >TMA</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- <div class="container" id="divdetalhe" style="font-size: 28;font-weight: bold;display:none;" >
        <a href="#" id="exportaNivel" onclick="openPopupNivel()">
            <img src="<?php echo BASE_URL; ?>/assets/images/excel_icon_2003_32px.png">
            Detalhes
        </a>
    </div> -->
</div>
