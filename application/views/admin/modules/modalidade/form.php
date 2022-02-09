<?php
    //Caminho completo
    echo $caminho;
    //cria o formulario
    echo form_open_multipart($action);
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $acao ?></legend>
    
    <label for="nome">Nome</label>
    <input type="text" tabindex="1" name="nome"  class="form-control" value="<?php echo (isset($modalidade->nome) ? $modalidade->nome  : set_value("nome")) ?>"/>
    <?php echo form_error('nome', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="texto">Texto</label>
    <textarea name="texto">
        <?php echo (isset($modalidade->texto) ? $modalidade->texto  : set_value("exto")) ?>
    </textarea>
    <?php echo form_error('texto', '<div class="alert alert-danger">', '</div>'); ?>
    
        
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Imagem</legend>
        <div class="info_uploade">
            <p>
                Uploade de imagem no formato jpg, gif e png.<br/>
                <b>    
Importante: </b>Dimensões recomendada 182 x 160 px.
            </p>
        </div>        
        <div id="fileuploader">    
Adicionar imagem</div>
        <div id="imagem_pos_upload">            
            <img src="/assets/<?php echo (isset($modalidade->imagem)) ? "media/modalidade/".$modalidade->imagem : "img/sem_foto.gif" ?>"/>
            <br/><?php echo form_error('imagem', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <input type="hidden" id="imagem" name="imagem" value="<?php echo (isset($modalidade->imagem)) ? $modalidade->imagem : ""?>"/>
    </fieldset>
    <br/>
    <input type="hidden" name="id_modalidade" value="<?php echo (isset($modalidade->id_modalidade) ? $modalidade->id_modalidade : "")?>"/>
    <input type="hidden" name="ordem" value="<?php echo (isset($modalidade->ordem) ? $modalidade->ordem : "")?>"/>
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

