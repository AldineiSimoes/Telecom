<?php
include 'views/campanhas.php';
?>
<div class="container" style="z-index:0;">
    <div class="row">
        <div id="divSelCond">
        </div>
        <div id="" class="col-lg-12">
            <br/>
            <br/>
            <br/>
            <form id="fCamp">
                <select id="selCamp" name="selCamp" class="form-control w-25">
                    <option value="1">Ativos</option>
                    <option value="0">Inativos</option>
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading w-100 text-center">CAMPANHAS</div>
                <table class="tblistcampanha table" id="tbcampanha">
                    <thead class="thead-inverse">
                        <tr>
                            <th class="tdlistcampanha">Campanha</th>
                            <th class="tdlistcampanha">Dt. Inicio</th>
                            <th class="tdlistcampanha">Dt. Fim</th>
                            <th class="tdlistcampanha tdtrash">Ação</th>
                        </tr>
                    <thead>
                    <tbody style="font-size: 12px;">
                        <?php foreach ($campanhas_list as $l): ?>
                            <tr class="lineCamp">
                                <td>
                                    <?php echo $l['CAMP_DESC']; ?>
                                </td>
                                <td><?php echo date("d/m/Y", strtotime($l['CAMP_DT_INICIO'])); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($l['CAMP_DT_FIM'])); ?></td>
                                <td class="tdtrash">
                                    <a href="#" title="Editar">
                                        <img onclick="selCampanha(<?php echo $l['ID_CAMPANHA']; ?>)" class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >
                                    </a>
                                    <a title="Excluir" href="<?php echo BASE_URL; ?>/campanhas/delete/<?php echo $l['ID_CAMPANHA']; ?>" onclick="return confirm('Excluir campanha ?')">
                                        <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class=" col-lg-6" >
            <form id="formCampanha">
                <div class="panel panel-primary">
                    <div class="panel-heading w-100 text-center">NOVO | EDITAR</div>
                    <table class="table">
                        <tr>
                            <td class="td1">Nome da Campanha</td>
                            <td class='td2'><input id="nome" name="nome" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Data Inicio</td>
                            <td class='td2'><input id="data_inicio" name="data_inicio" type="date" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Data Fim</td>
                            <td class='td2'><input id="data_fim" name="data_fim" type="date" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Ativo</td>
                            <td class='td2'>
                                <select id="ativo" name="ativo" class="form-control">
                                    <option value="1">SIM</option>
                                    <option value="0">N�O</option>
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
</div>