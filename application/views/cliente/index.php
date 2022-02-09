<h2 class="text-muted"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Programação de treino</h2>
<div class="panel panel-default" style="text-align: center;padding: 10px;">
    <?php if(!$usuario->id_treino or empty($usuario->imagem)){ ?>
            <div class="panel-heading" style="color: #333 !    
Importante;background-color: #f5f5f5 !    
Importante;border:1px solid #ddd !    
Importante;">Nenhum treino cadastrado!</div>
    <?php }else{ ?>
            <img  class="img-thumbnail" src="<?php echo PATH_ADM; ?>/img/treino/<?php echo $usuario->imagem; ?>"/>
    <?php } ?>
</div>
<!-- Ultima medida --> 
<h2 class="text-muted"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Circunfência corporal. <?php echo count($medidas) ? $this->util->getMesName($medidas[0]->data_formatada) : ""?></h2>
<div class="panel panel-default">
     <table class="table">
         <thead>
             <tr class="text-muted">
                <th>Data</th>
                <th>Braço</th> 
                <th>Antebraço</th>
                <th>Peitoral</th>
                <th>Cintura</th>
                <th>Abdomen</th>
                <th>Quadril</th>
                <th>Coxa</th>
                <th>Pantorrilha</th>
                <th>Peso</th>
                <th>Altura</th>
            </tr>
         </thead>
          <tbody>              
              <?php        
              if (!empty($medidas)) { 
                foreach($medidas as $i => $medida) {?>
                    <tr class="odd gradeX" >
                        <td><?php echo $medida->data_formatada?></td>
                        <td><?php echo $medida->braco?></td>
                        <td><?php echo $medida->antebraco?></td>
                        <td><?php echo $medida->peitoral?></td>
                        <td><?php echo $medida->cintura?></td>
                        <td><?php echo $medida->abdomen?></td>
                        <td><?php echo $medida->quadril?></td>
                        <td><?php echo $medida->coxa?></td>
                        <td><?php echo $medida->pantorrilha?></td>
                        <td><?php echo $medida->peso?></td>
                        <td><?php echo $medida->altura?></td>
                    </tr>
                <?php } ?>
             <?php } else { ?>
                 <tr class="odd gradeX">
                      <td colspan="11">Nenhuma informação cadastrada!</td>
                 </tr>
             <?php }?>
          </tbody>
      </table>
</div>

        