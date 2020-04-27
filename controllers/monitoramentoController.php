<?php

class monitoramentoController extends controller
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
        $data['user_name'] = $u->getName();
        $data['title'] = 'MONITORAMENTO';
        $data['title2'] = '';
        //        if($u->hasPermission('Logs')) {
            $this->loadTemplate('monitoramento',$data);
        // } else {
        //     header("Location: ".BASE_URL);
        // }
    }

    public function ativos() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $s = new Supervisor();
        $data['gruposAtivos'] = $s->getGruposAtivos($user);
        $this->loadView('monitoraAtivos',$data);
    }

    public function receptivo() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $s = new Supervisor();
        $data['gruposRec'] = $s->getGruposReceptivo($user);
        $this->loadView('monitoraReceptivo',$data);
    }

    public function zerarRegistros($id_discador,$tipo_registro) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $s = new Supervisor();
    }
}
?>    