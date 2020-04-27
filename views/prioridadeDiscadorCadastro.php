<div id="prioridadeCadastro">
-        <div id="prioridade" class="col-lg-6">
            <form id="formPrioridade">
                <div class="panel panel-primary">
                    <div class="panel-heading w-100 text-center">NOVO | EDITAR</div>
                    <input type="hidden" name="idprioridade" id="idprioridade" value="0" class="form-control">
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
                            <td class="td1"><label for="parametro"></label>&nbsp;&nbsp;&nbsp;&nbsp;Tipo </td>
                            <td>
                                <input style="width:15px; height:15px;" type="radio" name="IND_TIPO" id="IND_TIPOT" value="0">Tipo &nbsp;&nbsp;&nbsp;&nbsp;
                                <input style="width:15px; height:15px;" type="radio" name="IND_TIPO" id="IND_TIPOH" value="1"> Horário &nbsp;&nbsp;&nbsp;&nbsp;
                                <input style="width:15px; height:15px;" type="radio" name="IND_TIPO" id="IND_TIPOU" value="2"> UF &nbsp;&nbsp;&nbsp;&nbsp;
                                <input style="width:15px; height:15px;" type="radio" name="IND_TIPO" id="IND_TIPOA" value="3"> Arquivo
                            </td>
                        </tr>
                    </table>
                </div>
                <button class="btn btn-primary w-25">Salvar</button>
            </form>
        </div>
</div>

<script>
    $('#campgrupo').on('change', function () {
        idcamp = $('#campgrupo').val();
        $('.gr').remove();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/group/selGrupos/' + idcamp,
            dataType: 'json',
            success: function (json) {
                if (json.group.length > 0) {
                    var html = '<option class="gr" id="opgrupo" value="0">Todos</option>';
                    $('#grupo').append(html);
                    for (var i in json.group) {
                        var html = '<option class="gr" id="opgrupo" value="' + json.group[i].id_grupo + '">' +
                                json.group[i].descricao +
                                '</option>';
                        $('#grupo').append(html);
                    }
                }
            }
        });
    });
</script>