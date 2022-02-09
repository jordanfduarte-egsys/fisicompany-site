<h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de clientes</h2>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
        <tr>
            <th>Nome</th> 
            <th>Sobre Nome</th>            
            <th>Nome do treino</th>
            <th>Ultima medida</th>                
            <th>E-mail</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody> 
    
        <?php
        foreach($clientes as $cliente){?>
            <tr class="odd gradeX">
                <td><?php echo $cliente->usuario_nome ?></td>
                <td><?php echo $cliente->sobre_nome ?></td>
                <td><?php echo (empty($cliente->nome_treino) ? "<span style='color: red;'> Não Configurado </span>" : $cliente->nome_treino) ?></td>
                <td><?php echo empty($cliente->ultima_medida) ? " - " : $cliente->ultima_medida ?></td>
                <td><?php echo $cliente->email ?></td>                
                <td>
                    <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                            "idinstancia"=>$cliente->id_usuario,
                                            "nome_deletado"=>$cliente->usuario_nome,
                                            "modulo" => $this->router->uri->segments[2]);
                     
                     
                     if($this->util->verificaAcesso("treino_cliente",$this -> session -> userdata('permissao_modulo'))):
                        echo anchor('medida/index/'.$cliente->id_usuario,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Medidas");
                        echo anchor('cliente/treino/'.$cliente->id_usuario,"  <span class='glyphicon glyphicon-pencil'></span>Treino/Série");
                     endif;
                     // echo anchor('cliente/editar/'.$cliente->id_usuario,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                     // echo "&nbsp;&nbsp;";
                     // echo anchor('cliente/deletar/'.$cliente->id_usuario, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);?>
                             
                </td>     
            </tr>
        <?php }?>        
    </tbody>
    <tfoot>
        <tr>
            <th>Nome</th> 
            <th>Sobre Nome</th>            
            <th>Nome do treino</th>    
            <th>Ultima medida</th>            
            <th>E-mail</th>
            <th>Ação</th>
        </tr>
    </tfoot>
</table>
