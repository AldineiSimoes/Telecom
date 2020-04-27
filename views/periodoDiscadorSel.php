<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/popup.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/js/jquery.popup.js'>

<br>
<p style="font-size: 18px;"><img class="delete" src="<?php echo BASE_URL; ?>/assets/images/time2.png" style="width: 20px;height: 20px;margin-right: 10px;">Adicionar Novo Periodo</p>
<hr>
<form id="fPeriodoSel" method="POST">
    <div style="width: 90%;margin-left: 3%;">
        <input type="hidden" name="grupo" id="grupoP" value="" />
        <input type="hidden" name="campanha" id="campanha" value="" />
        <?php foreach ($periodo_list as $l): ?>
            <input type="hidden" value="<?= $l['ID_DISCADOR'] ?>" id="idDiscadorPeriodo" name="idDiscadorPeriodo">
            <?php break; ?>
        <?php endforeach ?>
        <select id="pEscolhido" class="form-control" name="periodosel">
            <?php foreach ($lista_periodos as $lp): ?>
                <option  value="<?= $lp['ID_PERIODO'] ?>"><?= $lp['PER_DESC'] ?> | <?= $lp['PER_HR_INICIO'] ?> | <?= $lp['PER_HR_FIM'] ?></option>
            <?php endforeach; ?>
                
        </select>
        <br/>
        <table class="table" style="margin-bottom:0px;">
            <thead>
                <tr>
                    <td colspan="" style="background-color: #FFFFFF">
                        <div class="checkbox icheck-primary"  >
                            <input type="checkbox" id="seg" value="1" name='dias[]'/>
                            <label for="seg">Seg</label>
                        </div>
                        <div class="checkbox icheck-primary">
                            <input type="checkbox" id="ter" value="2" name='dias[]' />
                            <label for="ter">Ter</label>
                        </div>
                        <div class="checkbox icheck-primary">
                            <input type="checkbox" id="qua" value="3" name="dias[]" />
                            <label for="qua">Qua</label>
                        </div>
                    </td>
                    <td colspan=""style="background-color: #FFFFFF">
                        <div class="checkbox icheck-primary">
                            <input type="checkbox" id="qui" value="4" name="dias[]" />
                            <label for="qui">Qui</label>
                        </div>
                        <div class="checkbox icheck-primary"  >
                            <input type="checkbox" id="sex" value="5" name="dias[]" />
                            <label for="sex">Sex</label>
                        </div>
                        <div class="checkbox icheck-primary">
                            <input type="checkbox" id="sab" value="6" name="dias[]" />
                            <label for="sab">Sab</label>
                        </div>
                    </td>
                    <td colspan="" style="background-color: #FFFFFF">
                        <div class="checkbox icheck-primary">
                            <input type="checkbox" id="dom" value="7" name="dias[]">
                            <label for="dom">Dom</label>
                        </div>
                        <br/>
                        <a href="#" onclick="savePeriodoDiscadorSel()"   class="btn btn-primary" style="width:100px;margin-left:5px;">Salvar</a>
                    </td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <br/>

</form>
<br>
<div class="PeriodoSel panel panel-primary" style="z-index:0;width: 90%;margin-left: 3%;">
    <div class="panel-heading w-100 text-center">Períodos Discador</div>

    <table class="table" sty>
        <thead>
            <tr class="cabecalho">
                <td class="td1">Dia</td>
                <td class="td1">Periodo</td>
                <td class="td1">Ativo</td>
                <td class="td1">Ação</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($periodo_list as $l): ?>
            <tr class="cabecalho" id="tr<?=$l['id_configperiododiscador']?>">
                    <td ><?php echo $l['dia']; ?></td>
                    <td><?php echo $l['per_desc']; ?></td>
                    <td><?php echo ($l['ativo']) ? 'Sim' : '<span class="nao">Não</span>'; ?></td>
                    <td>
                        <!--                            <a href="#" onclick="" title="Editar">
                                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 20px;" >
                                                    </a>-->
                        <a href=# title="Excluir" onclick="delPeriodoDiscador(<?=$l['id_configperiododiscador']?>)">
                         <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;"  ><!--<img src='<?php echo BASE_URL; ?>/assets/images/delete.png' class="delete">-->
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
