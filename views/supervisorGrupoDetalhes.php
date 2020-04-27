<div style="margin: 10px;">
<table class="table" style="width: 300px;">
        <tr class="cabecalho">
            <td class="theadfundo" colspan="2" style="text-align:center;">Status Mailing</td>
        </tr>
        <tr class="cabecalho">
            <td class="theadfundo">STATUS</td>
            <td class="theadfundo">TOTAL</td>
        </tr>
        <?php foreach ($detalhes_grupo as $l): ?>
            <tr>
                <td align="center"><?php echo $l['stf_desc']; ?></td>
                <td align="center"><?php echo $l['total']; ?></td>
            </tr>
        <?php endforeach; ?>
</table>
<br>
<br>
<table id="detlista" class="table">
    <thead class="theadfundo">
        <tr class="cabecalho">
            <td class="theadfundo">HORARIO</td>
            <td class="theadfundo">DDD</td>
            <td class="theadfundo">FONE</td>
            <td class="theadfundo">ESTADO</td>
            <td class="theadfundo">NOME</td>
            <td class="theadfundo">TEMPO</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($detalhes_grupo_lista as $l): ?>
            <tr>
                <td align="center"><?php echo $l['horario']; ?></td>
                <td align="center"><?php echo $l['ddd']; ?></td>
                <td align="center"><?php echo $l['fone']; ?></td>
                <td align="center"><?php echo $l['estado']; ?></td>
                <td align="center"><?php echo ($l['nome'] == NULL ) ? '-' : $l['nome']; ?></td>
                <td align="center"><?php echo ($l['operadora'] == NULL ) ? '-' : $l['operadora']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<script>
    $(document).ready(function () {
        $('#detlista').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "paging": true,
            "pagingtypes": "full_numbers",
            scrollY: 400
        });
    });
</script>
