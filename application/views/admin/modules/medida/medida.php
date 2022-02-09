
    <h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de medidas</h2>
    <span>Cliente: <b><?php echo isset($cliente->nome) ? $cliente->nome." ".$cliente->sobre_nome : ""?></b></span>
    <input type="hidden" id="segmentos" value="/<?php echo $this -> uri -> segments[4]?>"/>
<table cellpadding="0" cellspacing="0" border="0" class="display sortable" id="example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>            
            <th>Data</th>
            <th>Ação</th>            
        </tr>
    </thead>
    <tbody> 
        <?php 
        $aux = "";
        foreach($medidas as $i => $medida){?>            
            <tr class="odd gradeX" id="listItem_<?php echo $medida->id_medida?>">
            <!-- <td><?php echo $modalidade->id_modalidade?>
                <img title="Arraste e solte para ordenar" src="/assets/img/arrow.png" alt="move" class="handle" />
            </td> -->
            <td><?php echo $medida->id_medida?></td>
            <td><?php echo $medida->nome." ".$medida->sobre_nome?></td>
            <!-- <td><img src="/assets/media/modalidade/<?php echo $modalidade->imagem?>" class="img-thumbnail"/></td> -->
            <td><?php echo $medida->data_formatada?></td>            
            <td>
                <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                                "idinstancia"=>$medida->id_medida,
                                                "nome_deletado"=>$medida->nome,
                                                "modulo" => $this->router->uri->segments[2],
                                                "return"=>"reload");
                    echo anchor('medida/editar/'.$medida->id_medida."/".$this->uri->segment(4) ,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                    echo "&nbsp;&nbsp;";     
                    echo anchor('medida/deletar/'.$medida->id_medida, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
                                    
    
                ?>
            </td>
        </tr>
        <?php }?>        
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Cliente</th>            
            <th>Data</th>
            <th>Ação</th>    
        </tr>
    </tfoot>
</table>
