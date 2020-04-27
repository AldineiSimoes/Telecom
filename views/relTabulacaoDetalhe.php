<div class="container" style="font-size: 28;font-weight: bold;" visible=false>
        <!-- <a href="#" onclick="openPopupTabulacoes(<?php echo $dti.','. $dtf.','. $grupo.','.$camp.','. $agente.','. $ddd.','. $tel; ?>)"> -->
        <a href="#" onclick="openPopupTabulacoes()">
            <img src="<?php echo BASE_URL; ?>/assets/images/excel_icon_2003_32px.png">
            Exportar
        </a>
    </div>
<div class="panel-heading  text-center">TABULAÇÕES</div>
<table id="tb1" style="text-align: center;font-size:12px;" class="table w-100" >
    <tr class="cabecalho"  >
        <td >Id</td>
        <td >Data</td>
        <td >Operadora</td>
        <td >Direção</td>
        <td >Contrato</td>
        <td >DDD</td>
        <td >Telefone</td>
        <td >Tabulação</td>
        <td >Tipo tabulação</td>
        <td >Código Agente</td>
        <td >Nome Agente</td>
        <td >Tempo falado em segundos</td>
        <td >Grupo</td>
        <td >Campanha</td>                                                                
    </tr>
    <?php

//        if($rs==false){
//            echo "<script>alert(Sem registro para o periodo!)</script>";
//            exit();
//        }else
    ?>
    <?php foreach ($tab_list as $l): ?>
        <tr style="width: 400px;" >
            <td ><?php echo $l['id']; ?></td>
            <td ><?php echo date('d/m/Y H:i:s',strtotime($l['dh_inicio'])); ?></td>
            <td ><?php echo $l['operadora']; ?></td>
            <td ><?php echo $l['nome_direcao']; ?></td>
            <td ><?php echo $l['chave']; ?></td>
            <td ><?php echo $l['ddd']; ?></td>
            <td ><?php echo $l['fone']; ?></td>
            <td ><?php echo $l['nome_tabulacao']; ?></td>
            <td ><?php echo $l['nome_tipotabulacao']; ?></td>
            <td ><?php echo $l['cod_agente']; ?></td>
            <td ><?php echo $l['nome_agente']; ?></td>
            <td ><?php echo $l['tempo_segundos']; ?></td>
            <td ><?php echo $l['nome_grupo']; ?></td>
            <td ><?php echo $l['nome_campanha']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>
