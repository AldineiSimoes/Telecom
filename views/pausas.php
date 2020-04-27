<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/cadencia.css'>


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
                <div class="panel-heading w-100 text-center" id="contemLog">PAUSAS</div>
                <table class="tblistoperadoras table">
                    <thead class="thead-inverse">
                        <tr>
                            <th class="tdlistoperadora">Descrição</th>
                            <th class="tdlistoperadora">Ativo</th>
                            <th class="tdlistoperadora tdtrash">Ação</th>
                        </tr>
                    </thead>
                    <?php foreach ($pausas_list as $l): ?>
                        <tr>
                            <td>
                                <?php echo $l['mp_desc']; ?></a>
                            </td>
                            <td><?php echo ($l['ativo'] == 1) ? 'SIM' : 'NÃO'; ?></td>
                            <td class="tdtrash">
                                <a href="#" onclick="selPausa(<?php echo $l['id_motivopausa']; ?>)" title="Editar">
                                    <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >
                                </a>
                                <a title="Excluir" href="<?php echo BASE_URL; ?>/pausas/delete/<?php echo $l['id_motivopausa']; ?>" onclick="return confirm('Excluir pausa ?')">
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
            <form id="formPausa">
                <div class="PeriodoSel panel panel-primary">
                    <div class="panel-heading w-100 text-center" id="contemLog">NOVO | EDITAR</div>
                    <input type="hidden" id="idpausa" name="idpausa" value="0" class="form-control">
                    <table class="table">
                        <tr>
                            <td class="td1">Descrição</td>
                            <td class='td2'><input id="descPausa" name="descPausa" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="td1">Ativo</td>
                            <td class='td2' >
                                <select id="ativoPausa" name="ativoPausa" class="form-control">
                                    <option value="1">SIM</option>
                                    <option value="0">NÃO</option>
                                </select>
                            </td>
                        </tr>

                    </table>
                </div>
                <input id="savePausa" class="form-control btn-primary w-25" type="submit" value="SALVAR">
            </form>
        </div>
    </div>
</div>


