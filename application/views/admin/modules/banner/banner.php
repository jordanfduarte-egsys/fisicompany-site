
    <h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de banners</h2>

<table cellpadding="0" cellspacing="0" border="0" class="display sortable" id="example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th> 
            <th>Imagem</th>
            <th>Ordem</th>
            <th>Status</th>
            <th>Ação</th>            
        </tr>
    </thead>
    <tbody> 
        <?php foreach($banners as $banner){?>
        <tr class="odd gradeX" id="listItem_<?php echo $banner->id_banner?>">
            <td><?php echo $banner->id_banner?>
                <img title="Arraste e solte para ordenar" src="/assets/img/arrow.png" alt="move" class="handle" /> 
            </td>
            <td><?php echo $banner->titulo?> </td>
            <td><img src="/assets/media/banner/<?php echo $banner->imagem?>" height='100' class="img-thumbnail"/></td>
            <td class="ordem"><?php echo $banner->ordem?></td>
            <td>
                <div class="<?php echo $banner->status == '1'  ? 'glyphicon glyphicon-ok-sign alert-success' : 'glyphicon glyphicon-ban-circle alert-danger' ?>"></div>
                    <?php echo $banner->status == '1'  ? "Ativo" : "Inativo"?>
                
            </td>
            <td>
                <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                                "idinstancia"=>$banner->id_banner,
                                                "nome_deletado"=>$banner->titulo,
                                                "modulo" => $this->router->uri->segments[2]);
                    echo anchor('banner/editar/'.$banner->id_banner,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                    echo "&nbsp;&nbsp;";     
                    echo anchor('banner/deletar/'.$banner->id_banner, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
                                    
                    
                ?>
            </td>
        </tr>
        <?php }?>            
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Título</th> 
            <th>Imagem</th>
            <th>Ordem</th>
            <th>Status</th>    
            <th>Ação</th>
        </tr>
    </tfoot>
</table>

