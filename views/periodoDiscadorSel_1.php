<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/popup.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/js/jquery.popup.js'>
<br>
<div class="PeriodoSel panel panel-primary" style="z-index:0;">
    <div class="panel-heading w-100 text-center">Períodos Discador</div>
    <form id="fPeriodoSel" method="POST">
        <table class="table" sty>
            <thead>
                <tr class="cabecalho">
                    <td class="td1">Dia</td>
                    <td class="td1">Periodo</td>
                    <td class="td1">Ativo</td>
                    <td class="td1">Ação</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($periodo_list as $l): ?>
                    <tr class="cabecalho">
                        <td ><?php echo $l['dia']; ?></td>
                        <td><?php echo $l['per_desc']; ?></td>
                        <td><?php echo ($l['ativo']) ? 'Sim' : '<span class="nao">NÃ£o</span>'; ?></td>
                        <td>
                            <a href="#" onclick="" title="Editar">
                                <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 20px;" >
                            </a>
                            <a href=# title="Excluir">
                             <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;"  ><!--<img src='<?php echo BASE_URL; ?>/assets/images/delete.png' class="delete">-->
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>
<input type="submit" value="Salvar" class="btn btn-primary" style="width:100px;margin-left:30px;">
</form>