<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/recording.css'>


<div id='recordingPrincipal'>
    <div id="playrec">
        <audio id="audioplay" autoplay controls>
        </audio>
    </div>

    <div class='divform'>

        <form method="POST" id="formrec">
            <table class="table">
                <tr>
                    <td>Data Inicio:</td>
                    <td class='td2'><input name="data_inicio" type=date></td>
                </tr>
                <tr>
                    <td>Data Fim:</td>
                    <td class='td2'><input name="data_fim" type=date></td>
                </tr>
                <tr>
                    <td>Operação:</td>
                    <td class='td2'>
                        <select name="oper" id="oper" required>
                            <option  value="0">AMBOS</option>
                            <option  value="1">ATIVO</option>
                            <option  value="2">RECEPTIVO</option>
                            <option  value="3">EVENTO</option>
                            <option  value="4">MONITORIA</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Campanha:</td>
                    <td class='td2'>
                        <select name="camp" id="camp" required>
                            <option  value="0">TODOS</option>
                            <?php foreach ($campanha_list as $c): ?>
                                <option id="opcamp" value="<?php echo $c['ID_CAMPANHA']; ?>">
                                    <?php echo $c['CAMP_DESC']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Agente:</td>
                    <td class='td2'>
                        <select name="agents" id="agents" required>
                            <option  value="0">TODOS</option>
                            <?php foreach ($agents_list as $a): ?>
                                <option id="opag" value="<?php echo $a['id']; ?>">
                                    <?php echo $a['nome']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>DDD:</td>
                    <td class='td2'><input name="ddd" maxlength='2'></td>
                </tr>
                <tr>
                    <td>Telefone:</td>
                    <td class='td2'><input  name="fone" maxlength='9'></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td class='td2'><input name="id"></td>
                </tr>
                <tr>
                    <td colspan=2 style="background-color:#CD5C5C;"> <!--class="tdvazio"--></td>
                </tr>
                <tr>
                    <td colspan=2 class="btbuscar btbuscar3"><input class="btbuscar btbuscar2" type="submit" value="LOCALIZAR"></td>
                </tr>

            </table>
        </form>
    </div>

</div>
<div id="resultFind">
    <table class="tableresultFind" id="tabrec">
        <tr>
            <th class="trmenuresultFind">ID</th>
            <th class="trmenuresultFind">AUDIO</th>
            <th class="trmenuresultFind">DATA</th>
            <th class="trmenuresultFind">AREA</th>
            <th class="trmenuresultFind">FONE</th>
            <th class="trmenuresultFind">OPERADORA</th>
            <th class="trmenuresultFind">GRUPO</th>
            <th class="trmenuresultFind">DURAÇÃO</th>
            <th class="trmenuresultFind">DIREÇÃO</th>
            <th class="trmenuresultFind">CAMPANHA</th>
        </tr>
    </table>
    <div class="pag_item">Pagina
        <select id="pagit" name="pag">
            <option value=""></option>
        </select>
    </div>
</div>
<!-- <div class="box_play">
     <audio id="audioplay" autoplay controls>
     </audio>
 </div>-->
