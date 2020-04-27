<?php

/**
 * 
 */
class groupController extends controller {

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
        $g = new Group();
        $c = new Campanhas();
        $u->setLoggedUser();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'CAMPANHAS';
        $data['title2'] = 'GRUPOS';
        if ($u->hasPermission('Grupos')) {
            $data['group_list'] = $g->getList();
            $data['campanha_list'] = $c->campanhaList();
            $this->loadTemplate('group', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function listGroup($ativo = 1) {
        $data = array();
        $g = new Group();
        $data{'group'} = $g->getList($ativo);
        echo json_encode($data);
    }

    public function getGroup($id) {
        $data = array();
        $g = new Group();
        $data{'group'} = $g->getGroup($id);
        echo json_encode($data);
    }

    public function saveGroup($id) {
        $g = new Group();
        $nome = $_POST['nome'];
        $campanha = $_POST['campanha'];
        $clerical = $_POST['clerical'];
        $filamax = $_POST['filamax'];
        $ativo = $_POST['ativo'];
        if ($id == 0) {
            $g->add($nome, $campanha, $clerical, $filamax, $ativo);
        } else {
            $g->edit($id, $nome, $campanha, $clerical, $filamax, $ativo);
        }
    }

    public function delete($id) {
        $g = new Group();
        $g->delete($id);
        header("Location: " . BASE_URL . '/group');
    }

    public function selGrupos($idcamp) {
        $g = new Group();
        $data['group'] = $g->getGrupoCampanha($idcamp);
        echo json_encode($data);
    }

    public function agentesGrupo($id){
        $data = array();
        $a = new Agentes();
        $g = new Group();
        $data{'grupos'} = $g->getList();
        $data['grupo'] = $id;
        $data['agentesGrupo'] =  $g->agentesGrupo($id);
        $this->loadView('grupo_agentes', $data);
    }

    public function saveAgentesGrupo(){
        if (isset($_POST['grupo']) && !empty($_POST['grupo'])) {
            $g = new Group();
            $grupo = $_POST['grupo'];
            $agentes = $_POST['agentes'];
            $g->saveGruposAgente($agentes, $grupo);
        }
    }

}
