<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/discador.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/discador.js"></script>
<div id='submenudiscador' style="z-index:1 !important;">
    <a href=# title="Discadores">
        <a href="<?php echo BASE_URL; ?>/discador/discadores" title="Discadores">
            <div class="btsubmenuoperadora" data-toggle="tooltip" data-placement="bottom" title="Discadores">
                <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/list.png'>
            </div>
        </a>
        <a href="<?php echo BASE_URL; ?>/discador/periodoDiscador" title="Período">
            <div class="btsubmenuoperadora" data-toggle="tooltip" data-placement="bottom" title="Periodo">
                <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/time.png'>
            </div>
        </a>

        <a href="<?php echo BASE_URL; ?>/discador/parametrosDisacador" title="Parâmetros">
            <div class="btsubmenuoperadora" data-toggle="tooltip" data-placement="bottom" title="Parâmetros">
                <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/controls.png'>
            </div>
        </a>

        <a href="<?php echo BASE_URL; ?>/discador/uploading">
            <div class="btsubmenuoperadora" title="Mailing" data-toggle="tooltip" data-placement="bottom" title="Mailing">
                <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/cloud-upload.png'>
            </div>
        </a>
        <a href="<?php echo BASE_URL; ?>/discador/prioridade">
            <div class="btsubmenuoperadora" title="Prioridade" data-toggle="tooltip" data-placement="bottom" >
                <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/numbered.png'>
            </div>
        </a>
    </a>
    <div class="title2">
        <?php echo $viewData['title2']; ?>
    </div>

</div>

