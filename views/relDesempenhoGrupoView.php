<div class="panel-heading  text-center">Desenpenho dos Grupos</div>
<table id="tb1" style="text-align: center;font-size:12px;" class="table w-100" >
    <tr class="cabecalho"  >
        <td >HORA</td>
        <td >LOGADOS</td>
        <td >DISPAROS</td>
        <td >AT.RAMAL</td>
        <td style="width: 400px;">%&nbsp;&nbsp;</td>
        <td >NÃƒO ATENDIDA</td>
        <td style="width: 400px;">%&nbsp;&nbsp; </td>
        <td >OCUPADO</td>
        <td style="width: 400px;">%&nbsp;&nbsp; </td>
        <td >NÃƒO EXISTE</td>
        <td style="width: 400px;">%&nbsp;&nbsp; </td>
        <td >FORA DE SERVIÃ‡O</td>
        <td style="width: 400px;">%&nbsp;&nbsp; </td>
        <td >CX.POSTAL</td>
        <td style="width: 400px;">%&nbsp;&nbsp; </td>
        <td >CONGESTIONAMENTO OPERADORA</td>
        <td style="width: 400px;">%&nbsp;&nbsp; </td>
        <td >CANCELADAS</td>
        <td style="width: 400px;">%&nbsp;&nbsp; </td>
        <td >NO AGENT</td>
        <td style="width: 400px;">&nbsp;%&nbsp; </td>
        <td >ALO</td>
        <td style="width: 400px;">&nbsp;%&nbsp; </td>
		<td >CPC</td>
        <td style="width: 400px;">&nbsp;%&nbsp; </td>
        <td >Sucesso</td>
        <td style="width: 400px;">&nbsp;%&nbsp; </td>
		<td >Insucesso</td>
        <td style="width: 400px;">&nbsp;%&nbsp; </td>
    </tr>
    <?php

//        if($rs==false){
//            echo "<script>alert(Sem registro para o periodo!)</script>";
//            exit();
//        }else
    ?>
    <?php foreach ($desempenho_list as $l): ?>
        <tr style="width: 400px;" >
            <td ><?php echo $l['datadia']; ?></td>
            <td ><?php echo $l['logados']; ?></td>
            <td ><?php echo $l['disparos']; ?></td>
            <td ><?php echo $l['at_ramal']; ?></td>
            <td ><?php echo $l['perc_at_ramal']; ?></td>
            <td ><?php echo $l['nao_atendidas']; ?></td>
            <td ><?php echo $l['perc_nao_atendidas']; ?></td>
            <td ><?php echo $l['ocupado']; ?></td>
            <td ><?php echo $l['perc_ocupado']; ?></td>
            <td ><?php echo $l['nao_existe']; ?></td>
            <td ><?php echo $l['perc_nao_existe']; ?></td>
            <td ><?php echo $l['fora_servico']; ?></td>
            <td ><?php echo $l['perc_fora_servico']; ?></td>
            <td ><?php echo $l['caixa_postal']; ?></td>
            <td ><?php echo $l['perc_caixa_postal']; ?></td>
            <td ><?php echo $l['congestionamento_operadora']; ?></td>
            <td ><?php echo $l['perc_congestionamento_operadora']; ?></td>
            <td ><?php echo $l['cancelada']; ?></td>
            <td ><?php echo $l['perc_cancelada']; ?></td>
            <td ><?php echo $l['no_agents']; ?></td>
            <td ><?php echo $l['perc_no_agents']; ?></td>
            <td ><?php echo $l['alo']; ?></td>              
            <td ><?php echo $l['perc_alo']; ?></td>                                
            <td ><?php echo $l['cpc']; ?></td>
            <td ><?php echo $l['perc_cpc']; ?></td>
            <td ><?php echo $l['sucesso']; ?></td>
            <td ><?php echo $l['perc_sucesso']; ?></td>
            <td ><?php echo $l['improdutivas']; ?></td>
            <td ><?php echo $l['perc_improdutivas']; ?></td>
    </tr>
    <?php endforeach; ?>
    <tr  style="width: 400px;" >
        <td >Total</td>
    </tr>

</table>
