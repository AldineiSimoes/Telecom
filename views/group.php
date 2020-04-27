<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<?php
include 'views/campanhas.php';
?>
<div class="container">
    <div class="row">

        <div id="divSelCond">
        </div>
        <div id="" class="col-lg-12">
            <br/>
            <br/>
            <br/>
            <form id="fGroup">
                <select id="selGroup" name="selGroup" class="form-control w-25">
                    <option value="1">Ativos</option>
                    <option value="0">Inativos</option>
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading w-100 text-center">GRUPOS</div>
                <table class="tblistGroup table" id="tblistGroup">
                    <thead class="thead-inverse">
                        <tr>
                            <th class="tdlistcampanha">ID</th>
                            <th class="tdlistcampanha">Descrição</th>
                            <th class="tdlistcampanha tdtrash">Ação</th>
                        </tr>
                    <thead>
                    <tbody style="font-size: 12px;">
                        <?php foreach ($group_list as $l): ?>
                            <tr class="lineGroup">
                                <td> <?php echo $l['id_grupo']; ?></td>
                                <td>
                                    <?php echo $l['descricao']; ?>
                                </td>
                                <td class="tdtrash">
                                    <a title="AGENTES" href="javascript:void(0)" onclick="agentesGrupo(<?php echo $l['id_grupo']; ?>)">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/group.png"  style="width: 20px;height: 20px;margin-right: 20px;">
                                    </a>
                                    <a href="#" onclick="editGroup(<?php echo $l['id_grupo']; ?>)" title="Editar">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 20px;" >
                                    </a>
                                    <a title="Excluir" href="<?php echo BASE_URL; ?>/group/delete/<?php echo $l['id_grupo']; ?>" onclick="return confirm('Excluir grupo ?')">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png"  style="width: 20px;height: 20px;">
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

        <div class="col-lg-6" style="z-index:0;">
            <form id="formGroup">
                <div class="panel panel-primary">
                    <div class="panel-heading w-100 text-center">NOVO | EDITAR</div>
                    <table class="table">
                        <tr>
                            <td class="td1">ID</td>
                            <td class='td2'><input id="idgroup" name="idgroup" value="0" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Campanha</td>
                            <td class='td2'>
                                <select id="campanha" name="campanha" class="form-control" >
                                    <?php foreach ($campanha_list as $c): ?>
                                        <option value="<?php echo $c['ID_CAMPANHA']; ?>"><?php echo $c['CAMP_DESC']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Descrição</td>
                            <td class='td2'><input id="nome" name="nome" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Tempo de Clerical</td>
                            <td class='td2'><input id="clerical" name="clerical" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Fila máxima</td>
                            <td class='td2'><input id="filamax" name="filamax" class="form-control"></td>
                        </tr>
                        <tr>					<tr>
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
                <input id="save" class="btn btn-primary w-25" type="submit" value="SALVAR">
                </div>
            </form>
        </div>
    </div>
    <div id="pop" class="white_content">

        <img class="loadingGIF"src="<?php echo BASE_URL ?>/assets/images/loading.gif" /> <br/>
        <a href="javascript:void(0)" onclick="document.getElementById('pop').style.display = 'none';document.getElementById('fade').style.display = 'none'">Sair</a>


    </div>
    <div id="fade" class="black_overlay" onclick="exitDivDetalhar()"></div>

    <div class="divDetalhar" id="idDetalhar" style="padding-right: 1%;">
        <a href="#" onclick="exitDivDetalhar()">Sair</a>
    </div>

    <!DOCTYPE html>
    <!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->
    <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
        </head>
        <body>
            <?php
            // put your code here
            ?>
        </body>

    </html>
