<html>
    <head>
        <title>:: Gennex :: Portal ::</title>
        <link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/c3.css'>
        <link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/inicio.css'>
        <link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/estilo.css'>
        <link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/supervisor.css'>
        <link rel="shortcut icon" href="<?php echo   BASE_URL; ?>/assets/images/favicon.ico"/>
        <link rel='stylesheet' href='<?php echo BASE_URL;?>/assets/css/bootstrap.min.css'>
        <link rel='stylesheet' href='<?php echo BASE_URL;?>/assets/css/bootstrap-theme.css'>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" >var BASE_URL = "<?php echo BASE_URL; ?>"</script>
        <script type="text/javascript" >var SOCKET_SERVER = "<?php echo SOCKET_SERVER; ?>"</script>
        <script type="text/javascript" >var SOCKET_PORT = "<?php echo SOCKET_PORT; ?>"</script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/c3.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/d3.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
        <script src="<?php echo BASE_URL;?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo BASE_URL;?>/assets/css/icheck-bootstrap.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
        <link href="<?php echo BASE_URL; ?>/assets/css/select2.min.css" rel="stylesheet" />
        
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    </head>
    <?php header("Content-Type: text/html; charset=UTF8",true);?>
    <body>
        <div class="area">            
            <?php $this->loadViewinTemplate($viewName,$viewData); ?>
        </div>	
	<div id='top' style="z-index:10;">
            <div id='menu' style="z-index:10;">
                <a href=# title="MENU"><img src="<?=BASE_URL; ?>/assets/images/menu.png" class='imgmenu' ></a>
                <div id='menuprincipal'>
                    <a href="<?php echo BASE_URL; ?>/operadoras">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/channel.png" class="imgitemmenu">
                        </div>
                    </a>

                    <a href="<?php echo BASE_URL; ?>/agentes">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/operator.png" class="imgitemmenu">
                        </div>
                    </a>

                    <a href="<?php echo BASE_URL; ?>/campanhas">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/campaign.png" class="imgitemmenu">
                        </div>
                    </a>

                    <a href="<?php echo BASE_URL; ?>/discador">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/dialed.png" class="imgitemmenu">
                        </div>
                    </a>

                    <a href="<?php echo BASE_URL; ?>/supervisor">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/stats.png" class="imgitemmenu">
                        </div>
                    </a>

                    <a href="<?php echo BASE_URL; ?>/recording">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/vinyls.png" class="imgitemmenu">
                        </div>
                    </a>

                    <a href="<?php echo BASE_URL; ?>/relatorios">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/report.png" class="imgitemmenu">
                        </div>
                    </a>

                    <a href="<?php echo BASE_URL; ?>/monitoramento">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/monitoramento.png" class="imgitemmenu">	
                        </div>
                    </a>

                    <a href="<?php echo BASE_URL; ?>/ipbx">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/ipbx.png" class="imgitemmenu">	
                        </div>
                    </a>
                   	
					<a href="<?php echo BASE_URL; ?>/#">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/ura.png" class="imgitemmenu">
                        </div>
                    </a>
					
					 <a href="<?php echo BASE_URL; ?>/setup">
                        <div class="itemmenu">
                            <img src="<?php echo BASE_URL; ?>/assets/images/settings2.png" class="imgitemmenu">
                        </div>
                    </a>
                </div>
            </div>

            <div id='divlogo'>
                <a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/logo.png" class='logo' ></a>
            </div>

            <div id='divuser'>
                <a href=#>
                        <img src="<?php echo BASE_URL; ?>/assets/images/user.png" class='imguser'>
                </a>
                <div class='menuuser'>
                        <!--<a href="#">
                                <div class="buttonSair">
                                        Alterar Senha
                                </div>
                        </a>

                                <div class="buttonSair">
                                        <img src="<?php echo BASE_URL; ?>/assets/images/logout.png" class='imglogout.png'>Sair
                                </div>
                        </a> Pode apagar se o botao trocar senha e sair tiver ok-->
                    <table>
                        <tr>
                            <td class="tdmenuuser"><a href=# class="linkmenuuser">Trocar Senha</a></td>
                        </tr>
                        <tr>
                            <td class="tdmenuuser"><a href="<?php echo BASE_URL.'/login/logout'; ?>" class="linkmenuuser">Sair</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class='divbemvido'>
                Bem Vindo <br>
                <?php echo $viewData['user_name']; ?>
            </div>
            <a href=# title="A UM NOVO ALERTA"><div id='divalert'>
                <img src="<?php echo BASE_URL; ?>/assets/images/alert.png" class='imgalert'>
            </div></a>

            <div class='dbord'>
                <?php echo $viewData['title']; ?>
            </div>
        </div>
    </body>
</html>