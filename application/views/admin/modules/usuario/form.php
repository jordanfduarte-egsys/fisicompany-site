<?php
    //Caminho completo
    echo $caminho;
    //cria o formulario
    echo form_open_multipart($action);

?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">
        <?php echo $acao ?>
    </legend>

    <label for="nome">Nome</label>
    <input type="text" tabindex="1" name="nome"  class="form-control" value="<?php echo  isset($usuario[0]->nome) ? $usuario[0]->nome : set_value("nome") ?>"/>
    <?php echo form_error('nome', '<div class="alert alert-danger">', '</div>') ?>

    <label for="sobre_nome">Sobre nome</label>
    <input type="text" tabindex="2" name="sobre_nome" class="form-control" value="<?php echo isset($usuario[0]->sobre_nome) ? $usuario[0]->sobre_nome : set_value("sobre_nome") ?>"/>
    <?php echo form_error('sobre_nome', '<div class="alert alert-danger">', '</div>'); ?>

    <label for="email">E-mail</label>
    <div class="input-group">
        <span class="input-group-addon">@</span>
        <input type="text" tabindex="3" class="form-control" name="email" value="<?php echo isset($usuario[0]->email) ? $usuario[0]->email : set_value("email") ?>"/>        
    </div>
    <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
    <br/>    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Senha</legend>
        <b>    
Importante: </b>mínino (6 digitos)
        <label for="senhaconf" style="margin-left: 195px;">Confirme a senha</label>
        <div class="btn-group">
            <input type="password" tabindex="5" name="senha" class="form-control" value="<?php echo isset($usuario[0]->senha) ? $usuario[0]->senha : set_value("senha") ?>"/>
        </div>
        <div class="btn-group">
            <input type="password" tabindex="6" name="senhaconf" class="form-control" value=""/>
        </div>
        <?php echo form_error('senha', '<div class="alert alert-danger">', '</div>'); ?>
        <?php echo form_error('senhaconf', '<div class="alert alert-danger">', '</div>'); ?>
    
    </fieldset>
        
    <label for="id_permissao">Permissão</label>
    <select name="id_permissao" class="selectpicker" tabindex="7">
            <option>Nenhuma</option>
        <?php foreach($permissoes as $permissao){?>
            <option <?php echo (isset($usuario[0]->id_permissao) and $usuario[0]->id_permissao == $permissao->id_permissao) ? "selected" : ""?> value="<?php echo $permissao->id_permissao?>" ><?php echo $permissao->nome ?></option>
        <?php } ?>
    </select>
    
    <img  style="width: 200px;float: right;" class="img-thumbnail" src="<?php echo BASE_PATH?>assets/<?php echo (!empty($usuario[0]->foto)) ? "media/perfil/".$usuario[0]->foto : "img/sem_user.jpg" ?>"/>
    <label for="acesso_cliente">
        <input name="acesso_cliente" id="acesso_cliente" type="checkbox"  <?php echo ((isset($usuario[0]->acesso_cliente) and $usuario[0]->acesso_cliente)  ? "checked" : "")?>  tabindex="8" value="1"/>&nbsp;Acesso Cliente        
    </label>
    
    <br/><br/><br/>
    <input type="hidden" name="id_usuario" value="<?php echo (isset($usuario[0]->id_usuario) ? $usuario[0]->id_usuario : "")?>"/>
    <?php

        echo form_submit("ok", "Salvar", "class='btn btn-success'");
        echo anchor("usuario","Cancelar", "class='btn btn-danger dropdown-toggle'");
        echo form_close();
    ?>
</fieldset>