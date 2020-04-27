
<form id="fGruposAgente" method="POST">
    <div class="" style="width: 90%;margin-top:5%;margin-left: 5%; margin-right: 5%;" >
<!--        <div class="panel-heading text-center w-100">GRUPOS</div>-->
        <input type="hidden" name="agente" id="agente" value="<?php echo $agente; ?>" />
        <table id="tbGrupoAgentes" style="text-align: center;font-size:12px;" class="table w-100 tbGruposAgentes" >
            <thead>
            <tr class="cabecalho"  >
                <td >Grupos</td>
                <td >Seleção</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($gruposAgente as $l): ?>

                <tr style="width: 400px;" >
                    <td ><?php echo $l['id_grupo'].' - '.$l['descricao']; ?></td>
                    <?php
                        if ($l['id_agente']>0) {
                            //$det = '<label class="checkbox-inline" for="p_' . $l['id_grupo'] . '">' .'<input class="checkbox" type="checkbox" name="grupos[]" checked="checked" value="'. $l['id_grupo'].'" id="p_'. $l['id_grupo'].'">';
                            $det = '<div class="checkbox icheck-primary">'
                                    .'<input type="checkbox" checked="checked" name="grupos[]" value="'. $l['id_grupo'].'" id="p_'.$l['id_grupo'].'">'
                                    .'<label for="p_'.$l['id_grupo'].'" style="color:#EEE9E9;">*</label>'
                                    .'</div>';
                        } else {
                            //$det = '<label class="checkbox-inline" for="p_' . $l['id_grupo'] . '">' .'<input  class="checkbox" type="checkbox" name="grupos[]" value="'. $l['id_grupo'].'" id="p_'. $l['id_grupo'].'">';
                            $det = '<div class="checkbox icheck-primary">'
                                    .'<input type="checkbox" name="grupos[]" value="'. $l['id_grupo'].'" id="p_'.$l['id_grupo'].'">'
                                    .'<label for="p_'.$l['id_grupo'].'"></label>'
                                    .'</div>';
                        }
                    ?>
                    <td ><?php echo $det; ?></td>
            </tr> 
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="javascript:void(0)" onclick="saveGrupoAgente()"><input style="margin-left: 5%;margin-top:2%;" value="SALVAR E SAIR" type="button"  class="btn btn-primary w-25"></a>
</form>



<script>
$(document).ready(function() {
    $('#tbGrupoAgentes').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
       },
        "scrollY":        400,
//        "scrollCollapse": true,
        "paging":         false
    });
});
</script>