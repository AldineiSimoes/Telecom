<table id="tb2" class="table">
<thead>
    <tr class="cabecalho">
        <td class="td1">DESCRICAO</td>
        <td class="td1">CAMPANHA</td>
        <td class="td1">GRUPO</td>
        <td class="td1">TIPO</td>
        <td class="td1">HORARIO INICIAL</td>
        <td class="td1">HORARIO FINAL</td>
        <td class="td1">DIAS DA SEMANA</td>
        <td class="td1">STATUS</td>
        <td class="td1">AÇÕES</td>
    </tr>
    </thead>
    <tbody id="Listagem">
    <?php foreach($prioridadeList as $l): ?>
        <tr class="detalhe">
            <td><?php echo $l['DSC_PRIORIDADE']; ?></td>
            <td><?php echo $l['CAMPANHA']; ?></td>
            <td><?php echo $l['GRUPO']; ?></td>
            <td><?php echo $l['TIPO']; ?></td>
            <td><?php echo $l['TIM_INICIAL']; ?></td>
            <td><?php echo $l['TIM_FINAL']; ?></td>
            <?php $sem = $this->semana($l['COD_PRIORIDADE']);?>
            <td>
            <?php foreach($sem as $s): ?>
                <?php echo $s['semana'] ; ?>
            <?php endforeach; ?>
            </td>
            <td class="tdtrash"><a href="#" onclick="setPrioridade(<?php echo $l['COD_PRIORIDADE']; ?>,<?php echo $l['COD_ATIVO']; ?>)">
            <?php if ($l['COD_ATIVO']==1): ?>
                <img class="imgtrash" data-toggle="tooltip" title="Ativo" src="<?php echo BASE_URL; ?>/assets/images/esfera_verde_claro.png" style="width: 20px;height: 20px;margin-right: 30px;" />
            <?php endif ; ?>
            <?php if ($l['COD_ATIVO']==0): ?>
                <img data-toggle="tooltip" title="Inativo"  src="<?php echo BASE_URL; ?>/assets/images/esfera_vermelho.png" style="width: 20px;height: 20px;margin-right: 30px;" />
            <?php endif; ?>
            </a></td>
            <td class="tdtrash">
                <a href="#" onclick="selPrioridade(<?php echo $l['COD_PRIORIDADE']; ?>)" data-toggle="tooltip" title="Editar">
                    <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
