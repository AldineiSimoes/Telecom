<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/recording.css'>

<div class="row">
<div col-lg-4>
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
                        <td class='td2'><input name="data_inicio" type=date value="<?php echo date('Y-m-d'); ?>"></td>
                    </tr>
                    <tr>
                        <td>:</td>
			            <td class='td2'><input name="hora_inicio" type=time value="00:00:00"></td>
                    </tr>
                    <tr>
                        <td>Data Fim:</td>
                        <td class='td2'><input name="data_fim" type=date value="<?php echo date('Y-m-d'); ?>"></td>
                    </tr>
                    <tr>
                        <td>:</td>
			            <td class='td2'><input name="hora_fim" type=time value="23:59:00"></td>
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
                        <td>Qtd. por página:</td>
                        <td class='td2'>
                            <select name="qtpg" id="qtpg" required>
                                <option  value="10">10</option>
                                <option  value="25">25</option>
                                <option  value="50">50</option>
                                <option  value="100">100</option>
                            </select>
                        </td>
                    </tr>
<!--                    <tr>
                        <td colspan=2 style="background-color:#CD5C5C;"> class="tdvazio"</td>
                    </tr>
                    <tr>
                        <td colspan=2 class="btbuscar text-center"><img src="<?php echo BASE_URL; ?>/assets/images/music2.png"></td>
                    </tr>-->

                </table>
              <input class="form-control btn-primary" type="submit" value="LOCALIZAR">
            </form>
        </div>

    </div>
</div>
    <br/>
 
    
<div class="col-lg-8 baserec" style="margin-top:10px;position: fixed;left:320px;z-index: 1; height: 500px;width: 1024px; overflow-x:auto;overflow-y:auto;">
    <div id="resultFind">
        <div class="panel panel-primary">
                    <div class="panel-heading w-100 text-center">BUSCA GRAVAÇÃO</div>
        <table class="tableresultFind table table-hover" id="tabrec">
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
        </table>
        </div>
        <div class="pag_item">Página
            <!-- <label for="Pagina">Paginas</label>
                <input type="text" name="Pagi" class="form-control" > -->
            <select id="pagit" name="pag" class="form-control">
                <option value="">0</option>
            </select>
        </div>
        <div id="msgRec"></div>
    </div>
</div>

<!-- <div class="box_">
     <audio id="audioplay" autoplay controls>
     </audio>
 </div>-->
</div>