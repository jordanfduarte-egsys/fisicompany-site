
<h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de galerias</h2>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Foto</th>            
            <th>Status</th>
            <th>Ação</th>            
        </tr>
    </thead>
    <tbody> 
        <?php
        
        foreach($galerias as $i => $galeria){?>            
            <tr class="odd gradeX" >
            <td><?php echo $galeria->id_galeria?></td>
            <td><?php echo $galeria->nome?></td>
            <td><img src="/assets/media/galeria/<?php echo $galeria->imagem_principal?>" class="img-thumbnail"/></td>
            <td>
                <div class="<?php echo $galeria->status == '1'  ? 'glyphicon glyphicon-ok-sign alert-success' : 'glyphicon glyphicon-ban-circle alert-danger' ?>"></div>
                    <?php echo $galeria->status == '1'  ? "Ativo" : "Inativo"?>
                
            </td>
            <td>
                <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                                "idinstancia"=>$galeria->id_galeria,
                                                "nome_deletado"=>$galeria->nome,
                                                "modulo" => $this->router->uri->segments[2]);
                    echo anchor('galeria/editar/'.$galeria->id_galeria,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                    echo "&nbsp;&nbsp;";     
                    echo anchor('galeria/deletar/'.$galeria->id_galeria, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
                                    
                    
                ?>
            </td>
        </tr>
        <?php }?>    
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Foto</th>            
            <th>Status</th>
            <th>Ação</th>    
        </tr>
    </tfoot>
</table>
