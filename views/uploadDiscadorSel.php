<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css'>
<hr>

<div class="filaSel panel panel-primary " id="filaSel" style="z-index:0;">
    <div class="panel-heading w-100 text-center">FILAS ATIVAS</div>
    <!-- <input type="hidden" value="" name="arquivo" id="arquivo" /> -->

    <table class="table text-center">
        <thead>
            <tr class="cabecalho">
                <td>Arquivo</td>
                <td>Qtd.</td>
                <td>Status</td>
                <td>Ação</td>
                <td>Exportar</td>
                <td>Excluir</td>
            </tr>
        </thead>
        <tbody>
        <div class="col-lg-8">
            <?php foreach ($mailing_list as $l): ?>
                <tr class="detalhe">
            
                <td><a href="#" onclick="resumoMailing(<?php echo $l['grupo']; ?>,<?php echo $l['id']; ?>)"><?php echo substr($l['nome_arquivo'],0,35); ?></a></td>
                <td><?php echo $l['QTD']; ?></a></td>
                <td><?php echo ($l['estado']) ? 'Parado' : '<span class="nao">Discando</span>'; ?></td>
                <td>
                    <a href=# onclick="setMailing(<?php echo $l['id']; ?>,0)" title="Discar Mailing"><img src="<?php echo BASE_URL; ?>/assets/images/play-button.png" class="delete" style="width:20px;heith:20px;"></a>
                    <a href=# onclick="setMailing(<?php echo $l['id']; ?>,1)" title="Pausar Mailing"><img src="<?php echo BASE_URL; ?>/assets/images/pause.png" class="delete" style="width:20px;heith:20px;"></a>
                </td>
                <td class="text-center"><a href=#><img src="<?php echo BASE_URL; ?>/assets/images/csv.png" class="delete" style="width:20px;heith:20px;"></a></td>
                <td class="text-center"><a href=#" onclick="delMailing(<?php echo $l['id']; ?>,<?=$l['grupo'];?>)"><img src="<?php echo BASE_URL; ?>/assets/images/trash.png" class="delete" style="width:20px;heith:20px;"></a></td>
            
            </tr>
        <?php endforeach; ?>
        </div>
        </tbody>
    </table>

</div>

