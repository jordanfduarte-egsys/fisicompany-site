<?php
    //Caminho completo
    echo $caminho;
    //cria o formulario
    echo form_open_multipart($action);
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $acao ?></legend>
    
    <label for="id_categoria">Categoria</label>
    <select name="id_categoria" class="selectpicker" tabindex="0">
        <?php foreach($categorias as $categoria){?>
            <option <?php echo (isset($exercicio->id_categoria) and $exercicio->id_categoria == $categoria->id_categoria) ? "selected" : ""?> value="<?php echo $categoria->id_categoria?>" ><?php echo $categoria->nome ?></option>
        <?php } ?>
    </select>
    
    <label for="nome">Nome</label>
    <input type="text" tabindex="1" name="nome"  class="form-control" value="<?php echo (isset($exercicio->nome) ? $exercicio->nome  : set_value("nome")) ?>"/>
    <?php echo form_error('nome', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="descricao">Descrição</label>
    <textarea name="descricao">
        <?php echo (isset($exercicio->descricao) ? $exercicio->descricao  : set_value("descricao")) ?>
    </textarea>
    <?php echo form_error('descricao', '<div class="alert alert-danger">', '</div>'); ?>
    
    
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
            <img src="/assets/<?php echo (isset($exercicio->imagem)) ? "media/exercicio/".$exercicio->imagem : "img/sem_foto.gif" ?>"/>
            <br/><?php echo form_error('imagem', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <input type="hidden" id="imagem" name="imagem" value="<?php echo (isset($exercicio->imagem)) ? $exercicio->imagem : ""?>"/>
    </fieldset>
    <br/>
    <input type="hidden" name="id_exercicio" value="<?php echo (isset($exercicio->id_exercicio) ? $exercicio->id_exercicio : "")?>"/>    
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

