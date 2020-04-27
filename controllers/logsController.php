<?php

class logsController extends controller
{
	
    public function __construct() {
    //parent::__construct();
        $user = new Users();
        if ($user->isLogged() == false) {
                header("Location: ".BASE_URL."/login");
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $l = new Logs();
        $data['user_name'] = $u->getName();
        $data['title'] = 'LOGS';
        $data['title2'] = 'LOGS';
        $data['log'] = '';
        $data['dados'] = array();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])) {
            $dti = addslashes($_POST['data_inicio']) . ' 00:00:00';
        }
        if (isset($_POST['data_fim']) && !empty($_POST['data_fim'])) {
            $dtf = addslashes($_POST['data_fim']) . ' 23:59:39';
        }
        if (isset($_POST["select"]) && !empty($_POST['select'])) {
            $sel = $_POST["select"];
            if ($sel==1) {
                $data['log'] = 'Configuração do discador';
                $data['dados'] = $l->getConfigDiscador($dti,$dtf);
            }
            if ($sel==2) {
                $data['log'] = 'Parâmetros';
                $data['dados'] = $l->getParametros($dti,$dtf);
            }
            if ($sel==3) {
                $data['log'] = 'Rotas';
                $data['dados'] = $l->getRotas($dti,$dtf);
            }
        }
        //        if($u->hasPermission('Logs')) {
            $this->loadTemplate('logs',$data);
        // } else {
        //     header("Location: ".BASE_URL);
        // }
    }
}
?>    