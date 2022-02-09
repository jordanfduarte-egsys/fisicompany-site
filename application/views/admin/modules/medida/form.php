<?php
    //Caminho completo
    echo $caminho;
    
    //cria o formulario
    echo form_open_multipart($action);
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $acao ?></legend>    
    <span>Cliente: <b><?php echo (isset($medida->nome) ? $medida->nome." ".$medida->sobre_nome  : "") ?></b></span>
    <br/><br/>
    <label for="braco">Braco</label>
    <input type="text" tabindex="1" name="braco"  class="form-control centimetro" value="<?php echo (isset($medida->braco) ? $medida->braco  : set_value("braco")) ?>"/>
    <?php echo form_error('braco', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="antebraco">Antebraço</label>
    <input type="text" tabindex="1" name="antebraco"  class="form-control centimetro" value="<?php echo (isset($medida->antebraco) ? $medida->antebraco  : set_value("antebraco")) ?>"/>
    <?php echo form_error('antebraco', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="peitoral">Peitoral</label>
    <input type="text" tabindex="1" name="peitoral"  class="form-control centimetro" value="<?php echo (isset($medida->peitoral) ? $medida->peitoral  : set_value("peitoral")) ?>"/>
    <?php echo form_error('peitoral', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="cintura">Cintura</label>
    <input type="text" tabindex="1" name="cintura"  class="form-control centimetro" value="<?php echo (isset($medida->cintura) ? $medida->cintura  : set_value("cintura")) ?>"/>
    <?php echo form_error('cintura', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="abdomen">Abdomen</label>
    <input type="text" tabindex="1" name="abdomen"  class="form-control centimetro" value="<?php echo (isset($medida->abdomen) ? $medida->abdomen  : set_value("abdomen")) ?>"/>
    <?php echo form_error('abdomen', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="quadril">Quadril</label>
    <input type="text" tabindex="1" name="quadril"  class="form-control centimetro" value="<?php echo (isset($medida->quadril) ? $medida->quadril  : set_value("quadril")) ?>"/>
    <?php echo form_error('quadril', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="coxa">Coxa</label>
    <input type="text" tabindex="1" name="coxa"  class="form-control centimetro" value="<?php echo (isset($medida->coxa) ? $medida->coxa  : set_value("coxa")) ?>"/>
    <?php echo form_error('coxa', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="pantorrilha">Pantorrilha</label>
    <input type="text" tabindex="1" name="pantorrilha"  class="form-control centimetro" value="<?php echo (isset($medida->pantorrilha) ? $medida->pantorrilha  : set_value("pantorrilha")) ?>"/>
    <?php echo form_error('pantorrilha', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="peso">Peso</label>
    <input type="text" tabindex="1" name="peso"  class="form-control pesagem" value="<?php echo (isset($medida->peso) ? $medida->peso  : set_value("peso")) ?>"/>
    <?php echo form_error('peso', '<div class="alert alert-danger">', '</div>'); ?>
    
    <label for="peso">Altura</label>
    <input type="text" tabindex="1" name="altura"  class="form-control altura" value="<?php echo (isset($medida->altura) ? $medida->altura  : set_value("altura")) ?>"/>
    <?php echo form_error('altura', '<div class="alert alert-danger">', '</div>'); ?>
    
    <br/>
    <input type="hidden" name="id_medida" value="<?php echo (isset($medida->id_medida) ? $medida->id_medida : "")?>"/>
    <input type="hidden" name="id_usuario" value="<?php echo (isset($medida->id_usuario) ? $medida->id_usuario : "")?>"/>    
    <input type="hidden" name="data" value="<?php echo (isset($medida->data) ? $medida->data : "")?>"/>
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

