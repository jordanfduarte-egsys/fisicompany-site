
    <h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de estruturas</h2>

<table cellpadding="0" cellspacing="0" border="0" class="display sortable" id="example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Imagem</th>
            <th>Ordem</th>
            <th>Status</th>
            <th>Ação</th>            
        </tr>
    </thead>
    <tbody> 
        <?php 
        $aux = "";
        foreach($estruturas as $i => $estrutura){?>            
            <tr class="odd gradeX" id="listItem_<?php echo $estrutura->id_estrutura?>">
            <td><?php echo $estrutura->id_estrutura?>
                <img title="Arraste e solte para ordenar" src="/assets/img/arrow.png" alt="move" class="handle" />
            </td>
            <td><?php echo $estrutura->nome?></td>
            <td><img src="/assets/media/estrutura/<?php echo $estrutura->imagem?>" class="img-thumbnail"/></td>
            <td class="ordem"><?php echo $estrutura->ordem?></td>
            <td>
                <div class="<?php echo $estrutura->status == '1'  ? 'glyphicon glyphicon-ok-sign alert-success' : 'glyphicon glyphicon-ban-circle alert-danger' ?>"></div>
                    <?php echo $estrutura->status == '1'  ? "Ativo" : "Inativo"?>
                
            </td>
            <td>
                <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                                "idinstancia"=>$estrutura->id_estrutura,
                                                "nome_deletado"=>$estrutura->nome,
                                                "modulo" => $this->router->uri->segments[2]);
                    echo anchor('estrutura/editar/'.$estrutura->id_estrutura,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                    echo "&nbsp;&nbsp;";     
                    echo anchor('estrutura/deletar/'.$estrutura->id_estrutura, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
                                    
    
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
            <th>Ordem</th>
            <th>Status</th>
            <th>Ação</th>
        </tr>
    </tfoot>
</table>
