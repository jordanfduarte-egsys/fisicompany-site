<?php
    //Caminho completo
    echo $caminho;
    //cria o formulario
    echo form_open_multipart($action);    
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $acao ?></legend>
    
    <label for="nome">Nome</label>
    <input type="text" tabindex="1" name="nome"  class="form-control" value="<?php echo (isset($galeria[0]->nome) ? $galeria[0]->nome  : set_value("nome")) ?>"/>
    <?php echo form_error('nome', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="texto">Texto</label>
    <textarea name="texto">
        <?php echo (isset($galeria[0]->texto) ? $galeria[0]->texto  : set_value("texto")) ?>
    </textarea>
    <?php echo form_error('texto', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="status">Status</label>
    <select name="status">
        <option <?php echo (isset($galeria[0]->status) and $galeria[0]->status == 1) ? "selected"  : "" ?> value="1">Ativo</option>
        <option <?php echo (isset($galeria[0]->status) and $galeria[0]->status == 0) ? "selected"  : "" ?> value="0">Inativo</option>
    </select>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Imagens</legend>
        <div class="info_uploade">
            <p>
                Uploade de imagem no formato jpg, gif e png.<br/>
                <b>    
Importante: </b>Dimensões recomendada 342 x 120 px.
                <b>Dica: </b>Arraste e solte a imagem após o upload para ordenar.
            </p>
        </div>        
        <div id="fileuploaderMultiplo">    
Adicionar imagem</div>
        <div id="imagem_pos_upload">
            <br/><?php echo form_error('imagem_principal', '<div class="alert alert-danger">', '</div>'); ?>
        </div>    
        <div id="imagens">            
            <?php if($galeria['isEditar']){
                    foreach($galeria as $imagem):
                        if(!is_object($imagem)) continue;?>
                    <div class='imagem_mini'>
                        <div class='imagem_mini_remove'>
                            <a class='imagem_mini_remove_a' href='javascript:void(0)' title='Remover imagem'>
                                <img class='imagem_mini_favorito_a_img' src='/assets/img/remover.png'/></a>                                                
                        </div>
                                                                            
                        <img src='/assets/media/<?php echo CONTROLLER ?>/<?php echo $imagem->imagem?>'/>
                        <input type='hidden' name='imagem[]' value='<?php echo $imagem->imagem?>'/>    
                                                                    
                        <div class='imagem_mini_favorito'>
                            <a href='javascript:void(0)' class='imagem_mini_favorito_a' title='Adicionar como favorito'>
                                <img class='imagem_mini_favorito_a_img' src='/assets/img/favorito<?php echo $imagem->imagem == $galeria[0]->imagem_principal ?  '': '_over'?>.png'/></a>
                        </div>
                    </div>
                
            <?php   endforeach; }?>            
        </div>
        <input type="hidden" id="imagem_principal" name="imagem_principal" value="<?php echo (isset($galeria[0]->imagem_principal)) ? $galeria[0]->imagem_principal : ""?>"/>
    </fieldset>
    <br/>
    <input type="hidden" name="id_galeria" value="<?php echo (isset($galeria[0]->id_galeria) ? $galeria[0]->id_galeria : "")?>"/>    
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

