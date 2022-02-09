    
<h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de sobre</h2>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
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
        <?php 
        $aux = "";
        foreach($sobres as $i => $sobre){?>            
            <tr class="odd gradeX">
            <td><?php echo $sobre->id_sobre?></td>
            <td><?php echo $sobre->nome?></td>
            <td><img src="/assets/media/<?php echo CONTROLLER ?>/<?php echo $sobre->imagem?>" class="img-thumbnail"/></td>            
            <td>
                <div class="<?php echo $sobre->status == '1'  ? 'glyphicon glyphicon-ok-sign alert-success' : 'glyphicon glyphicon-ban-circle alert-danger' ?>"></div>
                    <?php echo $sobre->status == '1'  ? "Ativo" : "Inativo"?>
                
            </td>
            <td>
                <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                                "idinstancia"=>$sobre->id_sobre,
                                                "nome_deletado"=>$sobre->nome,
                                                "modulo" => $this->router->uri->segments[2]);
                         
                    echo anchor('sobre/editar/'.$sobre->id_sobre,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                    echo "&nbsp;&nbsp;";                
                    echo anchor('sobre/deletar/'.$sobre->id_sobre, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
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
