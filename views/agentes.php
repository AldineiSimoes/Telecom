
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/agentes.css'>
<link href="<?php echo BASE_URL; ?>/assets/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/bootstrap-multiselect.css'>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>

<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/supervisor.js"></script> -->




<div id='submenuagentes' style="z-index:1">
    <a href=# title="Agentes">
        <div class="btsubmenuoperadora" data-toggle="tooltip" data-placement="bottom" title="Agentes">
            <img class="imgbtsubmenuoperadora" src='<?php echo BASE_URL; ?>/assets/images/list.png'>
        </div>
    </a>

</div>
<div id="" class="container">
    <div class="row">
        <br/>
        <br/>
        <br/>

        <div class="col-lg-12">
            <form id="selCondAgents" >
                <select id="selectCondAgents" name="selectCondAgents" class="form-control w-25">
                    <option value="1">Ativos</option>
                    <option value="2">Inativos</option>
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div id="divexibeagentes" class="col-lg-6 agentesbarra">
            <div class="PeriodoSel panel panel-primary">
                <div class="panel-heading w-100 text-center" id="contemLog">AGENTES</div>
                <table class="tblistagentes table" id="tbAgents">
                    <thead class="thead-inverse">
                        <tr>
                            <th class="tdlistagente corfundo">Nome</th>
                            <th class="tdlistagente corfundo">Login</th>
                            <th class="tdlistagente corfundo">Ação</th>

                        </tr>
                    </thead>
                    <?php foreach ($agents_list as $list): ?>
                        <tr class="lineAgents">
                            <td class="tdage"><?php echo $list['nome']; ?></a></td>
                            <td class="tdage"><?php echo $list['username']; ?></td>
                            <td class="tdexcluir">
                                <a title="GRUPOS" href="#" onclick="grupoAgente(<?php echo $list['id']; ?>)">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/group.png"  style="width: 20px;height: 20px;margin-right: 20px;">
                                    </a>
                                <a href="#" onclick="selAgente(<?php echo $list['id']; ?>)" title="Editar">
                                    <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 20px;" >
                                </a>
                                <a href=# title="Excluir">
                                 <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;"  ><!--<img src='<?php echo BASE_URL; ?>/assets/images/delete.png' class="delete">-->
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </table>
            </div>
        </div>




        <div id="" class="col-lg-6 ">
            <form id="formAgentes">
                <div class="PeriodoSel panel panel-primary">
                    <div class="panel-heading w-100 text-center" id="contemLog">NOVO | EDITAR</div>
                    <input id="idag" name="idag" value="0" type="hidden">
                    <table class="table">

                        <tr>
                            <td class="td1">Nome</td>
                            <td class='td2'><input id="nome" name="nome" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">CPF</td>
                            <td class='td2'><input id="cpf" name="cpf" class="form-control" maxlength="11"></td>
                        </tr>
                        <tr>
                            <td class="td1">Ramal</td>
                            <td class='td2'><input id="ramal" name="ramal" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Login</td>
                            <td class='td2'><input id="login" name="login" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Senha</td>
                            <td class='td2'><input id="senha" name="senha" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Confirmação</td>
                            <td class='td2'><input id="senha1" name="senha1" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Localidade</td>
                            <td class='td2' >
                                <select id="localAgente" name="localAgente" class="form-control">
                                    <?php foreach ($local_agente as $la): ?>
                                        <option value="<?php echo $la['ID_LOCALAGENTE']; ?>"><?php echo $la['LOC_DESC']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Tipo Ramal</td>
                            <td class='td2' >
                                <select id="tipoRamal" name="tipoRamal" class="form-control">
                                    <?php foreach ($tipo_ramal as $tr): ?>
                                        <option value="<?php echo $tr['ID_TIPORAMAL']; ?>"><?php echo $tr['TR_DESC']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
<!--                        <tr>
                            <td class="td1">Grupo</td>
                            <td>
                                <select id="example-getting-started" multiple="multiple">
                                    <option value="1">GROUP1</option>
                                    <option value="2">GROUP2</option>
                                    <option value="3">GROUP3</option>
                                </select>
                            </td>
                        </tr>-->
                        <tr>
                            <td class="td1">Ativo</td>
                            <td class='td2'>
                                <select id="ativo" name="ativo" class="form-control">
                                    <option value="1">SIM</option>
                                    <option value="0">NÃO</option>
                                </select>
                            </td>
                        </tr>

                    </table>
                </div>
                <input class="btn btn-primary w-25" type="submit" value="SALVAR">

                </fieldset>
            </form>
        </div>
    </div>
</div>

<div id="pop" class="white_content">
    
    <img class="loadingGIF"src="<?php echo BASE_URL?>/assets/images/loading.gif" /> <br/>
            <a href="javascript:void(0)" onclick="exitDivDetalhar()"><input style="margin-left: 5%" value="SALVAR E SAIR" type="button" class="w-25 btn btn-primary"></a>
            
       
</div>
<div id="fade" class="black_overlay" onclick="exitDivDetalhar()"></div>
<div class="divDetalhar" id="idDetalhar" style="padding-right: 1%;">
    <a href="#" onclick="exitDivDetalhar()">Sair</a>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect({
            buttonWidth: '100%',
            enableFiltering: true,
            includeSelectAllOption: true,
            maxHeight: 600,
            dropUp: true,
            buttonClass: 'form-control'
                      
        });
    });
</script>