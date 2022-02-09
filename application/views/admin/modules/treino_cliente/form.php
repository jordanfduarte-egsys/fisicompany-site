<?php
    //Caminho completo
    echo $caminho;
    //cria o formulario
    echo form_open_multipart($action);
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $acao ?></legend>
    
    <label for="titulo">Nome</label>
    <input type="text" tabindex="1" name="nome"  class="form-control" value="<?php echo (isset($treino->nome) ? $treino->nome  : set_value("nome")) ?>"/>
    <?php echo form_error('nome', '<div class="alert alert-danger">', '</div>'); ?>
    
    <!-- <label for="link">Link</label>
    <div class="input-group">
        <span class="input-group-addon">http://</span>
        <input type="text" tabindex="2" name="link"  class="form-control" value="<?php echo (isset($treino->link) ? $treino->link  : set_value("link")) ?>"/>
    </div>
    <?php echo form_error('link', '<div class="alert alert-danger">', '</div>'); ?> -->
    
    
    <label for="status">Status</label>
    <select name="status">
        <option <?php echo (isset($treino->status) and $treino->status == 1) ? "selected"  : "" ?> value="1">Ativo</option>
        <option <?php echo (isset($treino->status) and $treino->status == 0) ? "selected"  : "" ?> value="0">Inativo</option>
    </select>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Imagem</legend>
        <div class="info_uploade">
            <p>
                Uploade de imagem no formato jpg, gif e png.<br/>
                <b>    
Importante: </b>Dimensões recomendada 1020 x 800 px.
            </p>
        </div>        
        <div id="fileuploader">    
Adicionar imagem</div>
        <div id="imagem_pos_upload">            
            <img src="/assets/<?php echo (isset($treino->imagem)) ? "media/treino_cliente/".$treino->imagem : "img/sem_foto.gif" ?>"/>
            <br/><?php echo form_error('imagem', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <input type="hidden" id="imagem" name="imagem" value="<?php echo (isset($treino->imagem)) ? $treino->imagem : ""?>"/>
        
        
    </fieldset>

    <br/>
    <input type="hidden" name="id_treino_cliente" value="<?php echo (isset($treino->id_treino_cliente) ? $treino->id_treino_cliente : "")?>"/>
    <!-- <input type="hidden" name="ordem" value="<?php echo (isset($treino->ordem) ? $treino->ordem : "")?>"/> -->
    <?php
        //Métodos padrão para finalização do padrão de formulários
        //Button submit
        echo form_submit("ok", "Salvar", "class='btn btn-success'");
        //Acnora para cancelars
        echo anchor($this->uri->segment(2),"Cancelar", "class='btn btn-danger dropdown-toggle'");
        //Fecha Formulário
        echo form_close();        
    ?>
</fieldset>

