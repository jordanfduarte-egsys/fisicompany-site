
    <h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de modalidades</h2>

<table cellpadding="0" cellspacing="0" border="0" class="display sortable" id="example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Imagem</th>
            <th>Ordem</th>            
            <th>Ação</th>            
        </tr>
    </thead>
    <tbody> 
        <?php 
        $aux = "";
        foreach($modalidades as $i => $modalidade){?>            
            <tr class="odd gradeX" id="listItem_<?php echo $modalidade->id_modalidade?>">
            <td><?php echo $modalidade->id_modalidade?>
                <img title="Arraste e solte para ordenar" src="/assets/img/arrow.png" alt="move" class="handle" />
            </td>
            <td><?php echo $modalidade->nome?></td>
            <td><img src="/assets/media/modalidade/<?php echo $modalidade->imagem?>" class="img-thumbnail"/></td>
            <td class="ordem"><?php echo $modalidade->ordem?></td>            
            <td>
                <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                                "idinstancia"=>$modalidade->id_modalidade,
                                                "nome_deletado"=>$modalidade->nome,
                                                "modulo" => $this->router->uri->segments[2]);
                    echo anchor('modalidade/editar/'.$modalidade->id_modalidade,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                    echo "&nbsp;&nbsp;";     
                    echo anchor('modalidade/deletar/'.$modalidade->id_modalidade, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
                                    
    
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
            <th>Ação</th>    
        </tr>
    </tfoot>
</table>
