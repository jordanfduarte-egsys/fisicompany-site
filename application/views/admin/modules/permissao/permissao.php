    
<h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de permissão</h2>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Modulos</th>
            <th>Ação</th>            
        </tr>
    </thead>
    <tbody> 
        <?php 
        $aux = "";
        foreach($permissoes as $i => $item){
            if($aux != $item->permissao_nome){
            ?>
        <tr class="odd gradeX">
            <td><?php echo $item->id_permissao?></td>
            <td><?php echo $item->permissao_nome?></td>
            <td><?php
            $j = $i;
            
            while(isset($permissoes[$j]->permissao_nome) and  $permissoes[$j]->permissao_nome == $permissoes[$i]->permissao_nome)
            {
                if($j == $i)                
                    echo $permissoes[$j]->permissao_modulo_nome;
                else
                    echo ", ".$permissoes[$j]->permissao_modulo_nome;
            $j++;}     
            ?></td>
            <td>                
                <?php
                $pripiedades = array("class"=>'deletar_instancia',
                                            "idinstancia"=>$item->id_permissao,
                                            "nome_deletado"=>$item->permissao_nome,
                                            "modulo" => $this->router->uri->segments[2]);
                     
                echo anchor('usuario/deletar/'.$item->id_permissao, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);
                echo "&nbsp;&nbsp;";                
                echo anchor('permissao/editar/'.$item->id_permissao,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");?>        
            </td>
 
        </tr>
        <?php $aux = $item->permissao_nome;}/*end if*/ }/*end foreach */?>        
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Modulos</th>
            <th>Ação</th>
        </tr>
    </tfoot>
</table>
