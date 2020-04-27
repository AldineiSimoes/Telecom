<?php
include 'views/relatorios.php';
?>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<div id='divrelCustos'>Custos
    <div id='custosPrincipal'>Custos
        <div class='divform'>
            <form method="POST" id="formcustos" >
                <table>
                    <tr>
                        <td>Data Inicio:</td>
                        <td class='td2'><input name="data_inicio" type=date value="<?php echo date('Y-m-d'); ?>"></td>
                    </tr>
                    <tr>
                        <td>Data Fim:</td>
                        <td class='td2'><input name="data_fim" type=date value="<?php echo date('Y-m-d'); ?>"></td>
                    </tr>
                    <tr>
                        <td>Operação:</td>
                        <td class='td2'>
                            <select name="oper" id="oper" required>
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
                            <select name="grupo" id="grcustos" required>
                                <option  value="0">TODOS</option>
                                <?php foreach ($group_list as $l): ?>
                                    <option id="grcustos" value="<?php echo $l['id_grupo']; ?>">
                                        <?php echo $l['descricao']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Operadora:</td>
                        <td class='td2'>
                            <select name="operadora" id="operadoraCustos" required>
                            <option  value="0">TODOS</option>
                                <?php foreach ($operadoras_list as $l): ?>
                                    <option id="grcustos" value="<?php echo $l['ID_OPERADORA']; ?>">
                                        <?php echo $l['OPE_DESC']; ?>
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
                        <td colspan=2 class="tdvazio"></td>
                    </tr>
                    <tr>
                        <td colspan=2 class="btbuscar btbuscar3"><input class="btbuscar btbuscar2" type="submit" value="LOCALIZAR"></td>
                    </tr>
                </table>
            </form>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report.js"></script>
        </div>
    </div>
    <div id="resumoCustos"></div>
</div>