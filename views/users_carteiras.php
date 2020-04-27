<form id="fUserCarteiras" method="POST">
    <div class="" style="width: 90%;margin-top:5%;margin-left: 5%; margin-right: 5%;" >
<!--        <div class="panel-heading text-center w-100">GRUPOS</div>-->
        <input type="hidden" name="user" id="user" value="<?php echo $user; ?>" />
        <table id="tbUserCarteiras" style="text-align: center;font-size:12px;" class="table w-100 tbGruposAgentes" >
            <thead>
            <tr class="cabecalho"  >
                <td >Carteira</td>
                <td >Seleção</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userCamp as $l): ?>

                <tr style="width: 400px;" >
                    <td ><?php echo $l['ID_CAMPANHA'].' - '.$l['CAMP_DESC']; ?></td>
                    <?php
                        if ($l['ID_USUARIO']>0) {
                            //$det = '<label class="checkbox-inline" for="p_' . $l['id_grupo'] . '">' .'<input class="checkbox" type="checkbox" name="grupos[]" checked="checked" value="'. $l['id_grupo'].'" id="p_'. $l['id_grupo'].'">';
                            $det = '<div class="checkbox icheck-primary">'
                                    .'<input type="checkbox" checked="checked" name="camp[]" value="'. $l['ID_CAMPANHA'].'" id="p_'.$l['ID_CAMPANHA'].'">'
                                    .'<label for="p_'.$l['ID_CAMPANHA'].'" style="color:#EEE9E9;">*</label>'
                                    .'</div>';
                        } else {
                            //$det = '<label class="checkbox-inline" for="p_' . $l['id_grupo'] . '">' .'<input  class="checkbox" type="checkbox" name="grupos[]" value="'. $l['id_grupo'].'" id="p_'. $l['id_grupo'].'">';
                            $det = '<div class="checkbox icheck-primary">'
                                    .'<input type="checkbox" name="camp[]" value="'. $l['ID_CAMPANHA'].'" id="p_'.$l['ID_CAMPANHA'].'">'
                                    .'<label for="p_'.$l['ID_CAMPANHA'].'"></label>'
                                    .'</div>';
                        }
                    ?>
                    <td ><?php echo $det; ?></td>
            </tr> 
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="javascript:void(0)" onclick="saveUserCarteiras()"><input style="margin-left: 5%;margin-top:2%;" value="SALVAR E SAIR" type="button"  class="btn btn-primary w-25"></a>
</form>



<script>
$(document).ready(function() {
    $('#tbUserCarteiras').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
       },
        "scrollY":        400,
//        "scrollCollapse": true,
        "paging":         false
    });
});
</script>