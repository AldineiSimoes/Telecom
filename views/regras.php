<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/regras.css'>

<div id="submenuoperadora" style="z-index:1">
    <a href="<?php echo BASE_URL; ?>/operadoras" title="Operadoras" >
        <div class="btsubmenuoperadora btoperadoras">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/list.png'>
        </div>
    </a>

    <a href="<?php echo BASE_URL; ?>/cadencia" title="Cadência">
        <div class="btsubmenuoperadora btcadencia">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/cadence.png'>
        </div>
    </a>

    <a href="<?php echo BASE_URL; ?>/regras" title="Regras">
        <div class="btsubmenuoperadora btregras">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/rulesop.png'>
        </div>
    </a>

    <a href="<?php echo BASE_URL; ?>/tarifas" title="Tarifas">
        <div class="btsubmenuoperadora bttarifas">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/coin.png'>
        </div>
    </a>

<!--	<a href="<?php echo BASE_URL; ?>/rotas" title="Rotas">
        <div class="btsubmenuoperadora btrotas">
                <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/lcr.png'>
        </div>
</a>-->

</div>
<div class="container">
    <div class="row">
        <div id="" class="col-lg-6">
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>

            <div class="">
                <div class="PeriodoSel panel panel-primary">
                    <div class="panel-heading w-100 text-center" id="contemLog">REGRAS</div>
                    <table class="tblistoperadoras table">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="tdlistoperadora">Descrição</th>
                                <th class="tdlistoperadora">Dt. Inicio</th>
                                <th class="tdlistoperadora">Dt. Fim</th>
                                <th class="tdlistoperadora">Ativo</th>
                                <th class="tdlistoperadora tdtrash text-center">Ação</th>
                            </tr>
                        <thead>
                            <?php foreach ($regras_list as $l): ?>
                                <tr>
                                    <td><?php echo $l['REG_DESC']; ?></a></td>
                                    <td><?php echo date("d/m/y", strtotime($l['REG_INICIO'])); ?></td>
                                    <td><?php echo date("d/m/y", strtotime($l['REG_FIM'])); ?></td>
                                    <td><?php echo ($l['ATIVO'] == 1) ? 'SIM' : 'NÃO'; ?></td>
                                    <td class="trash">
                                    <a href="#" onclick="selRegra(<?php echo $l['ID_REGRAOPERADORA']; ?>)" title="Editar">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >
                                    </a>
                                        <a title="Excluir" href="<?php echo BASE_URL; ?>/regras/delete/<?php echo $l['ID_REGRAOPERADORA']; ?>" onclick="return confirm('Excluir regra ?')">
                                            <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        <br/>
        <div class="formoperadora col-lg-6" style="z-index:0">
            <form id="formRegra">
                <div class="PeriodoSel panel panel-primary">
                    <div class="panel-heading w-100 text-center" id="contemLog">NOVO | EDITAR</div>
                    <table class="table">
                        <tr>
                            <td class="td1">Operadora</td>
                            <td class="td2">
                                <select id="operadoraRegra" name="operadoraRegra" class="form-control">
                                    <?php foreach ($operadoras_list as $l): ?>
                                        <option class="form-control" value='<?php echo $l['ID_OPERADORA']; ?>'><?php echo $l['OPE_DESC']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Descrição</td>
                            <td class='td2'><input id="descrRegra" name="descrRegra" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Data Inicial</td>
                            <td class='td2'><input id="dtiRegra" name="dtiRegra" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Hr. Inicio</td>
                            <td class='td2'><input id="hriRegra" name="hriRegra" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Data Final</td>
                            <td class='td2'><input id="dtfRegra" name="dtfRegra" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Hr. Fim</td>
                            <td class='td2'><input id="hrfRegra" name="hrfRegra" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Casas Decimais</td>
                            <td class='td2'><input id="casasRegra" name="casasRegra" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Ativo</td>
                            <td class='td2'>
                                <select id="ativoRegra" name="ativoRegra" class="form-control">
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <input id="saveRegra" class="form-control btn-primary w-25" type="submit" value="SALVAR">

                </fieldset>
            </form>
        </div>
    </div>
</div>