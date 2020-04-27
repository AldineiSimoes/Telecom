<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/tarifas.css'>

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

<!--<a href="<?php echo BASE_URL; ?>/rotas" title="Rotas">
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
            <br/>
            <div class="PeriodoSel panel panel-primary">
                <div class="panel-heading w-100 text-center" id="contemLog">TARIFAS</div>
                <table class="tbtarifas table">
                    <thead class="thead-inverse">
                        <tr>
                                <!--<th class="tdlistoperadora">Regra</th>-->
                            <th class="tdlistoperadora">Operadora</th>
                            <th class="tdlistoperadora  text-center">Ação</th>
                            <!--<th class="tdlistoperadora">Modalidade</th>
                            <th class="tdlistoperadora">Valor</th>
                            <th class="tdlistoperadora">Cadência</th>		-->
                        </tr>
                    <thead>
                        <?php foreach ($tarifas_list as $l): ?>
                            <tr>
                                    <!--<td><?php echo $l['Nome_operadora']; ?></td>-->
                                <td><?php echo $l['Nome_operadora']; ?></td>
                                <td class="tdtrash text-center" >
                                    <a href=# onclick="selTarifas(<?php echo $l['ID']; ?>)" title="Editar">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >
                                    </a>
                                    <!-- <a title="Excluir" href="<?php echo BASE_URL; ?>/tarifas/delete/<?php echo $l['ID']; ?>" onclick="return confirm('Excluir tarifa ?')">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;">
                                    </a> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>


        <div class=" col-lg-6" style="z-index:0">
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <form id="frmTarifas" method="POST">
               <input class="form-control" id="id" name="id" value="0" type="hidden">	
                <div class="PeriodoSel panel panel-primary">
                    <div class="panel-heading w-100 text-center" id="contemLog">NOVO EDITAR</div>
                    <table>
                        <tr>
                            <td class="td1">Regra</td>
                            <td class="td1">Valor</td>
                            <td class="td1">Cadência</td>
                        </tr>
                        <tr>
                            <td class='td2'>
                                LOCAL	
                            </td>
                            <td class='td2'>
                                <input class="form-control" id="localVrTar" name="localVrTar">	
                            </td>
                            <td class='td2'>
                                <select name="selcadLocal" class="form-control" id="selcadLocal" required >
                                    <?php foreach ($cadencias_list as $l): ?>
                                        <option value="<?php echo $l['CAD_DESC']; ?>"><?php echo $l['CAD_DESC']; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class='td2'>
                                LDE	
                            </td>
                            <td class='td2'>
                                <input class="form-control"id="ldeVrTar" name="ldeVrTar">	
                            </td>
                            <td class='td2'>
                                <select name="selLde" class="form-control" id="selLde" name="selLde" required>
                                    <?php foreach ($cadencias_list as $l): ?>
                                        <option value="<?php echo $l['CAD_DESC']; ?>"><?php echo $l['CAD_DESC']; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </td>
                        </tr>   
                        <tr>
                            <td class='td2'>
                                LDN	
                            </td>
                            <td class='td2'>
                                <input class="form-control" id="ldnVrTar" name="ldnVrTar">
                            </td>
                            <td class='td2'>
                                <select name="selLdn" class="form-control" id="selLdn"  required>
                                    <?php foreach ($cadencias_list as $l): ?>
                                        <option value="<?php echo $l['CAD_DESC']; ?>"><?php echo $l['CAD_DESC']; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class='td2'>
                                VC1	
                            </td>
                            <td class='td2'>
                                <input class="form-control" id="vc1VrTar" name="vc1VrTar">	
                            </td>
                            <td class='td2'>
                                <select class="form-control" id="selVc1" name="selVc1" required>
                                    <?php foreach ($cadencias_list as $l): ?>
                                        <option value="<?php echo $l['CAD_DESC']; ?>"><?php echo $l['CAD_DESC']; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class='td2'>
                                VC2	
                            </td>
                            <td class='td2'>
                                <input class="form-control" id="vc2VrTar" name="vc2VrTar">
                            </td>
                            <td class='td2'>
                                <select class="form-control" id="selVc2" name="selVc2" required>
                                    <?php foreach ($cadencias_list as $l): ?>
                                        <option value="<?php echo $l['CAD_DESC']; ?>"><?php echo $l['CAD_DESC']; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class='td2'>
                                VC3	
                            </td>
                            <td class='td2'>
                                <input class="form-control" id="vc3VrTar" name="vc3VrTar">
                            </td>
                            <td class='td2'>
                                <select class="form-control" id="selVc3" name="selVc3" required>
                                    <?php foreach ($cadencias_list as $l): ?>
                                        <option value="<?php echo $l['CAD_DESC']; ?>"><?php echo $l['CAD_DESC']; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </td>
                        </tr>
                       
                    </table>
                </div>
                <input class="form-control btn-primary w-25" type="submit" value="SALVAR">
                </fieldset>
            </form>
        </div>
    </div>
</div>