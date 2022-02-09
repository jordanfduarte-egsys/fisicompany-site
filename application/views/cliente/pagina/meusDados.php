
    <?php
    //Caminho completo
    
    //cria o formulario
    echo form_open_multipart("cliente/index/valida");    
?>    

<fieldset class="scheduler-border">
    <legend class="scheduler-border text-muted"><span class="glyphicon glyphicon-user"></span>&nbsp;Meus dados</legend>
    
    <label for="nome">Nome</label>
    <input type="text" tabindex="1" readonly="true" name="nome"  class="form-control" value="<?php echo (isset($usuario->cliente_nome) ? $usuario->cliente_nome  : set_value("nome")) ?>"/>
    <?php echo form_error('nome', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="sobre_nome">Sobre nome</label>
    <input type="text" tabindex="2" name="sobre_nome" readonly="readonly" class="form-control" value="<?php echo (isset($usuario->sobre_nome) ? $usuario->sobre_nome  : set_value("sobre_nome")) ?>"/>
    <?php echo form_error('sobre_nome', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="email">E-mail</label>
    <div class="input-group">
        <span class="input-group-addon">@</span>
            <input type="text" tabindex="3" name="email" readonly="readonly" class="form-control" value="<?php echo (isset($usuario->email) ? $usuario->email  : set_value("email")) ?>"/>
    </div>
    <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Senha</legend>
        <b>    
Importante: </b>mínino (6 digitos)
        <label for="senhaconf" style="margin-left: 195px;">Confirme a senha</label>
        <div class="btn-group">
            <input type="password" tabindex="5" name="senha" class="form-control" value="<?php echo isset($usuario->senha) ? $usuario->senha : set_value("senha") ?>"/>
        </div>
        <div class="btn-group">
            <input type="password" tabindex="6" name="senhaconf" class="form-control" value=""/>
        </div>
        <?php echo form_error('senha', '<div class="alert alert-danger">', '</div>'); ?>
        <?php echo form_error('senhaconf', '<div class="alert alert-danger">', '</div>'); ?>
    
    </fieldset>
    
    
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Imagem</legend>
        <div class="info_uploade">
            <p>
                Uploade de imagem no formato jpg, gif e png.<br/>
                <b>    
Importantee: </b>Dimensões recomendada 200 x 80 px.
            </p>
        </div>        
        <div id="fileuploader">    
Adicionar imagem</div>
        <div id="imagem_pos_upload">
            <img  class="img-thumbnail" src="<?php echo PATH_ADM?>/img/usuario/<?php echo !empty($usuario->foto) ? $usuario->foto : "../produto_sem_foto.gif"; ?>"/>
            <br/><?php echo form_error('imagem', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <input type="hidden" id="imagem" name="foto" value="<?php echo (!empty($usuario->foto)) ? $usuario->foto : set_value("foto")?>"/>
        <input type="hidden" name="acesso_cliente" value="<?php echo (!empty($usuario->acesso_cliente)) ? $usuario->acesso_cliente : 0 ?>"/>
        
    </fieldset>
    <br/>
    
    <input type="hidden" name="id_usuario" value="<?php echo (isset($usuario->id_usuario) ? $usuario->id_usuario : "")?>"/>
    <input type="hidden" name="id_permissao" value="<?php echo (isset($usuario->id_permissao) ? $usuario->id_permissao : "")?>"/>    
    <?php
        //Métodos padrão para finalização do padrão de formulários
        //Button submit
        echo form_submit("ok", "Salvar", "class='btn btn-success'");
                
        //Fecha Formulário
        echo form_close();
    ?>
</fieldset>


