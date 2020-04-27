<?php

class tarifasController extends controller {

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
        $t = new Tarifas();
        $c = new Cadencia();
        $data['user_name'] = $u->getName();
        $data['title'] = 'OPERADORAS';
        if ($u->hasPermission('Tarifas')) {
            if(isset($_POST['id'])) {
              $t->editar($_POST['id'], 
                        $_POST['selcadLocal'],
                        $_POST['localVrTar'],
                        $_POST['selLde'],
                        $_POST['ldeVrTar'],
                        $_POST['selLdn'],
                        $_POST['ldnVrTar'],
                        $_POST['selVc1'],
                        $_POST['vc1VrTar'],
                        $_POST['selVc2'],
                        $_POST['vc2VrTar'],
                        $_POST['selVc3'],
                        $_POST['vc3VrTar']);
            };
            $data['tarifas_list'] = $t->listTarifas();
            $data['cadencias_list'] = $c->listCadencias();
            $this->loadTemplate('tarifas', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function delete($id) {
        header("Location: " . BASE_URL . "/tarifas");
    }

}
