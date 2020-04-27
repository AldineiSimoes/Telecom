<?php header("Content-type: text/html; charset=utf-8"); ?>
<div class="container text-center">

    </br>
    <form method="POST" id"f1">
        <div class="panel panel-primary">
            <div class="panel-heading text-center w-100">PERMISSÕES - EDITAR GRUPO</div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br/>
                    <label for="name">Nome do grupode permissões</label><br>
                    <strong><input style="margin-left: 25%" type="text" name="name" value="<?php echo $group_info['name'] ?>" class="form-control w-50 text-center text-uppercase font-weight-bold"/></strong><br><br>
                </div>
            </div>


            <!--	<label><h1>Permissões</h1></label>
    <br/>-->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $gr = '';
                    $det = '';
                    $fim = 1;
                    foreach ($permission_list as $p) {
                        if ($gr != $p['descricao']) {
                            if ($fim == 1) {
                                $fim = 0;
                            } else {
                                $fim = 1;
                            }
                            if ($fim == 1) {
                                $det = $det . '<br><br/>
				  </div>
				  </div>';
                                echo $det;
                                $det = '';
                                $fim = 0;
                            }
                            $det = '<div class="col-lg-4">
                            <div class="panel panel-primary text-center" id="filaSel" style="z-index:0;">
                            <div class="panel-heading w-100 text-center">' . htmlentities($p['descricao']) . '</div>';
                            $gr = $p['descricao'];
                            $det = $det . '<br>';
                        };
                        if (in_array($p['id'], $group_info['params'])) {
                            $det = $det . '<label class="checkbox-inline" for="p_' . $p['id'] . '">' . '<input type="checkbox" name="permissions[]" value="' . $p['id'] . '" id="p_' . $p['id'] . '"' .
                                    'checked="checked"';
                        } else {
                            $det = $det . '<label class="checkbox-inline" for="p_' . $p['id'] . '">' . '<input type="checkbox" name="permissions[]" class="" value="' . $p['id'] . '" id="p_' . $p['id'] . '"';
                        }
                        $det = $det . '/>' . htmlentities($p['name']) . '</label>';
                        // $det = $det . '<label class="checkbox-inline" for="p_' . $p['id'] . '">' . htmlentities($p['name']) . '</label>' . ' ';
                    };
                    if ($fim == 0) {
                        $det = $det . '<br/><br/>
		  </div>
		  </div>';
                        echo $det;
                    }
                    ?>
                </div>
            </div>
        </div>

        <br>


        <div class="col-lg-12">

            <input type="submit" value="Salvar" class="btn btn-primary"> <br/></br><br/><br/>
        </div>
    </form>
</div>
