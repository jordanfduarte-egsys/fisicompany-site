<fieldset class="scheduler-border">
    <legend class="scheduler-border"><img src="/assets/img/clear.png"/>&nbsp;Limpar modulos</legend>    
    <?php foreach($controllers as $controller){?>
        <ul class="list-group">
              <li class="list-group-item"><?php echo ucfirst($controller)?>
                   <a  title="Limpar" modulo="<?php echo $controller?>" href="javascript:void(0)" style="float: right;margin-top: -8px;" class="btn btn-primary limpeza" role="button">
                       Limpar
                   </a>
              </li> 
        </ul>    
    <?php }?>
    <h3>Log</h3>
    <div class="well well-lg" style="overflow: auto;height: 200px;"></div>
</fieldset>