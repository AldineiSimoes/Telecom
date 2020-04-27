<?php
    if ($tipo==1) {
        // Configurações header para forçar o download
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/x-msexcel");
        header ("Content-Disposition: attachment; filename=\"Ligacoes.xls\"" );
        header ("Content-Description: PHP Generated Data" );

    }
?>
<div id="conteudo">
    <div id="img"><img src="../../../img/loading2.gif" /></div>
    <h1>Analise das Ligações</h1>
    <div class="barra_relatorios">
        <div class="botoes_relatorios">
            <div class="espacador_botoes"></div>
        </div>
    </div>
    <?php
       $html = '<table id="tb2" style="text-align: center;">
        <tr class="cabecalho" >
            <th>ID</th>
            <th>Data</th>
            <th>Operadora</th>
            <th>DDD</th>
            <th>Fone</th>
            <th>Origem</th>
            <th>Tipo</th>
            <th>Status</th>
            <th>Ramal</th>
            <th>Agente</th>
            <th>CPF</th>
            <th>Grupo</th>
            <th>Contrato</th>
            <th>Duração</th>
            <th>At. Publica</th>
            <th>At. Ramal</th>
            <th>Fim Ligação</th>
            <th>Cod. SIP</th>
        </tr>';
        if($tipo==2) {
            echo $html;
            $html = '';
        }
        foreach ($relligDetalhe as $l) {
            $html .= "<tr>
            <td>".$l['ID']."</td>
            <td>".date('d/m/Y H:i:s',strtotime($l['DATA']))."</td>
            <td>".$l['OPERADORA']."</td>
            <td>".$l['DDD']."</td>
            <td>".$l['FONE']."</td>
            <td>".$l['ORIGEM']."</td>
            <td>".$l['TIPO']."</td>
            <td>".$l['FINALIZACAO']."</td>
            <td>".$l['RAMAL']."</td> 
            <td>".$l['AGENTE']."</td>
            <td>".$l['CPF']."</td>
            <td>".$l['GRUPO']."</td> 
            <td>".$l['CONTRATO']."</td> 
            <td>".$l['DURACAO']."</td>";
            // if($l['atendimentopublica']=='-'){ 
            //     $html .= "<td>-</td>";
            // }else {
                $html .= "<td>".date('d/m/Y H:i:s',strtotime($l['AT_PUBLICA']))."</td>";
            // }
            // if($l['atendimentoramal']=='-'){ 
            //     $html .= "<td>-</td>";
            // } else { 
                $html .= "<td>".date('d/m/Y H:i:s',strtotime($l['AT_RAMAL']))."</td>";
            // }
            $html .= "<td>".date('d/m/Y H:i:s',strtotime($l['FIM_LIGACAO']))."</td>";
            $html .= "<td>".$l['STF_CODIGO']."</td>
            </tr>";
            if ($tipo==2) {
                echo $html;
                $html = '';
            }
        }
        $html .= "</table>";
        if ($tipo==2) {
            echo $html;
            $html = '';
        }
        if ($tipo==1) {
            printf($html);        
        }
    ?>
    <div class="pager">
        <div id="prevpage">
            </div>
    </div>
</div>
<div id="content_rel"></div>

