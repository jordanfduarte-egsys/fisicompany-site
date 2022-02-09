
    <h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de treinos</h2>

<table cellpadding="0" cellspacing="0" border="0" class="display sortable" id="example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Imagem</th>            
            <th>Status</th>
            <th>Ação</th>            
        </tr>
    </thead>
    <tbody> 
        <?php foreach($treinos as $treino){?>
        <tr class="odd gradeX" id="listItem_<?php echo $treino->id_treino_cliente?>">
            <td><?php echo $treino->id_treino_cliente?>
                <!-- <img title="Arraste e solte para ordenar" src="/assets/img/arrow.png" alt="move" class="handle" />  -->
            </td>
            <td><?php echo $treino->nome?> </td>
            <td><img src="/assets/media/treino_cliente/<?php echo $treino->imagem?>" height='100' class="img-thumbnail"/></td>
            <!-- <td class="ordem"><?php echo $treino->ordem?></td> -->
            <td>
                <div class="<?php echo $treino->status == '1'  ? 'glyphicon glyphicon-ok-sign alert-success' : 'glyphicon glyphicon-ban-circle alert-danger' ?>"></div>
                    <?php echo $treino->status == '1'  ? "Ativo" : "Inativo"?>
                
            </td>
            <td>
                <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                                "idinstancia"=>$treino->id_treino_cliente,
                                                "nome_deletado"=>$treino->nome,
                                                "modulo" => $this->router->uri->segments[2]);
                    echo anchor('treino_cliente/editar/'.$treino->id_treino_cliente,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                    echo "&nbsp;&nbsp;";     
                    echo anchor('treino_cliente/deletar/'.$treino->id_treino_cliente, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
                                    
                    
                ?>
            </td>
        </tr>
        <?php }?>            
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Imagem</th>            
            <th>Status</th>
            <th>Ação</th>    
        </tr>
    </tfoot>
</table>

