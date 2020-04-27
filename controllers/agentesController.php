<?php

class agentesController extends controller
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
        $a = new Agentes();
		$d = new Diversos();
        $data['user_name'] = $u->getName();
        $data['title'] = 'AGENTES';
        if($u->hasPermission('Agentes')) {
        	$data['agents_list'] =  $a->agentesList();
			$data['local_agente'] = $d->listLocalAgente();
            $data['tipo_ramal'] = $d->listTipoRamal();
            
            $this->loadTemplate('agentes',$data);
        } else {
            header("Location: ".BASE_URL);
        }
    }
    
    public function getAgente($id) {
        $data = array();
        $a = new Agentes();
		$data['agente'] = $a->getAgente($id);
    	echo json_encode($data);
	}

    public function getAgenteRamal($id) {
        $data = array();
        $a = new Agentes();
		$data['agente'] = $a->getAgenteRamal($id);
    	echo json_encode($data);
	}

    public function saveAgente($id) {
        $data = array();
        $a = new Agentes();
        if ((isset($_POST['nome'])) && (!empty($_POST['nome'])) ) {
            $idag = addslashes($_POST['idag']);
            $nome = addslashes($_POST['nome']);
            $cpf = addslashes($_POST['cpf']);
            $ramal = addslashes($_POST['ramal']);
            $ativo = addslashes($_POST['ativo']);
            $senha = addslashes($_POST['senha']);
            $login = addslashes($_POST['login']);
            $tiporamal = addslashes($_POST['tipoRamal']);
            $localagente = addslashes($_POST['localAgente']);
            if ($idag==0) {
                $a->addAgente($nome,$cpf,$ramal,$ativo,$senha,$login,$tiporamal,$localagente);
            } else {
                $a->editAgente($idag,$nome,$cpf,$ramal,$ativo,$senha,$login,$tiporamal,$localagente);
            }
        }
    }

    public function getStatusGeral() {
        $data = array();
        $a = new Agentes();
        $data['statusOperacao'] = $a->statusGeral();
        //print_r($data); exit;
        echo json_encode($data);        
    }

    public function gruposAgentes($id){
        $data = array();
        $a = new Agentes();
        $g = new Group();
        $data{'grupos'} = $g->getList();
        $data['agente'] = $id;
        $data['gruposAgente'] =  $a->gruposAgente($id);
        $this->loadView('agentes_grupos', $data);
    }

    public function saveGruposAgente(){
        if (isset($_POST['grupos']) && !empty($_POST['grupos'])) {
            $a = new Agentes();
            $grupos = $_POST['grupos'];
            $agente = $_POST['agente'];
            $a->saveGruposAgente($agente, $grupos);
        }
    }
}
