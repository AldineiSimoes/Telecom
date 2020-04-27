<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailingVo
 *
 * @author leonardo
 */
class MailingVo {
    
  private $id;
  private $documento;
  private $nome;
  private $contrato;
  private $codagente;
  private $numeroramal;
  private $datahoraagendamento;
  private $instanteinsercao;
  private $estado;
  private $instanteupdate;
  private $codfinalizacao;
  private $prioridade;
  private $carteira;
  private $lote;
  private $nomeultfone;
  private $dddres1;
  private $foneres1;
  private $dddres2;
  private $foneres2;
  private $dddres3;
  private $foneres3;
  private $dddres4;
  private $foneres4;
  private $dddres5;
  private $foneres5;
  private $dddcom1;
  private $fonecom1;
  private $dddcom2;
  private $fonecom2;
  private $dddcom3;
  private $fonecom3;
  private $dddcom4;
  private $fonecom4;
  private $dddcom5;
  private $fonecom5;
  private $dddcel1;
  private $fonecel1;
  private $dddcel2;
  private $fonecel2;
  private $dddcel3;
  private $fonecel3;
  private $dddcel4;
  private $fonecel4;
  private $dddcel5;
  private $fonecel5;
  private $dddpes1;
  private $fonepes1;
  private $dddpes2;
  private $fonepes2;
  private $dddpes3;
  private $fonepes3;
  private $dddpes4;
  private $fonepes4;
  private $dddpes5;
  private $fonepes5;
  private $dddout1;
  private $foneout1;
  private $dddout2;
  private $foneout2;
  private $dddout3;
  private $foneout3;
  private $dddout4;
  private $foneout4;
  private $dddout5;
  private $foneout5;
  private $agenteagenda;
  private $tentativas;
  private $tipoagenda;
  private $id_arquivo;
  private $tabeladiscagem;

  
  
  public function getTabeladiscagem() {
      return $this->tabeladiscagem;
  }

  public function setTabeladiscagem($tabeladiscagem) {
      $this->tabeladiscagem = $tabeladiscagem;
  }

  

  public function getTipoagenda() {
      return $this->tipoagenda;
  }

  public function setTipoagenda($tipoagenda) {
      $this->tipoagenda = $tipoagenda;
  }

    
  public function getId_arquivo() {
      return $this->id_arquivo;
  }

  public function setId_arquivo($id_arquivo) {
      $this->id_arquivo = $id_arquivo;
  }

  
  public function getId() {
      return $this->id;
  }

  public function setId($id) {
      $this->id = $id;
  }

  public function getDocumento() {
      return $this->documento;
  }

  public function setDocumento($documento) {
      $this->documento = $documento;
  }

  public function getNome() {
      return $this->nome;
  }

  public function setNome($nome) {
      $this->nome = $nome;
  }

  public function getContrato() {
      return $this->contrato;
  }

  public function setContrato($contrato) {
      $this->contrato = $contrato;
  }

  public function getCodagente() {
      return $this->codagente;
  }

  public function setCodagente($codagente) {
      $this->codagente = $codagente;
  }

  public function getNumeroramal() {
      return $this->numeroramal;
  }

  public function setNumeroramal($numeroramal) {
      $this->numeroramal = $numeroramal;
  }

  public function getDatahoraagendamento() {
      return $this->datahoraagendamento;
  }

  public function setDatahoraagendamento($datahoraagendamento) {
      $this->datahoraagendamento = $datahoraagendamento;
  }

  public function getInstanteinsercao() {
      return $this->instanteinsercao;
  }

  public function setInstanteinsercao($instanteinsercao) {
      $this->instanteinsercao = $instanteinsercao;
  }

  public function getEstado() {
      return $this->estado;
  }

  public function setEstado($estado) {
      $this->estado = $estado;
  }

  public function getInstanteupdate() {
      return $this->instanteupdate;
  }

  public function setInstanteupdate($instanteupdate) {
      $this->instanteupdate = $instanteupdate;
  }

  public function getCodfinalizacao() {
      return $this->codfinalizacao;
  }

  public function setCodfinalizacao($codfinalizacao) {
      $this->codfinalizacao = $codfinalizacao;
  }

  public function getPrioridade() {
      return $this->prioridade;
  }

  public function setPrioridade($prioridade) {
      $this->prioridade = $prioridade;
  }

  public function getCarteira() {
      return $this->carteira;
  }

  public function setCarteira($carteira) {
      $this->carteira = $carteira;
  }

