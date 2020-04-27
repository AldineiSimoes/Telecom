<div class="col-lg-6" >
    <div class="panel panel-primary" style="padding-bottom: 0px;">
        <div class="panel-heading w-100 text-center">TABULAÇÕES CADASTRADAS</div>
        <table class="tblistGroup table" id="tblistGroup" style="margin-bottom: 0px;">
            <thead class="thead-inverse">
                <tr>
                    <th class="tdlistcampanha">ID</th>
                    <th class="tdlistcampanha">Descrição</th>
                    <th class="tdlistcampanha tdtrash">Ação</th>
                </tr>
            <thead>
                <?php foreach ($tab_list as $l): ?>
                    <tr class="lineGroup" id="tr<?php echo $l['codtabulacao']; ?>">
                        <td> <?php echo $l['codtabulacao']; ?></td>
                        <td>
                            <?php echo $l['descricao']; ?>
                        </td>
                        <td class="tdtrash">
                            
                            <a title="Desativar" href="#" onclick="delTab(<?php echo $l['codtabulacao']; ?>)">
                                <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/cancel.png"  style="width: 20px;height: 20px;">
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
</div>

<div class="col-lg-6" style="z-index:0;">
    <form id="addTab" method="POST">
        <div class="panel panel-primary">
            <div class="panel-heading w-100 text-center">NOVO | EDITAR</div>
            <input type="hidden" id="idcampanha" name="idcampanha" value="0">
            <table class="table">
                <thead class="thead-inverse">
                    <tr><td class="tdlistcampanha">Codigo</td>
                        <td><input type="text" id="txtID" name="cod" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="tdlistcampanha">Descrição</td>
                        <td class=""><input type="text" id="txtDescTab" name="descricao" class="form-control"></td>
                    </tr>
                <thead>
                <tbody>
                    <!--<tr>
                        <td class="tdlistcampanha">Campanha</td>
                        <td>
                            <select id="campanha" name="campanha" class="w-100 btn btn-default dropdown-toggle js-example-basic-multiple" >
                                <option value=""></option>
                                <?php foreach ($campanha_list as $c): ?>
                                    <option value="<?php echo $c['ID_CAMPANHA']; ?>"><?php echo $c['ID_CAMPANHA']; ?> | <?php echo $c['CAMP_DESC']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>-->
                    <tr>
                        <td class="tdlistcampanha">Tipo</td>
                        <td>
                            <select id="campanha" name="tipo" class="w-100 btn btn-default dropdown-toggle js-example-basic-multiple" >
                                <option value=""></option>
                                <?php foreach ($tipotab_list as $c): ?>
                                    <option value="<?php echo $c['idtipo']; ?>"><?php echo $c['desctipo']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <a href="#" onclick="addTabulacao() "class="btn btn-primary">Incluir<a/>
    </form>
</div>
