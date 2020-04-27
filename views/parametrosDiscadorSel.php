<link rel='stylesheet' href='<?php echo BASE_URL;?>/assets/css/bootstrap.min.css'>
<div class="ParaSel" style="z-index:0;">
    <form id="fParamSel" method="POST">
        <fieldset>
            <div class="panel panel-primary">
    			<div class="panel-heading w-100 text-center">PARAMETROS DO DISCADOR</div>
		        <div class="panel-footer">
                    <div class="row">
                        <?php foreach($param_list as $l): ?>
                            <div class="col-lg-8">
                                <?php echo $l['PARAMETROS']; ?>
                                <input type="hidden" name="parametro[]" id="idparam" value="<?php echo $l['ID_CONFIGPARAMETRO']; ?>">
                            </div>
                            <div class="col-lg-4">
                                <input type="text" name="valor[]" id="nome" class="form-control" value="<?php echo $l['VALOR']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div>
                <input id="btnRota" onclick="return saveParamDisc()" class="btn btn-primary" type="submit" value="SALVAR" style="width: 130px;height:40px;margin-top:30px;">
            </div>
        </fieldset>
    </form>
</div>
