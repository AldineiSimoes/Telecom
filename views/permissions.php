<div class="container">
    <br/>
    <div class="tabcontent">
        <div class="tabbody" style="display:block">
            <div class="buttonP">
                <a href="<?php echo BASE_URL; ?>/permissions/add_group"><input type="submit" class="btn btn-primary" value="Adicionar Grupo de Permissão"></a><br/> <br/>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading w-100 text-center">PERMISSÕES</div>
                <table class="table" border="0" width="100%">
                    <tr>
                        <th>Nome do grupo de permissão</th>
                        <th width="160">Ação</th>
                        <?php foreach ($permission_groups_list as $p): ?>
                        <tr>
                            <td><?php echo $p['name']; ?></td>
                            <td width="100">

                                <a href="<?php echo BASE_URL; ?>/permissions/edit_group/<?php echo $p['id']; ?>" ><img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" ><!--<input type="submit" class="btn btn-sm btn-success" value="Editar" style="width:60px !important;margin-top:5px;">--></a>


                                <a href="<?php echo BASE_URL; ?>/permissions/delete_group/<?php echo $p['id']; ?>" onclick="return confirm('Excluir permissão')"><img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;" ><!--<input type="submit" class=" btn-sm btn btn-danger" value="Excluir" style="width:60px !important;margin-top:5px;">--></a>

                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tr>
                </table>
            </div>
        </div>
        <div class="tabbody">
            <div class="button">
                <a href="<?php echo BASE_URL; ?>/permissions/add">Adicionar permissão</a>
            </div>
            <table border="0" width="100%">
                <tr>
                    <th>Nome da permissão</th>
                    <th width="50">Ação</th>
                    <?php foreach ($permission_list as $p): ?>
                    <tr>
                        <td><?php echo $p['name']; ?></td>
                        <td class="button" width="50"><a href="<?php echo BASE_URL; ?>/permissions/delete/<?php echo $p['id']; ?>" onclick="return confirm('Excluir permissão')">Excluir</a></td>
                    </tr>
                <?php endforeach; ?>

                </tr>
            </table>
        </div>
    </div>
</div>