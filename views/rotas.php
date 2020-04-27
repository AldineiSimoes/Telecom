

<!--<script src="<?php echo BASE_URL; ?>/assets/js/select2.min.js"></script>-->

<?php
include 'views/campanhas.php';
?>

<br/>
<br/>
<br/>
<script>
</script>
<div class="container">
    <div class="tblistcampanhas text-center">
        <form method="POST"  id="formgruporota" >

    Selecione o grupo para visualização <br/><!--<label for="group">GRUPO MONITORADO - <?php echo $idgroup . ' - ' . $groupName ?></label>-->
            <select name="grouprota" id="grouprota" class="btn btn-default dropdown-toggle js-example-basic-multiple"  required>
                <option id="opgr" value="0"></option>
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

</div>
<script>

</script>


