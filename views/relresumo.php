<?php
include 'views/relatorios.php';
?>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/relatorios.css'>
<div id='divrelResumo'>
    <div id='custosPrincipal'>Resumo
        <div class='divform'>
            <form method="POST" id="formrelresumos" >
                <table>
                    <tr>
                        <td>Data Inicio:</td>
                        <td class='td2'><input name="data_inicio" type=date value="<?php echo date('Y-m-d'); ?>"></td>
                    </tr>
                    <tr>
                        <td>Data Fim:</td>
                        <td class='td2'><input name="data_fim"type=date value="<?php echo date('Y-m-d'); ?>"></td>
                    </tr>
                    <tr>
                        <td>Grupo:</td>
                        <td class='td2'>
                            <select name="grupo" id="grupo" required>
                                <option  value="0">TODOS</option>
                                <?php foreach ($group_list as $l): ?>
                                    <option value="<?php echo $l['id_grupo']; ?>">
                                        <?php echo $l['descricao']; ?>
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
                        <td colspan=2 class="td3"></td>
                    </tr>
                    <tr>
                        <td colspan=2 class='td3'><input class="form-control btn-primary" type="submit" value="LOCALIZAR"></td>
                    </tr>
		</table>
            </form>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report.js"></script>
        </div>
    </div>
	<div class="container divarealig">
        <div id="relResumo" class="container"></div>
   </div>
</div>