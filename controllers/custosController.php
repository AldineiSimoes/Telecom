<?php

class custosController extends controller {

    public function __construct() {
        //parent::__construct();
        $user = new Users();
        if ($user->isLogged() == false) {
            header("Location: " . BASE_URL . "/login");
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $r = new Regras();
        $o = new Operadoras();
        $u->setLoggedUser();
        $data['user_name'] = $u->getName();
        $data['title'] = 'RELATORIOS';
        if ($u->hasPermission('Custos')) {
            $this->loadTemplate('custos', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

}
