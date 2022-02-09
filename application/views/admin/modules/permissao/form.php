<?php
    
    echo $caminho;    
    echo form_open($action);
    
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">
        <?php echo $acao ?>
    </legend>

    <label for="nome">Nome</label>
    <input type="text" tabindex="1" name="nome"  class="form-control" value="<?php echo (isset($permissao[0]->permissao_nome) ? $permissao[0]->permissao_nome  : set_value("nome")) ?>"/>
    <?php echo form_error('nome', '<div class="alert alert-danger">', '</div>'); ?>

    <label for="permissao_modulo">Modulos</label>
    <?php if(isset($permissao['isEditar'])){?>
        <select name="permissao_modulo[]" class="selectpicker" multiple title='Selecione os modulos' tabindex="2">
            <?php foreach($permissao['modulos'] as $item){
                $is_selected = true;
                foreach($permissao as $valor_editado){
                    if($item == $valor_editado->permissao_modulo_nome and $is_selected){?>                        
                        <option selected value="<?php echo $item?>"><?php echo $item?></option>
                    <?php $is_selected=false;}?>                                          
                 <?php } 
                    if($is_selected){                 
                 ?>
                     <option value="<?php echo $item?>"><?php echo $item?></option>
             <?php } } ?>      
          </select>
      <?php }else{?>
          <select name="permissao_modulo[]" class="selectpicker" multiple title='Selecione os modulos'>
            <?php foreach($permissao['modulos'] as $item){?>
                 <option value="<?php echo $item?>"><?php echo $item?></option>
             <?php } ?>      
          </select>      
      
      <?php }?>

    <br/>
    <input type="hidden" name="id_permissao" value="<?php echo (isset($permissao[0]->id_permissao) ? $permissao[0]->id_permissao : "")?>"/>
    <?php

        echo form_submit("ok", "Salvar", "class='btn btn-success'");
        echo anchor("permissao","Cancelar", "class='btn btn-danger dropdown-toggle'");
        echo form_close();
        //echo validation_errors();//all errors
    ?>
</fieldset>

