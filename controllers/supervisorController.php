<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class supervisorController extends controller
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
        $user = $u->getId();
        $g = new Group();
        $s = new Supervisor();
        $c = new Campanhas(0);
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'SUPERVISOR';
        $data['idgroup'] = '';
        $data['idcamp'] = '';
        $data['groupName'] = '';
        if(isset($_POST['group'])) {
            $data['idcamp'] = addslashes($_POST['supcamp']);
        }
        if(isset($_POST['group'])) {
            $data['idgroup'] = addslashes($_POST['group']);
            $data['groupName'] = $g->getGroup($data['idgroup'],0);
            $group = addslashes($_POST['group']);
            $data['users'] = $s->listUsers($user,$group);
        }
//  		if($u->hasPermission('supervisor')) {
            $data['campanha_list'] = $c->campanhaList($user);
            $data['group_list'] = $g->getList();
            $this->loadTemplate('supervisor',$data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
    }

    public function listaCampanhas(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $g = new Group();
        $s = new Supervisor();
        $c = new Campanhas(0);
        $data['campanha_list'] = $c->campanhaList($user);
        $this->loadView("supervisorSel", $data);
    }
        
    public function selGruposCampanha($idcamp) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $s = new Supervisor();
        $data['grupos'] = $s->listUsers($user,$idcamp,0);
        $this->loadView("supervisorSel", $data);
    }

    public function atualizaGruposCampanha($idcamp) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $s = new Supervisor();
        $data['grupos'] = $s->listUsers($user,$idcamp,0);
        $data['detalhes_grupo'] = $s->getMonitoraCampanha(0,0,'G');
//        $this->loadView("supervisorSel", $data);
    //    print_r($data);exit;
        echo json_encode($data);
    }
 
    public function getMonitoraCampanha($idcamp,$idgr=0,$idag) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $g = new Group();
        $s = new Supervisor();
        $c = new Campanhas(0);
        $data['detalhes_campanha'] = $s->getMonitoraCampanha($idcamp,0,'C');
        $data['detalhes_grupo'] = $s->getMonitoraCampanha($idgr,0,'G');
        $data['detalhes_agente'] = $s->getMonitoraCampanha($idgr,$idag,'A');
        // print_r($data);exit;
        $this->loadView("supervisorDetalhesCampanha", $data);
    }
 
    public function grupoDetalhes($id,$tempo) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $g = new Group();
        $s = new Supervisor();
        $c = new Campanhas(0);
        // $data['detalhes_campanha'] = $s->getMonitoraCampanha($idcamp,0,'C');
        $data['detalhes_grupo'] = $s->grupoDetalhes($id,$tempo);
        $data['detalhes_grupo_lista'] = $s->grupoDetalhesLista($id,$tempo);
        // $data['detalhes_agente'] = $s->getMonitoraCampanha($idgr,$idag,'A');
        // print_r($data);exit;
        $this->loadView("supervisorGrupoDetalhes", $data);
    }
 
    
}