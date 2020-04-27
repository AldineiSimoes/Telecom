<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<script>
            .cabecalho {
                width: 100px;
            }
    
</script>
<div id="conteudo" class="container">
<!--    <div id="img"><img src="../../../img/loading2.gif" /></div>
    <h1></h1>
    <div class="barra_relatorios">
        <div class="botoes_relatorios">
            <div class="espacador_botoes"></div>
        </div>
    </div>-->
    <br/>
    <br/>
    <div class="panel panel-primary w-50">
        <div class="panel w-100 text-center panel-heading">Resumo das Ligações</div>
    <table class="table" id="tb2" style="text-align: center;">
        <tr class="cabecalho td3" > 
            <th>DDD</th>
            <th>Primewiro ATT</th>
            <th>Último ATT</th>
            <th>Ligações</th>
            <th>Duração</th>
            <th>Custo</th>
        </tr>
        <?php foreach ($relResumo as $l): ?>
            <tr>
                <td><?php echo $l['DDD']; ?></td>
                <td><?php echo $l['PRIMEIRO_ATT']; ?></td>
                <td><?php echo $l['ULTIMO_ATT']; ?></td>
                <td><?php echo $l['QTDE']; ?></td>
                <td><?php echo $l['TEMPO']; ?></td>
                <td><?php echo $l['VALOR']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
    <div class="pager">
        <div id="prevpage"></div>
    </div>
</div>

<div id="content_rel"></div>

