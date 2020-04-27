<!DOCTYPE html>
<html>
    <head>
        <title> Portal Gennex</title>
        <link href="<?php echo BASE_URL; ?>/assets/css/estilo.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
    </head>
    <body>
        <div class="topo">
            <div class="logo">
                <img src="<?php echo BASE_URL; ?>/assets/images/logo.png" width="250" heigth="100">
            </div>
            <div class="topoint">
                <div class="toprigth"><a href="<?php echo BASE_URL.'/login/logout'; ?>">Sair</a></div>
                <div class="toprigth">Ola, <?php echo $viewData['user_name']; ?></div>
            </div>
        </div>
        <div class="leftmenu">
            <div class="menuarea">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>">Home</a> </li>
                    <li><a href="<?php echo BASE_URL.'/permissions'; ?>">Permissões</a> </li>
                    <li><a href="<?php echo BASE_URL.'/users'; ?>">Usuarios</a> </li>
                </ul>
            </div>
        </div>
        <div class="area">
            <?php $this->loadViewinTemplate($viewName,$viewData); ?>;
        </div>
    </body>
</html>