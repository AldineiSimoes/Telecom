<div class="container" style="width: 800px;">
    <br/>
    <br/>
    <?php if (isset($erro) && !empty($erro)): ?>
        <div class="warn"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">ADICIONAR USUÁRIO</div>
            <table class="table">
                <tr for="login">
                    <td>Login</td>
                    <td><input type="text" name="login" class="form-control" required></td>
                </tr>
                <tr for="password">
                    <td>Senha</td>
                    <td><input type="password" name="password" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Usuario para monitoria</td>
                    <td>
                        <select name="usermon" id="usermon" class="form-control" required>
                            <?php foreach ($agentes_list as $a): ?>
                                <option value="<?php echo $a['username']; ?>"><?php echo $a['nome']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Grupos de permissões</td>
                    <td>
                        <select name="group" id="group" class="form-control" required>
                            <?php foreach ($group_list as $g): ?>
                                <option value="<?php echo $g['id']; ?>"><?php echo $g['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>

        <input class="btn btn-primary w-25" type="submit" value="Adicionar">


    </form>

</div>