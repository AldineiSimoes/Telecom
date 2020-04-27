<?php

class operadorasController extends controller {

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
        $data['title'] = 'OPERADORAS';
        $o = new Operadoras();
        if ($u->hasPermission('operadora')) {
            $data['operadoras_list'] = $o->listOperadoras();
            $this->loadTemplate('operadoras', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function edit($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $data['user_name'] = $u->getName();
        $data['title'] = 'OPERADORAS';
        $o = new Operadoras();
//  		if($u->hasPermission('supervisor')) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $o->editOperadora($id);
            header("Location: " . BASE_URL . '/operadoras');
        }
        $this->loadTemplate('operadoras', $data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
    }

    public function delete($id) {

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $data['user_name'] = $u->getName();
        $data['title'] = 'OPERADORAS';
        $o = new Operadoras();

//  	if($u->hasPermission('supervisor')) {
        if (isset($id) && !empty($id)) {
            $o->delOperadora($id);
        }
        header("Location: " . BASE_URL . '/operadoras');
//		} else {
//			header("Location: ".BASE_URL);
//		}
    }

    public function getUsoOperadoras() {
        $data = array();
        $o = new Operadoras();
        $data['operadoras'] = $o->usoOperadoras();
        echo json_encode($data);
    }

    public function getVolumeOperadoras() {
        $data = array();
        $o = new Operadoras();
        $data['operadoras1'] = $o->aproveitamentoOperadoras();
        echo json_encode($data);
    }

}
