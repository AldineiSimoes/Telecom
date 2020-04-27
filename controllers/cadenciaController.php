<?php

class cadenciaController extends controller {

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
        $c = new Cadencia();
        $u->setLoggedUser();
        $data['user_name'] = $u->getName();
        $data['title'] = 'OPERADORAS';
        if ($u->hasPermission('Cadencias')) {
            $data['cadencia_list'] = $c->listCadencias();
            $this->loadTemplate('cadencia', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function delete($id) {
        header("Location: " . BASE_URL . "/cadencia");
    }

}
