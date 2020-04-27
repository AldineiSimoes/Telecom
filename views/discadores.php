<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css'>
<style>
    body{
        overflow-x: auto !important;
        overflow-y: auto !important;
    }

</style>


<?php
include 'views/discador.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="container">
    <div class="row">
        <div id="discadores" class="col-lg-12">
            <br> 
            <br>
            <br>
            <form id="fDisc">
                <select id="selDisc" name="selDisc" class="form-control w-25">
                    <option value="1">Ativos</option>
                    <option value="0">Inativos</option>
                </select>
            </form>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div id="listadiscadores">
            </div>        


        </div>
        <div id="discadores" class="col-lg-6">
            <form id="formDiscador">
                <div class="panel panel-primary">
                    <div class="panel-heading w-100 text-center">NOVO | EDITAR</div>
                    <input type="hidden" name="iddiscador" id="iddiscador" value="0" class="form-control">
                    <table class="table">
                        <tr>
                            <td class="td1">Descrição</td>
                            <td><input type="text" name="nome" id="nome" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Campanha</td>
                            <td>
                                <select name="camp" id="campgrupo" class="form-control" required>
                                    <option  value="0">Todas</option>
                                    <?php foreach ($campanha_list as $c): ?>
                                        <option id="opcamp" value="<?php echo $c['ID_CAMPANHA']; ?>">
                                            <?php echo $c['CAMP_DESC']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Grupo</td>
                            <td>
                                <select id="grupo" name="grupo" class="form-control">
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Tipo Discador</td>
                            <td>
                                <select class="form-control" id="tpDisc" name="tpDisc">
                                    <option value="1">Discador</option>
                                    <option value="2">URA Mensagem</option>
                                    <option value="3">URA Reversa</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="td1">Servidor</td>
                            <td>
                                <select name="servidor" id="servidor" class="form-control" required>
                                    <?php foreach ($server_list as $l): ?>
                                        <option id="srv" value="<?php echo $l['ID_SERVIDOR']; ?>">
                                            <?php echo $l['SERV_DESC']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>

                    </table>
                </div>
                <button class="btn btn-primary w-25">Salvar</button>
            </form>
        </div>
    </div>
</div>
<div id="idDetalhar" class="divDetalhar text-center" style="overflow-y: visible!important;">
    <img id="loadingGIF" class="loadingGIF"src="<?php echo BASE_URL ?>/assets/images/loading.gif" style="display:block;"/> <br/>
</div>
<div id="fade" class="black_overlay" onclick="exitDivDetalhar()" ></div>
<script>$('#selDisc').change()</script>