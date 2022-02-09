
<h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de notícias</h2>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Foto</th> 
            <th>Data</th>            
            <th>Acessos</th>
            <th>Ação</th>            
        </tr>
    </thead>
    <tbody> 
        <?php
        foreach($noticias as $i => $noticia){?>            
            <tr class="odd gradeX">
            <td><?php echo $noticia->id_noticia?></td>
            <td><?php echo $noticia->titulo?></td>
            <td><img src="/assets/media/noticia/<?php echo $noticia->imagem_principal?>" class="img-thumbnail"/></td>
            <td><?php echo $noticia->data_br?></td>
            <td><?php echo $noticia->contador?></td>
            <td>
                <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                                "idinstancia"=>$noticia->id_noticia,
                                                "nome_deletado"=>$noticia->titulo,
                                                "modulo" => $this->router->uri->segments[2]);
                         
                    
                                    
                    echo anchor('noticia/editar/'.$noticia->id_noticia,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                    echo "&nbsp;&nbsp;";
                    echo anchor('noticia/deletar/'.$noticia->id_noticia, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
                ?>
            </td>
        </tr>
        <?php }?>        
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Título</th> 
            <th>Foto</th>
            <th>Data</th>            
            <th>Acessos</th>
            <th>Ação</th>    
        </tr>
    </tfoot>
</table>
