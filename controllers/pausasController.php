<?php

class pausasController extends controller {

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
        $u->setLoggedUser();
        $data['user_name'] = $u->getName();
        $data['title'] = 'PAUSAS';
        $p = new Pausas();
        // if ($u->hasPermission('pausas')) {
            $data['pausas_list'] = $p->getLista();
            $this->loadTemplate('pausas', $data);
        // } else {
            // header("Location: " . BASE_URL);
        // }
    }

    public function getPausa($id) {
        $data = array();
        $p = new Pausas();
        $data['pausa'] = $p->getPausa($id);
        echo json_encode($data);
    }

    public function incluir($desc,$ativo) {
        $p = new Pausas();
        $p->incluir($desc,$ativo);
        header("Location: " . BASE_URL . "/pausas");
    }

    public function editar($id,$desc,$ativo) {
        $p = new Pausas();
        $p->editar($id,$desc,$ativo);
        header("Location: " . BASE_URL . "/pausas");
    }

    public function delete($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $p = new Pausas();
        $p->delete($id);
        header("Location: " . BASE_URL . "/pausas");
    }
}