

<?php
include 'views/discador.php';
?>
<style>
    body{
        overflow-x: auto !important;
        overflow-y: auto !important;
    }
</style>
<div id="periodo" class="container">
    <div class="row">
        <br>
        <br>
        <!--<div class="col-lg-6">
            <form id="fPeriodo">
                <h3> Discador </h3>
                <select id="selPeriodo" name="selParam" class="form-control w-25" >
                    <option id="periodoDisc1" value="0"></option>
        <?php foreach ($discadores_list as $l): ?>
                            <option id="periodoDisc" value="<?php echo $l['ID_DISCADOR']; ?>">
            <?php echo $l['CONF_DESC']; ?>
                            </option>
        <?php endforeach; ?>
                </select>
            </form>
            <hr>
            <div class="row">
                <div id="periodoList" class="col-lg-12">
                </div>
            </div>
        </div>
        -->
        <div class="col-lg-6">
            <br/>
            <br/>
            <div  class="PeriodoSel panel panel-primary" style="z-index:0;padding-bottom: 0px;">
                <div class="panel-heading w-100 text-center">Períodos Cadastrados</div>
                <table class="table">
                    <thead>
                        <tr>
                            <td class="td1">Dias</td>
                            <td class="td1">Inicio</td>
                            <td class="td1">Fim</td>
                            <td class="td1">Excluir</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_periodos as $l): ?>
                            <tr id="p<?=$l['ID_PERIODO'] ?>">
                                <td><?= $l['PER_DESC'] ?></td>
                                <td><?= $l['PER_HR_INICIO'] ?></td>
                                <td><?= $l['PER_HR_FIM'] ?></td>
                                <td>
                                    <a href=# title="Excluir">
                                        <img class="imgtrash" onclick="delPeriodo(<?= $l['ID_PERIODO'] ?>)" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;"  >
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <br>
            <br>
            <div class="PeriodoSel panel panel-primary" style="z-index:0;padding-bottom: 0px;">
                <div class="panel-heading w-100 text-center">Novo Período</div>


                <form id="fPeriodoAdd" method="post" style="margin-bottom:0px;">
                    <table class="table" style="margin-bottom:0px;">
                        <thead>
                            <tr class="cabecalho">
                                <td class="td1">Descrição</td>
                                <td class="td1">Inicio</td>
                                <td class="td1">Fim</td>
                                <!--<td class="td1">Ativo</td>-->
                            </tr>
                        </thead>
                        <tr>
                            <td><input id="descPeriodo" type="text" class="form-control" name="descPeriodo"></td>
                            <td><input id="inicioPeriodo" type="time" class="form-control" name="inicioPeriodo"></td>
                            <td><input id="fimPeriodo" type="time" class="form-control" name="fimPeriodo"></td>
                            <!--<td><select class="form-control"><option>SIM</option><option>NÃO</option></select></td>-->
                        </tr>
                        <!--<tr>
                            <td colspan="">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="seg" value="1"/>
                                    <label for="seg">Seg</label>
                                </div>
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="ter" value="2" />
                                    <label for="ter">Ter</label>
                                </div>
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="qua" value="3" />
                                    <label for="qua">Qua</label>
                                </div>
                            </td>
                            <td colspan="">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="qui" value="4" />
                                    <label for="qui">Qui</label>
                                </div>
                                <div class="checkbox icheck-primary" value="5">
                                    <input type="checkbox" id="sex" />
                                    <label for="sex">Sex</label>
                                </div>
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="sab" value="6" />
                                    <label for="sab">Sab</label>
                                </div>
                            </td>
                            <td colspan="">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="dom" value="7">
                                    <label for="dom">Dom</label>
                                </div>
                            </td>
                        </tr>-->
                    </table>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100px;margin-left:30px;">Salvar</button>
            </form>
        </div>

    </div>


</div>

