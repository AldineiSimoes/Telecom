<?php
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/x-msexcel");
        header ("Content-Disposition: attachment; filename=\"Pausas.xls\"" );
        header ("Content-Description: PHP Generated Data" );

$cabecalhoXLS = "Puasas\t\n";
$cabecalhoXLS .=  'Periodo: '.$dti.' A '.$dtf." \t\n";
// $cabecalhoXLS .=  "Carteira: ".$carteira."\n";
// $cabecalhoXLS .= "Grupo: ".$grupo."\n\n";
$dadosXLS ='';
$dadosXLS .= 'AGENTE '."\t".'TIPO PAUSA '."\t".'INSTANTE '."\t".'TEMPO'."\n";
foreach ($pausas_grupo as $l) {
    // $dadosXLS .=  $l['nome']." - ".$l['cod_agente']."\n"; 
    $reg = $this->relPausasLista($dti,$dtf,$grupo,$l['cod_agente']); 
    foreach ($reg as $r) {
      foreach ($r as $v){
        $dadosXLS .=  $l['cod_agente']."\t".utf8_encode($v['subcod_evento'])."\t".
            date('d/m/Y H:i:s',  strtotime($v['instante']))."\t".
            $v['tempo']."\n";
        }
    }
    $reg = $this->relPausasTotal($dti,$dtf,$grupo,$l['cod_agente']); 
    $dadosXLS .= 'Total '.$reg[0]."\n";
    $dadosXLS .="\n";;
}


$filename = "Puasas Detalhado.xls";

// header('Content-type: application/x-msexcel');
// header('Content-Disposition: attachment; filename='.$filename);
echo $cabecalhoXLS.$dadosXLS;




 ?>
