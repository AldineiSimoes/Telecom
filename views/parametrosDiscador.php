<?php
include 'views/discador.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<style>
body{
overflow-x: auto !important;
overflow-y: auto !important;
}
</style>
<div id="parametros" class="container">
    <br>
    <br>
    <form id="fParametros">
        <h3> Discador </h3>
        <select id="selParam" name="selParam" class="form-control w-25" >
           <option id="paramDisc" value=""></option>
            <?php foreach ($discadores_list as $l): ?>
              <option id="paramDisc" value="<?php echo $l['ID_DISCADOR']; ?>">
                <?php echo $l['CONF_DESC']; ?>
              </option>
            <?php endforeach; ?>
        </select>
    </form>
    <div id="paramList"></div>
</div>
