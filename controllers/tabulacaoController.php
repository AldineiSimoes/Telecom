<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class tabulacaoController extends controller
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
        $data['title'] = 'CAMPANHAS';
        $data['title2'] = 'TABULAÇÃO';
        $c = new Campanhas();
        $u = new Users();
        $u->setLoggedUser();
        $data['user_name'] = $u->getName();
        $t = new Tabulacao();
  		if($u->hasPermission('tabulacao')) {
            if (isset($_POST['campanha']) && $_POST['campanha'] > 0) {
                $campanha = addslashes($_POST['campanha']);
            }
            $data['tab_list'] = $t->getLista();
            $data['campanha_list'] = $c->campanhaList();
            $data['tipotab_list'] = $t->tipoTab();
            $this->loadTemplate('tabulacao',$data);
		} else {
			header("Location: ".BASE_URL);
		}
    }
    
    public function addTabulacao(){
        $t = new Tabulacao();
        $u = new users();
        $u->setLoggedUser();
        $descricao = addslashes($_POST['descricao']);
        $cod = $_POST['cod'];
        $tipo = $_POST['tipo'];
        $idcampanha = $_POST['idcampanha'];
        $t->newTabulacao($cod, $descricao, $tipo,$idcampanha);
        $this->getLista($idcampanha);
    }
    
    public function delTabulacao(){
         $t = new Tabulacao();
        $u = new users();
        $u->setLoggedUser();
        $t->delTabulacao($_POST['id']);
    }
    
    public function getLista($id){
        $data = array();
        $t = new Tabulacao();
        $data['tab_list'] = $t->getLista($id);
        $data['tipotab_list'] = $t->tipoTab();
        $this->loadView("tabulacaoSel", $data);
    }
}