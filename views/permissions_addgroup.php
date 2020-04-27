
<div class="container text-center">

    <br/>
    <form method="POST">
        <div class="panel panel-primary">
            <div class="panel-heading text-center w-100">PERMISSÕES - ADICIONAR GRUPO</div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br/>
                    <label for="name">Nome do grupo de permissões</label>:
                    <strong><input type="text" name="name" class="form-control text-center text-uppercase w-50" style="margin-left: 25%"/></strong><br>
                </div>
            </div>
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
                        $det = $det . '<label class="checkbox-inline" for="p_' . $p['id'] . '">' . '<input type="checkbox" name="permissions[]" class="" value="' . $p['id'] . '" id="p_' . $p['id'] . '"';

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
                    <br/><br/>
                </div>
            </div>
            <div class="col-lg-12">
                <br/>
                <input type="submit" value="Adicionar" class="btn btn-primary">

                <br/><br/>
            </div>
        </div>
    </form>
</div>