<h2 class="text-muted"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Circunfência corporal</h2>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="exampleCliente">
    <thead>
        <tr>
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
        foreach($medidas as $i => $medida){?>            
            <tr class="odd gradeX" >
                <td><?php echo $medida->data_br?></td>    
                <td><?php echo $medida->braco?></td>    
                <td><?php echo $medida->antebraco?></td>    
                <td><?php echo $medida->peitoral?></td>    
                <td><?php echo $medida->cintura?></td>
                <td><?php echo $medida->abdomen?></td>    
                <td><?php echo $medida->quadril?></td>    
                <td><?php echo $medida->coxa?></td>    
                <td><?php echo $medida->pantorrilha?></td>    
                <td><?php echo $medida->peso?></td>    
                <td><?php echo empty($medida->altura) ? " - " : $medida->altura ?></td>            
            </tr>
        <?php }?>    
    </tbody>
    <tfoot>
        <tr>
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
    </tfoot>
</table>

