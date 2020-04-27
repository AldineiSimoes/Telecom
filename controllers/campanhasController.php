<?php

class campanhasController extends controller {

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
        $data['title'] = 'CAMPANHAS';
        $data['title2'] = '';
        if ($u->hasPermission('Campanhas')) {
            $this->loadTemplate('campanhas', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function listCampanhas($ativo = 1) {
        $data = array();
        $c = new Campanhas();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $data['user_name'] = $u->getName();
        $data['title'] = 'CAMPANHAS';
        $data['title2'] = 'CADASTRO';
//  		if($u->hasPermission('supervisor')) {
        $data['campanhas_list'] = $c->campanhaList($user,$ativo);
        $this->loadTemplate('campanhasCadastros', $data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
    }

    public function selCampanhas($ativo) {
        $data = array();
        $c = new Campanhas();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $data['campanhas'] = $c->campanhaList($user,$ativo);
        echo json_encode($data);
    }

    public function getCampanha($id) {
        $data = array();
        $c = new Campanhas();
        $data['campanha'] = $c->getCampanha($id);
        echo json_encode($data);
    }

    public function saveCampanha($id) {
        $data = array();
        $c = new Campanhas();
        $desc = $_POST['nome'];
        $dti = $_POST['data_inicio'];
        $dtf = $_POST['data_fim'];
        $hri = '00:00:00';
        $hrf = '12:59:59';
        $ativo = $_POST['ativo'];
        if ($id == 0) {
            $c->addCampanha($desc, $dti, $dtf, $hri, $hrf, $ativo);
        } else {
            $c->editCampanha($id, $desc, $dti, $dtf, $hri, $hrf, $ativo);
        }
        echo json_encode($data);
    }

    public function delete($id) {
        $c = new Campanhas();
        $c->delete($id);
        header("Location: " . BASE_URL . '/campanhas/listCampanhas');
    }

}
