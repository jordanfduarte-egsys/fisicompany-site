
    <h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de exercicios</h2>

<table cellpadding="0" cellspacing="0" border="0" class="display sortable" id="example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Imagem</th>            
            <th>Ação</th>            
        </tr>
    </thead>
    <tbody> 
        <?php
        foreach($exercicios as $i => $exercicio){?>            
            <tr class="odd gradeX">
            <td><?php echo $exercicio->id_exercicio?></td>
            <td><?php echo $exercicio->nome?></td>
            <td><img src="/assets/<?php echo  empty($exercicio->imagem) ? "img/sem_foto.gif" : "media/exercicio/".$exercicio->imagem ?>" class="img-thumbnail"/></td>            
            <td>
                <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                                "idinstancia"=>$exercicio->id_exercicio,
                                                "nome_deletado"=>$exercicio->nome,
                                                "modulo" => $this->router->uri->segments[2]);
                    echo anchor('exercicio/editar/'.$exercicio->id_exercicio,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                    echo "&nbsp;&nbsp;";     
                    echo anchor('exercicio/deletar/'.$exercicio->id_exercicio, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
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
            <th>Ação</th>    
        </tr>
    </tfoot>
</table>
