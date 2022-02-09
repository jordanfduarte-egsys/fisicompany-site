<?php
    //Caminho completo
    echo $caminho;
    //cria o formulario
    echo form_open_multipart($action);
    
?>

<fieldset class="scheduler-border">
    <input type="hidden" value="<?php echo $cliente->id_usuario ?>" id="id_cliente">
    <legend class="scheduler-border">
        <?php echo $acao." :: <nome>".$cliente->nome." ".$cliente->sobre_nome."</nome>" ?>
    </legend>

    <label for="treino">Treinos</label>
    <select name="treino" class="selectpicker" tabindex="7">
            <option value="0">Nenhum</option>
        <?php foreach($treinos as $treino){?>
            <option <?php echo (isset($cliente->id_treino) and $cliente->id_treino == $treino->id_treino_cliente) ? "selected" : ""?> value="<?php echo $treino->id_treino_cliente?>" ><?php echo $treino->id_treino_cliente." - ".$treino->nome ?></option>
        <?php } ?>
    </select>    
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Atual</legend>
        <div class="fildImagemTreino">
        <?php if(empty($cliente->id_treino)){ ?>
            <span>Nenhum treino configurado para o cliente <?php echo $cliente->nome." ".$cliente->sobre_nome ?></span>
        <?php }else{ ?>
            <?php foreach($treinos as $treino){
                if($treino->id_treino_cliente == $cliente->id_treino)
                ?>
                <img class='img-thumbnail' src="<?php echo BASE_PATH?>assets/media/treino_cliente/<?php echo $treino->imagem?>"  />                
        <?php }
             } ?>    
        </div>
    </fieldset>        
    
    <?php
        
        echo anchor("cliente","Voltar", "class='btn btn-danger dropdown-toggle'");
        echo form_close();
    ?>
</fieldset>