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
        <th>Grupo</th>
        <th>Contrato</th>
        <th>Duração</th>
        <th>At. Publica</th>
        <th>At. Ramal</th>
        <th>Fim Ligação</th>
        <th>Custo</th>
        <th>Valor Tarifa</th>
    </tr>';
    foreach ($custos_list as $l) {
        $html .= "<tr>
        <td>".$l['id_cdr']."</td>
        <td>".date('d/m/Y H:i:s',strtotime($l['cdr_dh_inicio']))."</td>
        <td>".$l['operadora']."</td>
        <td>".$l['ddd_numero']."</td>
        <td>".$l['cdr_fone']."</td>
        <td>".$l['origem_desc']."</td>
        <td>".$l['mod_desc']."</td>
        <td>".$l['stf_desc']."</td>
        <td>".$l['ramal']."</td> 
        <td>".$l['agente']."</td>
        <td>".$l['descricao']."</td> 
        <td>".$l['chave']."</td> 
        <td>".$l['tar_segundos']."</td>
        <td>".date('d/m/Y H:i:s',strtotime($l['cdr_dh_at_publica']))."</td>
        <td>".date('d/m/Y H:i:s',strtotime($l['dh_at_ramal']))."</td>
        <td>".date('d/m/Y H:i:s',strtotime($l['cdr_dh_fimligacao']))."</td>
        <td>".$l['tar_valor']."</td> 
        <td>".$l['valor_tarifa']."</td> 
        </tr>";
    }
    $html .= "</table>";
    // Configurações header para forçar o download
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"Custos.xls\"" );
    header ("Content-Description: PHP Generated Data" );

    echo $html;        
?>