  public function getLote() {
      return $this->lote;
  }

  public function setLote($lote) {
      $this->lote = $lote;
  }

  public function getNomeultfone() {
      return $this->nomeultfone;
  }

  public function setNomeultfone($nomeultfone) {
      $this->nomeultfone = $nomeultfone;
  }

  public function getDddres1() {
      return $this->dddres1;
  }

  public function setDddres1($dddres1) {
      $this->dddres1 = $dddres1;
  }

  public function getFoneres1() {
      return $this->foneres1;
  }

  public function setFoneres1($foneres1) {
      $this->foneres1 = $foneres1;
  }

  public function getDddres2() {
      return $this->dddres2;
  }

  public function setDddres2($dddres2) {
      $this->dddres2 = $dddres2;
  }

  public function getFoneres2() {
      return $this->foneres2;
  }

  public function setFoneres2($foneres2) {
      $this->foneres2 = $foneres2;
  }

  public function getDddres3() {
      return $this->dddres3;
  }

  public function setDddres3($dddres3) {
      $this->dddres3 = $dddres3;
  }

  public function getFoneres3() {
      return $this->foneres3;
  }

  public function setFoneres3($foneres3) {
      $this->foneres3 = $foneres3;
  }

  public function getDddres4() {
      return $this->dddres4;
  }

  public function setDddres4($dddres4) {
      $this->dddres4 = $dddres4;
  }

  public function getFoneres4() {
      return $this->foneres4;
  }

  public function setFoneres4($foneres4) {
      $this->foneres4 = $foneres4;
  }

  public function getDddres5() {
      return $this->dddres5;
  }

  public function setDddres5($dddres5) {
      $this->dddres5 = $dddres5;
  }

  public function getFoneres5() {
      return $this->foneres5;
  }

  public function setFoneres5($foneres5) {
      $this->foneres5 = $foneres5;
  }

  public function getDddcom1() {
      return $this->dddcom1;
  }

  public function setDddcom1($dddcom1) {
      $this->dddcom1 = $dddcom1;
  }

  public function getFonecom1() {
      return $this->fonecom1;
  }

  public function setFonecom1($fonecom1) {
      $this->fonecom1 = $fonecom1;
  }

  public function getDddcom2() {
      return $this->dddcom2;
  }

  public function setDddcom2($dddcom2) {
      $this->dddcom2 = $dddcom2;
  }

  public function getFonecom2() {
      return $this->fonecom2;
  }

  public function setFonecom2($fonecom2) {
      $this->fonecom2 = $fonecom2;
  }

  public function getDddcom3() {
      return $this->dddcom3;
  }

  public function setDddcom3($dddcom3) {
      $this->dddcom3 = $dddcom3;
  }

  public function getFonecom3() {
      return $this->fonecom3;
  }

  public function setFonecom3($fonecom3) {
      $this->fonecom3 = $fonecom3;
  }

  public function getDddcom4() {
      return $this->dddcom4;
  }

  public function setDddcom4($dddcom4) {
      $this->dddcom4 = $dddcom4;
  }

  public function getFonecom4() {
      return $this->fonecom4;
  }

  public function setFonecom4($fonecom4) {
      $this->fonecom4 = $fonecom4;
  }

  public function getDddcom5() {
      return $this->dddcom5;
  }

  public function setDddcom5($dddcom5) {
      $this->dddcom5 = $dddcom5;
  }

  public function getFonecom5() {
      return $this->fonecom5;
  }

  public function setFonecom5($fonecom5) {
      $this->fonecom5 = $fonecom5;
  }

  public function getDddcel1() {
      return $this->dddcel1;
  }

  public function setDddcel1($dddcel1) {
      $this->dddcel1 = $dddcel1;
  }

  public function getFonecel1() {
      return $this->fonecel1;
  }

  public function setFonecel1($fonecel1) {
      $this->fonecel1 = $fonecel1;
  }

  public function getDddcel2() {
      return $this->dddcel2;
  }

  public function setDddcel2($dddcel2) {
      $this->dddcel2 = $dddcel2;
  }

  public function getFonecel2() {
      return $this->fonecel2;
  }

  public function setFonecel2($fonecel2) {
      $this->fonecel2 = $fonecel2;
  }

  public function getDddcel3() {
      return $this->dddcel3;
  }

  public function setDddcel3($dddcel3) {
      $this->dddcel3 = $dddcel3;
  }

