<?php
    //Caminho completo
    echo $caminho;
    //cria o formulario
    echo form_open_multipart($action);
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $acao ?></legend>
    
    <label for="titulo">Título</label>
    <input type="text" tabindex="1" name="titulo"  class="form-control" value="<?php echo (isset($banner->titulo) ? $banner->titulo  : set_value("titulo")) ?>"/>
    <?php echo form_error('titulo', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="link">Link</label>
    <div class="input-group">
        <span class="input-group-addon">http://</span>
        <input type="text" tabindex="2" name="link"  class="form-control" value="<?php echo (isset($banner->link) ? $banner->link  : set_value("link")) ?>"/>
    </div>
    <?php echo form_error('link', '<div class="alert alert-danger">', '</div>'); ?>
    
    
    <label for="status">Status</label>
    <select name="status">
        <option <?php echo (isset($banner->status) and $banner->status == 1) ? "selected"  : "" ?> value="1">Ativo</option>
        <option <?php echo (isset($banner->status) and $banner->status == 0) ? "selected"  : "" ?> value="0">Inativo</option>
    </select>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Imagem</legend>
        <div class="info_uploade">
            <p>
                Uploade de imagem no formato jpg, gif e png.<br/>
                <b>    
Importante: </b>Dimensões recomendada 1280 x 450 px.
            </p>
        </div>        
        <div id="fileuploader">    
Adicionar imagem</div>
        <div id="imagem_pos_upload">            
            <img src="/assets/<?php echo (isset($banner->imagem)) ? "media/banner/".$banner->imagem : "img/sem_foto.gif" ?>"/>
            <br/><?php echo form_error('imagem', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <input type="hidden" id="imagem" name="imagem" value="<?php echo (isset($banner->imagem)) ? $banner->imagem : ""?>"/>
        
        
    </fieldset>

    <br/>
    <input type="hidden" name="id_banner" value="<?php echo (isset($banner->id_banner) ? $banner->id_banner : "")?>"/>
    <input type="hidden" name="ordem" value="<?php echo (isset($banner->ordem) ? $banner->ordem : "")?>"/>
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

