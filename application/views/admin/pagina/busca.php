<h2><span class="glyphicon glyphicon-search"></span>&nbsp;Busca avançada</h2>
<?php foreach($busca as $index => $array) {
    if(!isset($array[0])) continue;// se não for um array vazio pula para proximo index            
        foreach($array as $sub_index => $stdClass):
            if(!is_object($stdClass)) continue;//Se não for um objeto continua o for
            ?>
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo ucfirst($array['controller']) ?></div>
              <div class="panel-body">                       
               <table class="table">
                       <tr>
                          <?php
                          foreach($stdClass as $i => $str){
                              
                              ?>    
                                    <td><p><?php echo str_replace(strtolower($palavra), '<span class="label label-info">'.$palavra.'</span>', strtolower($str)); ?></p></td>
                        <?php } ?>
                        <td class="visu_top"><?php $id= "id_".$array['controller']; echo anchor($array['controller'].'/editar/'.$stdClass->$id, "<span  style='float:right' class='btn btn-primary'><span class='glyphicon glyphicon-eye-open'></span>&nbsp;Visualizar</span>")?></td>
                    </tr>
                    
                </table>
              </div>
            </div>
        <?php endforeach; ?>
<?php } ?>
