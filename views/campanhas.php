<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/campanha.css'>



<div id='submenucampanha' style="z-index:1;">
    <a href="<?php echo BASE_URL; ?>/campanhas\listCampanhas">
        <div class="btsubmenuoperadora" data-toggle="tooltip" data-placement="bottom" title="Campanhas">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/list.png'>
        </div>
    </a>
    <a href="<?php echo BASE_URL; ?>/group">
        <div class="btsubmenuoperadora" data-toggle="tooltip" data-placement="bottom" title="Grupos">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/teamwork.png'>
        </div>
    </a>
    <a href="<?php echo BASE_URL; ?>/tabulacao">
        <div class="btsubmenuoperadora" data-toggle="tooltip" data-placement="bottom" title="Tabulações">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/checked.png'>
        </div>
    </a>

    <a href="<?php echo BASE_URL; ?>/rotas" >
        <div class="btsubmenuoperadora btrotas" data-toggle="tooltip" data-placement="bottom" title="Rotas">
            <img class="imgbtsubmenuoperadora"src='<?php echo BASE_URL; ?>/assets/images/lcr.png'>
        </div>
    </a>
    



    <div class="title2">
        <?php echo $viewData['title2']; ?>
    </div>

</div>
