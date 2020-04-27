
<form id="fAgentesGrupo" method="POST">
    <div class="" style="width: 90%;margin-top:5%;margin-left: 5%" >
        <input type="hidden" name="grupo" id="grupo" value="<?php echo $grupo; ?>" />
        <table id="tb1" style="text-align: center;font-size:12px;" class="table w-100 tbGruposAgentes" >
            <thead>
                <tr class="cabecalho"  >
                    <td >Agentes</td>
                    <td >Seleção</td>
                    <!-- <td >Status</td> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($agentesGrupo as $l): ?>

                    <tr style="width: 400px;" >
                        <td ><?php echo $l['nome']; ?></td>
                        <?php
                        if ($l['id_grupo'] > 0) {
                          //  $det = '<label class="checkbox-inline" for="p_' . $l['id'] . '">' . '<input class="checkbox" type="checkbox" name="agentes[]" checked="checked" value="' . $l['id'] . '" id="p_' . $l['id'] . '">';
                            $det = '<div class="checkbox icheck-primary">'
                                    .'<input type="checkbox" checked="checked" name="agentes[]" value="' . $l['id'] . '" id="p_' . $l['id'] . '">'
                                    .'<label for="p_' . $l['id'] . '" style="color: #EEE9E9 ;">*</label>'
                                    .'</div>';
                            $sel = 'Selecionado';
                        } else {
                            //$det = '<label class="checkbox-inline" for="p_' . $l['id'] . '">' . '<input  class="checkbox" type="checkbox" name="agentes[]" value="' . $l['id'] . '" id="p_' . $l['id'] . '">';
                            $det = '<div class="checkbox icheck-primary">'
                                    .'<input type="checkbox" name="agentes[]" value="' . $l['id'] . '" id="p_' . $l['id'] . '">'
                                    .'<label for="p_' . $l['id'] . '"></label>'
                                    .'</div>';
                            $sel = '';
                                }
                        ?>
                        <td ><?php echo $det; ?></td>
                        <!-- <td ><?php echo $sel; ?></td> -->
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="javascript:void(0)" onclick="saveAgentesGrupo()"><input style="margin-left: 5%;margin-top:2%;" value="SALVAR E SAIR" type="button"  class="btn btn-primary w-25"></a>
</form>

<!-- <script>
    $('#fGruposAgente').on('submit', function (e) {
        e.preventDefault();
        var param = $('#fGruposAgente').serialize();
        alert('Parametros '+ param);
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/agentes/saveGruposAgente',
            data: param,
            dataType: 'text',
            success: function (response) {

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Erro ao associar grupos')
            }
        });
        document.getElementById('pop').style.display='none';
        document.getElementById('fade').style.display='none';
    })

</script> -->

        <script>
            $(document).ready(function() {
                    $('#tb1').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
                    //        "scrollY":        "200px",
                    //        "scrollCollapse": true,
                            "paging":         false,
                            scrollY: 400
        });
            });
        </script>
