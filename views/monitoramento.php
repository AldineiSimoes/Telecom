<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/supervisor.js"></script>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/monitoramento.css'>
<div id="submenumonitoramento" style="z-index:1">
    <a href="#"  title="Monitora Grupos Ativos">
        <div  class="btsubmenumonitora btgrupoAtivo" data-toggle="tooltip" data-placement="bottom" title="Monitora Grupos Ativos">
            <img  onclick="monitoraAtivos()" class="imgbtsubmenumonitora"src='<?php echo BASE_URL; ?>/assets/images/grupoAtivo.png'>
        </div>
    </a>

    <a href="#" title="Monitora Grupos Receptivo">
        <div class="btsubmenumonitora btgrupoRec" data-toggle="tooltip" data-placement="bottom" title="Monitora Grupos Receptivo">
            <img onclick="monitoraReceptivo()" class="imgbtsubmenumonitora"src='<?php echo BASE_URL; ?>/assets/images/grupoRec.png'>
        </div>
    </a>

</div>
<br>
<br>
<div id="monitora">
</div>
