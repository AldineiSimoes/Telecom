<?php ?>

<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/campanha.css'>
<br/>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <form id="selLog" method="POST" action="<?php echo BASE_URL; ?>/logs">
                <div class="col-lg-4">
                    <br/>
                    <select id="selectLog" name="select" class="form-control">
                        <option value="0">SELECIONE UM TIPO DE LOG:</option>
                        <option value="1">Configuração do discador</option>
                        <option value="2">Parâmetros</option>
                        <option value="3">Rotas</option>
                    </select>
                </div>
                <div class="col-lg-8">
                    <div class="col-lg-3">Período de:
                        <input class="form-control" name="data_inicio"  type=date value="<?php echo date('Y-m-d'); ?>" />
                        
                    </div>
                    <div class="col-lg-3">Até:
                        <input class="form-control" name="data_fim" type=date value="<?php echo date('Y-m-d'); ?>" />
                    </div>
                    <br>
                    <div class="col-lg-3">
                        <input class="form-control btn-info" type="submit" value="Selecionar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>
    <br/>
    <div class="row">
    <div class="PeriodoSel panel panel-primary">
        <div class="panel-heading w-100 text-center" id="contemLog"><?php echo $log; ?></div>
        <table class="tblog table table-hover" id="tbLog">
            <thead class="thead-default">
                <tr>
                    <th class="tdlog" scope="col">Grupo</th>
                    <th class="tdlog" scope="col">Data</th>
                    <th class="tdlog" scope="col">Hora</th>
                    <th class="tdlog" scope="col">Usuario</th>
                    <th class="tdlog" scope="col">Descrição</th>
                    <th class="tdlog" scope="col">Anterior</th>
                    <th class="tdlog" scope="col">Atual</th>
                </tr>
            <thead>
            <thead class="thead-inverse">
                <?php foreach ($dados as $l): ?>
                    <tr>
                        <td class="tdlog"><?php echo $l['grupo']; ?></td>
                        <td class="tdlog"><?php echo date('d/m/Y', strtotime($l['data'])); ?></td>
                        <td class="tdlog"><?php echo date('H:m:s', strtotime($l['data'])); ?></td>
                        <td class="tdlog"><?php echo $l['usuario']; ?></td>
                        <td class="tdlog"><?php echo $l['descricao']; ?></td>
                        <td class="tdlog"><?php echo $l['anterior']; ?></td>
                        <td class="tdlog"><?php echo $l['atual']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <thead>
        </table>
    </div>
    </div>
    <div class="title2">
        <?php echo $viewData['title2']; ?>
    </div>
</div>
