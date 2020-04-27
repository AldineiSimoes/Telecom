<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css'>

<div class="formoprota col-lg-12" style="z-index:0;">
    <form id="fRota" method="POST">
        <!--        <fieldset>
                    <legend>Troca de Rotas</legend>-->
        <div class="panel panel-primary">
            <div class="panel-heading w-100 text-center">TROCA DE ROTAS</div>
            <table>
                <thead >
                    <tr>
                        <td class="td1">Modalidade</td>
                        <td class="td1">Operadoras 1</td>
                        <td class="td1">Operadoras 2</td>
                        <td class="td1">Operadoras 3</td>
                        <td class="td1">Operadoras 4</td>
                        <td class="td1">Operadoras 5</td>
                    </tr>
                <thead>
                    <?php foreach ($mod_list as $m): ?>
                        <tr>
                            <td class='td2'>
                                <?php echo $m['MOD_DESC']; ?>
                                <input type="hidden" name="modalidade[]" id="modalidade" value="<?php echo $m['ID_MODALIDADE']; ?>">
                            </td>
                            <td class='td2'>
                                <select name="oper[]" class="selOp" id="group11" required>
                                    <option value="0"></option>
                                    <?php
                                    foreach ($operadoras_list as $l) {
                                        $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " >" . $l['OPE_DESC'] . "</option>";
                                        foreach ($rota_info as $r) {
                                            if ($r['ID_MODALIDADE'] == $m['ID_MODALIDADE']) {
                                                if ($l['ID_OPERADORA'] == $r['ID_OPERADORA']) {
                                                    $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " selected='selected'>" . $l['OPE_DESC'] . "</option>";
                                                };
                                            };
                                        };
                                        echo $cbOperadora;
                                    };
                                    ?>
                                </select>
                            </td>
                            <td class='td2'>
                                <select name="oper[]" class="selOp " id="group12" required>
                                    <option value="0"></option>
                                    <?php
                                    foreach ($operadoras_list as $l) {
                                        $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " >" . $l['OPE_DESC'] . "</option>";
                                        foreach ($rota_info as $r) {
                                            if ($r['ID_MODALIDADE'] == $m['ID_MODALIDADE']) {
                                                if ($l['ID_OPERADORA'] == $r['ID_OPE_TRANSBORDO_1']) {
                                                    $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " selected='selected'>" . $l['OPE_DESC'] . "</option>";
                                                };
                                            };
                                        };
                                        echo $cbOperadora;
                                    };
                                    ?>
                                </select>
                            </td>
                            <td class='td2'>
                                <select name="oper[]" class="selOp " id="group13" required>
                                    <option value="0"></option>
                                    <?php
                                    foreach ($operadoras_list as $l) {
                                        $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " >" . $l['OPE_DESC'] . "</option>";
                                        foreach ($rota_info as $r) {
                                            if ($r['ID_MODALIDADE'] == $m['ID_MODALIDADE']) {
                                                if ($l['ID_OPERADORA'] == $r['ID_OPE_TRANSBORDO_2']) {
                                                    $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " selected='selected'>" . $l['OPE_DESC'] . "</option>";
                                                };
                                            };
                                        };
                                        echo $cbOperadora;
                                    };
                                    ?>
                                </select>
                            </td>
                            <td class='td2'>
                                <select name="oper[]" class="selOp " id="group14" required>
                                    <option value="0"></option>
                                    <?php
                                    foreach ($operadoras_list as $l) {
                                        $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " >" . $l['OPE_DESC'] . "</option>";
                                        foreach ($rota_info as $r) {
                                            if ($r['ID_MODALIDADE'] == $m['ID_MODALIDADE']) {
                                                if ($l['ID_OPERADORA'] == $r['ID_OPE_TRANSBORDO_3']) {
                                                    $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " selected='selected'>" . $l['OPE_DESC'] . "</option>";
                                                };
                                            };
                                        };
                                        echo $cbOperadora;
                                    };
                                    ?>
                                </select>
                            </td>
                            <td class='td2'>
                                <select name="oper[]" class="selOp " id="group15" required>
                                    <option value="0"></option>
                                    <?php
                                    foreach ($operadoras_list as $l) {
                                        $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " >" . $l['OPE_DESC'] . "</option>";
                                        foreach ($rota_info as $r) {
                                            if ($r['ID_MODALIDADE'] == $m['ID_MODALIDADE']) {
                                                if ($l['ID_OPERADORA'] == $r['ID_OPE_TRANSBORDO_4']) {
                                                    $cbOperadora = "<option value=" . $l['ID_OPERADORA'] . " selected='selected'>" . $l['OPE_DESC'] . "</option>";
                                                };
                                            };
                                        };
                                        echo $cbOperadora;
                                    };
                                    ?>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>


            </table>
        </div>
        <input id="btnRota" onclick="return saveRota()" class="form-control btn-primary w-25" type="submit" value="SALVAR">
        
    </form>
</div>
