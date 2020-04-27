<div class="panel panel-primary">
    <div class="panel-heading w-100 text-center">DISCADORES</div>
    <table class="tbdiscadores table " id="tbdiscadores">
        <tr>
            <th class="tdlistcampanha">Código</th>
            <th class="tdlistcampanha">Discador</th>
            <th class="tdlistcampanha">Campanha</th>
            <th class="tdlistcampanha">Grupo</th>
            <th class="tdlistcampanha tdtrash">Ação</th>
        </tr>
        <?php foreach ($discadores_list as $l): ?>
            <tr class="lineDisc">
                 <td class="tdage" id="selAg">
                    <!--<a href="#" onclick="selDiscador(<?php echo $l['ID_DISCADOR']; ?>)">-->
                        <?php echo $l['ID_GRUPO']; ?>
                    </a>
                </td> 
                <td class="tdage"><?php echo substr($l['CONF_DESC'],0,20); ?></td>
                <td class="tdage"><?php echo substr($l['CAMPANHA'],0,20); ?></td>
                <td class="tdage"><?php echo substr($l['GRUPO'],0,15); ?></td>
                <td class="tdexcluir" class="text-center">
                    <a href="#" onclick="selDiscador(<?php echo $l['ID_DISCADOR']; ?>)" title="Editar">
                                    <img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 20px;" >
                    </a>
                    <a href=# title="Período Ativo" onclick="periodosDiscador(<?=$l['ID_DISCADOR']?>,<?=$l['ID_GRUPO']?>,<?=$l['ID_CAMPANHA']?>)"> <img class="delete" src="<?php echo BASE_URL; ?>/assets/images/time2.png" style="width: 20px;height: 20px;margin-right: 10px;"></a>
                    <a href=# title="Excluir Discador"> <img class="delete" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;"></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

