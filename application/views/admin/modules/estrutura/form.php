<?php
    //Caminho completo
    echo $caminho;
    //cria o formulario
    echo form_open_multipart($action);
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $acao ?></legend>
    
    <label for="nome">Nome</label>
    <input type="text" tabindex="1" name="nome"  class="form-control" value="<?php echo (isset($estrutura->nome) ? $estrutura->nome  : set_value("nome")) ?>"/>
    <?php echo form_error('nome', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="texto">Texto</label>
    <textarea name="texto">
        <?php echo (isset($estrutura->texto) ? $estrutura->texto  : set_value("exto")) ?>
    </textarea>
    <?php echo form_error('texto', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="status">Status</label>
    <select name="status">
        <option <?php echo (isset($estrutura->status) and $estrutura->status == 1) ? "selected"  : "" ?> value="1">Ativo</option>
        <option <?php echo (isset($estrutura->status) and $estrutura->status == 0) ? "selected"  : "" ?> value="0">Inativo</option>
    </select>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Imagem</legend>
        <div class="info_uploade">
            <p>
                Uploade de imagem no formato jpg, gif e png.<br/>
                <b>    
Importante: </b>Dimensões recomendada 305 x 107 px.
            </p>
        </div>        
        <div id="fileuploader">    
Adicionar imagem</div>
        <div id="imagem_pos_upload">
            <img src="/assets/<?php echo (isset($estrutura->imagem)) ? "media/estrutura/".$estrutura->imagem : "img/sem_foto.gif" ?>"/>
            <br/><?php echo form_error('imagem', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <input type="hidden" id="imagem" name="imagem" value="<?php echo (isset($estrutura->imagem)) ? $estrutura->imagem : ""?>"/>
    </fieldset>
    <br/>
    <input type="hidden" name="id_estrutura" value="<?php echo (isset($estrutura->id_estrutura) ? $estrutura->id_estrutura : "")?>"/>
    <input type="hidden" name="ordem" value="<?php echo (isset($estrutura->ordem) ? $estrutura->ordem : "")?>"/>
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

