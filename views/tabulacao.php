<?php require_once("campanhas.php"); ?>


<div class="container">
    <div class="row">

        <div id="divSelCond">
        </div>
        <div id="" class="col-lg-6">
            <br/>
            <br/>
            <br/>
            <form id="formTabulação">
                <label>Campanha: </label>
                <select id="campanha" name="campanha" class="w-75 btn btn-default dropdown-toggle js-example-basic-multiple" >
                    <option value=""></option>
                    <?php foreach ($campanha_list as $c): ?>
                        <option value="<?php echo $c['ID_CAMPANHA']; ?>"><?php echo $c['ID_CAMPANHA']; ?> | <?php echo $c['CAMP_DESC']; ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        <!--        <div id="" class="col-lg-3">
                    <br/>
                    <br/>
                    <br/>
                    <form id="fGroup">
                        <label>Status</label>
                        <select id="selDisc" name="selGroup" class="form-control">
                            <option value="1">Ativos</option>
                            <option value="0">Inativos</option>
                        </select>
                    </form>
                </div>-->
    </div>
    <div class="row" id="divtabulacao" >
    </div>
