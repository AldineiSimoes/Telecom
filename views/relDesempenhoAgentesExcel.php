<?php
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/x-msexcel");
        header ("Content-Disposition: attachment; filename=\"DesempenhoAgentes.xls\"" );
        header ("Content-Description: PHP Generated Data" );

$cabecalhoXLS = "Desempenho dos Agentes\t\n";
// $cabecalhoXLS .=  'Periodo: '.$periodo." \t\n";
// $cabecalhoXLS .=  "Carteira: ".$carteira."\n";
// $cabecalhoXLS .= "Grupo: ".$grupo."\n\n";
$cabecalhoXLS .=  "DATA \t NOME \t PRIMEIRO AT. \t ULTIMO AT. \t LOGIN \t LOGOUT \t TEMPO LOGADO \t TOTAL ATENDIDAS \t ATENDIDAS RECEPTIVO \t ATENDIDAS ATIVO MANUAL \t ATENDIDAS ATIVO DISCADOR \t TEMPO FALADO \t TEMPO CLERICAL \t TOTAL DE PAUSAS \t TEMPO DE PAUSAS \t TEMPO DISPONIVEL \t TMA \t TME \n";


$filename = "DesempenhoAgentes.xls";
$x=1;
$dadosXLS ='';
foreach ($desempenho_list as $row) {
    $dadosXLS .= $row['dia'] . "\t" . $row['nome'] . "\t" . $row['primeiroatt'] . "\t" . 
                 $row['ultimoatt']."\t". 
                 (!empty($row['logon'])? date("d/m/Y H:i:s", strtotime($row['logon'])) : ''). "\t".
                 (!empty($row['logout'])? date("d/m/Y H:i:s", strtotime($row['logout'])) : '')."\t".
                 $row['tplogado']."\t".$row['atendidas']."\t" .$row['QtdAtendidasReceptivo']."\t" .
                 $row['QtdAtendidasAtivomanual']."\t" .$row['QtdAtendidasAtivoDiscador']."\t" .
                 Convert::secondToTime($row['falado'])."\t" .$row['tempo_clerical']."\t".
                 $row['qtdpausas']."\t" .Convert::secondToTime( $row['tempopausas'])."\t".
                 Convert::secondToTime( $row['livre'])."\t".$row['TMA']."\t".$row['TME']."\n";
}


// header('Content-type: application/x-msexcel');
// header('Content-Disposition: attachment; filename='.$filename);
echo $cabecalhoXLS.$dadosXLS;




 ?>