  public function getFonecel3() {
      return $this->fonecel3;
  }

  public function setFonecel3($fonecel3) {
      $this->fonecel3 = $fonecel3;
  }

  public function getDddcel4() {
      return $this->dddcel4;
  }

  public function setDddcel4($dddcel4) {
      $this->dddcel4 = $dddcel4;
  }

  public function getFonecel4() {
      return $this->fonecel4;
  }

  public function setFonecel4($fonecel4) {
      $this->fonecel4 = $fonecel4;
  }

  public function getDddcel5() {
      return $this->dddcel5;
  }

  public function setDddcel5($dddcel5) {
      $this->dddcel5 = $dddcel5;
  }

  public function getFonecel5() {
      return $this->fonecel5;
  }

  public function setFonecel5($fonecel5) {
      $this->fonecel5 = $fonecel5;
  }

  public function getDddpes1() {
      return $this->dddpes1;
  }

  public function setDddpes1($dddpes1) {
      $this->dddpes1 = $dddpes1;
  }

  public function getFonepes1() {
      return $this->fonepes1;
  }

  public function setFonepes1($fonepes1) {
      $this->fonepes1 = $fonepes1;
  }

  public function getDddpes2() {
      return $this->dddpes2;
  }

  public function setDddpes2($dddpes2) {
      $this->dddpes2 = $dddpes2;
  }

  public function getFonepes2() {
      return $this->fonepes2;
  }

  public function setFonepes2($fonepes2) {
      $this->fonepes2 = $fonepes2;
  }

  public function getDddpes3() {
      return $this->dddpes3;
  }

  public function setDddpes3($dddpes3) {
      $this->dddpes3 = $dddpes3;
  }

  public function getFonepes3() {
      return $this->fonepes3;
  }

  public function setFonepes3($fonepes3) {
      $this->fonepes3 = $fonepes3;
  }

  public function getDddpes4() {
      return $this->dddpes4;
  }

  public function setDddpes4($dddpes4) {
      $this->dddpes4 = $dddpes4;
  }

  public function getFonepes4() {
      return $this->fonepes4;
  }

  public function setFonepes4($fonepes4) {
      $this->fonepes4 = $fonepes4;
  }

  public function getDddpes5() {
      return $this->dddpes5;
  }

  public function setDddpes5($dddpes5) {
      $this->dddpes5 = $dddpes5;
  }

  public function getFonepes5() {
      return $this->fonepes5;
  }

  public function setFonepes5($fonepes5) {
      $this->fonepes5 = $fonepes5;
  }

  public function getDddout1() {
      return $this->dddout1;
  }

  public function setDddout1($dddout1) {
      $this->dddout1 = $dddout1;
  }

  public function getFoneout1() {
      return $this->foneout1;
  }

  public function setFoneout1($foneout1) {
      $this->foneout1 = $foneout1;
  }

  public function getDddout2() {
      return $this->dddout2;
  }

  public function setDddout2($dddout2) {
      $this->dddout2 = $dddout2;
  }

  public function getFoneout2() {
      return $this->foneout2;
  }

  public function setFoneout2($foneout2) {
      $this->foneout2 = $foneout2;
  }

  public function getDddout3() {
      return $this->dddout3;
  }

  public function setDddout3($dddout3) {
      $this->dddout3 = $dddout3;
  }

  public function getFoneout3() {
      return $this->foneout3;
  }

  public function setFoneout3($foneout3) {
      $this->foneout3 = $foneout3;
  }

  public function getDddout4() {
      return $this->dddout4;
  }

  public function setDddout4($dddout4) {
      $this->dddout4 = $dddout4;
  }

  public function getFoneout4() {
      return $this->foneout4;
  }

  public function setFoneout4($foneout4) {
      $this->foneout4 = $foneout4;
  }

  public function getDddout5() {
      return $this->dddout5;
  }

  public function setDddout5($dddout5) {
      $this->dddout5 = $dddout5;
  }

  public function getFoneout5() {
      return $this->foneout5;
  }

  public function setFoneout5($foneout5) {
      $this->foneout5 = $foneout5;
  }

  public function getAgenteagenda() {
      return $this->agenteagenda;
  }

  public function setAgenteagenda($agenteagenda) {
      $this->agenteagenda = $agenteagenda;
  }

  public function getTentativas() {
      return $this->tentativas;
  }

  public function setTentativas($tentativas) {
      $this->tentativas = $tentativas;
  }

    
}

?>
