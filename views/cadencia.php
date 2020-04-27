<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/cadencia.css'>


<div id="submenuoperadora" style="z-index:1">
    <a href="<?php echo BASE_URL; ?>/operadoras" title="Operadoras">
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



</div>
<div class="container">
    <div class="row">
        <div id="" class="col-lg-6">
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>

            <div class="PeriodoSel panel panel-primary">
                <div class="panel-heading w-100 text-center" id="contemLog">CADÊNCIA</div>
                <table class="tblistoperadoras table">
                    <thead class="thead-inverse">
                        <tr>
                            <th class="tdlistoperadora">Descrição</th>
                            <th class="tdlistoperadora">Ativo</th>
                            <th class="tdlistoperadora tdtrash">Ação</th>
                        </tr>
                    <thead>
                        <?php foreach ($cadencia_list as $l): ?>
                            <tr>
                                <td>
                                        <?php echo $l['CAD_DESC']; ?></a>
                                </td>
                                <td><?php echo ($l['ATIVO'] == 1) ? 'SIM' : 'NÃO'; ?></td>
                                <td class="tdtrash">
                                    <a href="#" onclick="selCadencia(<?php echo $l['ID_CADENCIA']; ?>)" title="Editar">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >
                                    </a>
                                    <a title="Excluir" href="<?php echo BASE_URL; ?>/cadencia/delete/<?php echo $l['ID_CADENCIA']; ?>" onclick="return confirm('Excluir cadencia ?')">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="col-lg-6" style="z-index:0;">
            <form id="formCadencia">
                <div class="PeriodoSel panel panel-primary">
                    <div class="panel-heading w-100 text-center" id="contemLog">NOVO | EDITAR</div>
                    <table class="table">
                        <tr>
                            <td class="td1">Descrição</td>
                            <td class='td2'><input id="descCadencia" name="descCadencia" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Ativo</td>
                            <td class='td2' >
                                <select id="ativoCadencia" name="ativoCadencia" class="form-control">
                                    <option value="1">SIM</option>
                                    <option value="0">NÃO</option>
                                </select>
                            </td>
                        </tr>

                    </table>
                </div>
                <input id="saveCadencia" class="form-control btn-primary w-25" type="submit" value="SALVAR">
            </form>
        </div>
    </div>
</div>


