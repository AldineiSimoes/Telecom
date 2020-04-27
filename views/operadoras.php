<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>


<div id="submenuoperadora" style="z-index:1">
    <a href="<?php echo BASE_URL; ?>/operadoras" title="Operadoras">
        <div class="btsubmenuoperadora btoperadoras" data-toggle="tooltip" data-placement="bottom" title="Operadoras">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/list.png'>
        </div>
    </a>

    <a href="<?php echo BASE_URL; ?>/cadencia" title="Cadência">
        <div class="btsubmenuoperadora btcadencia" data-toggle="tooltip" data-placement="bottom" title="Cadência">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/cadence.png'>
        </div>
    </a>

    <a href="<?php echo BASE_URL; ?>/regras" title="Regras">
        <div class="btsubmenuoperadora btregras" data-toggle="tooltip" data-placement="bottom" title="Regras">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/rulesop.png'>
        </div>
    </a>

    <a href="<?php echo BASE_URL; ?>/tarifas" title="Tarifas">
        <div class="btsubmenuoperadora bttarifas" data-toggle="tooltip" data-placement="bottom" title="Tarifas">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/coin.png'>
        </div>
    </a>


</div>


<div id="divSelCond">
</div>
<div class="container">
    <div class="row">

        <div id="" class="col-lg-12">
            <br/>
            <br/>
            <br/>
            <form id="selCond">
                <select id="selectCond" name="selectCond" class="form-control">
                    <option value="1">Ativos</option>
                    <option value="2">Inativos</option>
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="PeriodoSel panel panel-primary w-100" style="z-index:2">
                <div class="panel-heading w-100 text-center" id="contemLog">OPERADORAS</div>
                <table class="tblistoperadoras table table-hover" id="tboperadoras">
                    <thead class="thead-inverse">
                        <tr>
                            <th class="tdlistoperadora">Operadora</th>
                            <th class="tdlistoperadora">CSP</th>
                            <th class="tdlistoperadora">Tech-Prefix</th>
                            <th class="tdlistoperadora">Host</th>
                            <th class="tdlistoperadora">Canais</th>
                            <th class="tdlistoperadora tdtrash text-center">Ação</th>
                        </tr>
                    <thead>
                        <?php foreach ($operadoras_list as $op): ?>
                            <tr class="lineOper" scope="row">
                                <td>
                                        <?php echo $op['OPE_DESC']; ?>
                                </td>
                                <td><?php echo $op['OPE_CSP']; ?></td>
                                <td><?php echo $op['OPE_TECHPREFIX']; ?></td>
                                <td><?php echo $op['OPE_IP1']; ?></td>
                                <td><?php echo $op['OPE_MAXCANAIS']; ?></td>
                                <td class="tdtrash">
                                    <a href="#" onclick="selOperadora(<?php echo $op['ID_OPERADORA']; ?>)" data-toggle="tooltip" title="Editar">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >
                                    </a>
                                    <a data-toggle="tooltip" title="Excluir" href="<?php echo BASE_URL; ?>/operadoras/delete/<?php echo $op['ID_OPERADORA']; ?>" onclick="return confirm('Excluir operadora ?')">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;" >
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>

        <div class="col-lg-6" style="z-index:0" >
            
            <form id="formOperadora">
                <div class="panel panel-primary">
                    <div class="panel-heading w-100 text-center">NOVO | EDITAR</div>
                    <input id="idoperadora" name="idoperadora" type="hidden" value="0" class="form-control">
                    <table class="table" >
                        <tr>
                            <td class="td1">Nome</td>
                            <td class='td2'><input id="nome" name="nome" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Apelido</td>
                            <td class='td2'><input id="apelido" name="apelido" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Host 1</td>
                            <td class='td2' >
                                <input id="ip1" name="host1" class="form-control" required>

                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Host 2</td>
                            <td class='td2'>
                                <input id="ip2" name="host2" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Tech-Prefix</td>
                            <td class='td2'>
                                <input id="tech" name="tech" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Max. Canais</td>
                            <td class='td2'><input id="canais" name="canais" value="0" maxlength='3' class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">CSP</td>
                            <td class='td2'><input id="csp"  name="csp" maxlength='9' class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">CSP Chamd. Locais</td>
                            <td class='td2'>
                                <select id="local" name="csplocal" class="form-control">
                                    <option value="1">SIM</option>
                                    <option value="0">NÃO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Ativo</td>
                            <td class='td2'> 
                                <select id="ativo" name="ativo" class="form-control">
                                    <option value="1">SIM</option>
                                    <option value="0">NÃO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">IP SDP Op.</td>
                            <td class='td2'>
                                <input id="ip" name="ip" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Área Prestadora</td>
                            <td class='td2'>
                                <input id="area" name="area" value="11" maxlength='2' class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Pública Rede Interna</td>
                            <td class='td2'>
                                <select id="publica" name="publica" class="form-control">
                                    <option value="1">SIM</option>
                                    <option value="0">NÃO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Regra de Disc. Local</td>
                            <td class='td2'>
                                <select class="optionformop form-control" id="regralocal" name="regralocal">
                                    <option value="1">E.164</option>
                                    <option value="2">0+OPE+DDD+TELEFONE</option>
                                    <option value="3">OPE+DDD+TELEFONE</option>
                                    <option value="4">DDD+TELEFONE</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Regra de Disc. LDN</td>
                            <td class='td2'>
                                <select class="optionformop form-control" id="regraldn" name="regraldn">
                                    <option>E.164</option>
                                    <option>0+OPE+DDD+TELEFONE</option>
                                    <option>OPE+DDD+TELEFONE</option>
                                    <option>DDD+TELEFONE</option>
                                </select>
                            </td>
                        </tr>



                    </table>
                </div>
                <input id="save" class="form-control btn-primary w-25" type="submit" value="SALVAR">
            </form>


        </div>
    </div>
</div>

