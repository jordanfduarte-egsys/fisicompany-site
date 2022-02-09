<h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Treinos</h2>
<div class="panel panel-default">
  <!-- Default panel contents -->
 <ul class="bxslider">
  <?php
   $isDia = TRUE;
   $diaDoTreino = "";
   $isTable = TRUE;
   $diaNoLoop = 1;
   
   foreach($treinos as $i =>$treino){            
           //if(isset($treinos[$i-1]) and $treino->id_treino == $treinos[$i-1]->id_treino)
            //continue;    
        $diaNoLoop = $treino->id_dia;
        
       ?>          
      <?php
     if($isDia)
       foreach($treino->dias as $k =>$dia){
               if($k == 0)
              $diaDoTreino .= $dia->nome;
            else
              $diaDoTreino .= ", ".$dia->nome;
    } if($isDia){?>    
         <li>    
        <div class="panel-heading" style="color: #333 !    
Importante;background-color: #f5f5f5 !    
Importante;border:1px solid #ddd !    
Importante;"><?php echo $diaDoTreino ?><button style="float: right;font-size: 20px;" class="glyphicon glyphicon-print print2"></button></div>
    <?php $isDia = FALSE; $diaDoTreino= "";}
        if($isTable){    
         ?>
      <!-- Table --> 
      <table class="table">
          <tbody>
              <?php $isTable = FALSE;} 
              //if(count($treino->exercicios_selecionados_array)){ 
              ?>
              <tr>
                      <td>
                          <b><?php echo $treino->categoria_nome." ".$treino->series_mascara ?></b><br/>
                          <p>
                          <?php foreach($treino->exercicios as $j=> $exercicio){?>
                                  <?php 
                                  $isExercicioSelecionado = FALSE; ?>                                  
                                  <?php if(in_array($exercicio->id_exercicio, (array) $treino->exercicios_selecionados_array)){?>
                                          <span class="label label-primary">
                                  <?php $isExercicioSelecionado = TRUE; } ?>                                      
                                  <?php echo $exercicio->nome?>
                                  <?php if($isExercicioSelecionado){?>                                                 
                                  </span>,&nbsp;
                                  <?php }else{
                                       echo ($j < count($treino->exercicios)-1) ? "," : "";
                                  } ?>
                                  
                          <?php } ?>
                          </p>
                      </td>
              </tr>              
              <?php  if(isset($treinos[$i+1]) and $diaNoLoop != $treinos[$i+1]->id_dia and $treinos[$i+1]->id_treino != $treino->id_treino){ ?>         
          </tbody>
      </table>
          </li> 
      <?php     
            $isDia = TRUE;
            $isTable = TRUE;
      } ?>
  <?php } ?>
                          </tbody>
                          </table>
                          </li>
                      </ul>
</div>
        