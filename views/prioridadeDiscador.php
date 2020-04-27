
<?php
include 'views/discador.php';
?>

<br/>
<br/>
<br/>
<script>
</script>
<div class="container" id="comtempriodidade">

    <div class="tblistcampanhas text-center">
        <a href="javascript:void(0)" onclick="cadastroPrioridade(0)" id="btnprioridade"><input  value="Incluir" type="button"  class="btn btn-primary w-25"></a>
        <form method="POST"  id="formgrupoprioridade" >
            Selecione o grupo para visualização <br/>
            <select name="groupprioridade" id="groupprioridade" class="btn btn-default dropdown-toggle js-example-basic-multiple"  required>
                <option id="opgr" value="0">Todos</option>
                <?php foreach ($group_list as $g): ?>
                    <option id="opgr" value="<?php echo $g['id_grupo']; ?>">
                        <?php echo $g['id_grupo'] . ' - ' . $g['descricao']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
    <div id="formoprota">

    </div>


    <div id="areaprioridade">
    <?php
    include 'views/prioridadeDiscadorLista.php';
    ?>
    </div>
</div> 
<script>

</script>


