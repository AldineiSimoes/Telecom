<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/user.css"/>

<div class="container">
<!--    <div class="row">
        <div class="col-lg-12">
            <br/>
            <a href="<?php echo BASE_URL; ?>/users/add"><input type="submit" class="btn btn-primary" value="Adicionar Usuário"></a>
            <div class="btn btn-primary"><a href="<?php echo BASE_URL; ?>/users/add">Adicionar Usuário</a><br/></div>
            <br/><br/>
        </div>
    </div>-->
<br/>
<br/>
<br/>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">USUÁRIOS</div>
                <table class="table tbusers">
                    <tr>
                        <th>Nome do usuário</th>
                        <th>Grupo de permissões</th>
                        <th width="160">Ação</th>
                    </tr>
                    <?php foreach ($users_list as $user): ?>
                        <tr>
                            <td><?php echo $user['login']; ?></td>
                            <td width="200"><?php echo $user['name']; ?></td>
                            <td>
                                <a href="#" onclick="userCarteiras(<?php echo $user['id']; ?>)" title="Carteiras"><img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/campaign.png" style="width: 25px;height: 25px;margin-right: 30px;" ></a>
                                <a href="#" onclick="selUser(<?php echo $user['id']; ?>)" title="Editar"><img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" ></a>
                                <a href="<?php echo BASE_URL; ?>/users/delete/<?php echo $user['id']; ?>" onclick="return confirm('Excluir usuario ?')" title="Excluir"><img class="imgtrash" src="<?php echo BASE_URL; ?>/assets/images/trash.png" style="width: 20px;height: 20px;" ></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <form method="post" id="fUsuario">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">EDITAR | NOVO</div>
                <input type="hidden" name="usuario" id="usuario" value="0" />
                <table class="table">
                    <tr>
                        <td>Login</td>
                        <td><input name="login" id="login" class="form-control"></td> 
                    </tr>
                    <tr>
                        <td>Senha</td>
                        <td><input name="password" id="password" type="password" class="form-control"></td> 
                    </tr>
                    <tr>
                        <td>Usuário de Monitoria</td>
                        <td>
                            <select class="form-control" name="usermon" id="usermon">
                                <option></option>
                                <?php foreach ($agentes_list as $a): ?>
                                    <option value="<?php echo $a['username']; ?>"><?php echo $a['nome']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td>Grupo de permissões</td>
                        <td> <select class="form-control" name="group" id="group">
                            <?php foreach ($group_list as $g): ?>
                                <option value="<?php echo $g['id']; ?>"><?php echo $g['name']; ?></option>
                            <?php endforeach; ?>
                            </select></td> 
                    </tr>
                </table>
            </div>
            <input type="submit" class="btn btn-primary w-25" value="Salvar">
            </form>
        </div>
    </div>
</div>
<div id="fade" class="black_overlay" onclick="exitDivDetalhar()"></div>
<div class="divDetalhar" id="idDetalhar" style="padding-right: 1%;">
    <a href="#" onclick="exitDivDetalhar()">Sair</a>
</div>
