<div class="panel panel-primary">
    <div class="panel-heading w-100 text-center">BUSCA GRAVAÇÃO</div>
    <table class="tableresultFind table" id="tabrec">
        <thead class="threc">
            <tr>
                <!-- <th class="trmenuresultFind" scope="col">ID</th> -->
                <th class="trmenuresultFind" scope="col">AUDIO</th>
                <th class="trmenuresultFind" scope="col">DATA</th>
                <th class="trmenuresultFind" scope="col">AREA</th>
                <th class="trmenuresultFind" scope="col">FONE</th>
                <th class="trmenuresultFind" scope="col">OPERADORA</th>
                <th class="trmenuresultFind" scope="col">GRUPO</th>
                <th class="trmenuresultFind" scope="col">DURAÇÃO</th>
                <th class="trmenuresultFind" scope="col">DIREÇÃO</th>
                <th class="trmenuresultFind" scope="col">CAMPANHA</th>
            </tr>
        </thead>
        <tbody class="tbodyrec">
            <?php foreach ($record_list as $l): ?>
                <tr class="trdetailresultfind">
                    <!-- <td class="trdetailresultfind"><?php echo $l['id']; ?></td> -->
                    <td class="trdetailresultfind">
                        <a href="#">
                            <img src="<?php echo BASE_URL; ?>/assets/images/info.png" class="btlistagravacoes" 
                                 title="Informações" onclick="">
                        </a>
                        <a href="#">
                            <img src="<?php echo BASE_URL; ?>/assets/images/play-button.png" class="btlistagravacoes" 
                                 title="Play" onclick="tocarRec(<?php echo $l['id']; ?>)">
                        </a>
                        <a href="#">
                            <img src="<?php echo BASE_URL; ?>/assets/images/download.png" class="btlistagravacoes" title="Download"
                                 onclick="downRec(<?php echo $l['id']; ?>)"></td>
                        </a>
                    <td class="trdetailresultfind"><?php echo $l['dh_inicio']; ?></td>
                    <td class="trdetailresultfind"><?php echo $l['ddd']; ?></td>
                    <td class="trdetailresultfind"><?php echo $l['fone']; ?></td>
                    <td class="trdetailresultfind"><?php echo $l['nome_operadora']; ?></td>
                    <td class="trdetailresultfind"><?php echo $l['nome_grupo']; ?>'</td>
                    <td class="trdetailresultfind"><?php echo gmdate("H:i:s",$l['tempo_segundos']); ?></td>
                    <td class="trdetailresultfind"><?php echo $l['nome_direcao']; ?></td>
                    <td class="trdetailresultfind"><?php echo $l['nome_campanha']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    <div class="pag_item">Página    
        <select id="pagit" name="pag" class="form-control">
            <?php
            for ($i = 1; $i <= ($p_count / $limit + 1); $i++) {
                $html = '<option class="oppagit" value="' . $i . '"';
                if ($i == $p) {
                    $html .= 'selected';
                }
                $html .= '>' . $i . '</option>';
                echo $html;
                if ($i == $p) {
                    echo 'selected';
                }
            };
            ?>
        </select> 
    </div>
    <div id="msgRec"></div>
    <script>
        $(document).ready(function () {
            $('#pagit').bind('change', function (e) {
                e.preventDefault();
                var param = $('#formrec').serialize();
                var p = $('#pagit').val();
                param = param + '&p=' + p;
                $('.pag_item').remove();
                listRecording(param);
            });
        })
    </script>
