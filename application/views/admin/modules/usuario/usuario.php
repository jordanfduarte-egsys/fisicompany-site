<h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Listagem de usuários</h2>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
        <tr>
            <th>Nome</th> 
            <th>Sobre Nome</th>            
            <th>Permissão</th>    
            <th>Cliente Fisicompany</th>
            <th>E-mail</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody> 
    
        <?php
        foreach($usuarios as $usuario){?>
            <tr class="odd gradeX">
                <td><?php echo $usuario->usuario_nome ?></td>
                <td><?php echo $usuario->sobre_nome ?></td>                
                <td><?php 
                        if(empty($usuario->permissao_nome) and !$usuario->acesso_cliente){
                            echo "<span style='color:red'>Bloqueado</span>";
                        }else if(empty($usuario->permissao_nome))
                            echo "-";
                        else{
                            echo $usuario->permissao_nome;
                        }
                    ?></td>
                <td><?php echo $usuario->acesso_cliente ? "Sim" : "Não"?></td>
                <td><?php echo $usuario->email ?></td>                
                <td>
                    <?php
                    $pripiedades = array("class"=>'deletar_instancia',
                                            "idinstancia"=>$usuario->id_usuario,
                                            "nome_deletado"=>$usuario->usuario_nome,
                                            "modulo" => $this->router->uri->segments[2]);
                     
                     echo anchor('usuario/editar/'.$usuario->id_usuario,"<span class='glyphicon glyphicon-pencil'></span>&nbsp;Editar");
                     echo "&nbsp;&nbsp;";
                     echo anchor('usuario/deletar/'.$usuario->id_usuario, "<span class='glyphicon glyphicon-trash'></span>&nbsp;Deletar",$pripiedades);?>
                             
                </td>     
            </tr>
        <?php }?>        
    </tbody>
    <tfoot>
        <tr>
            <th>Nome</th> 
            <th>Sobre Nome</th>            
            <th>Permissão</th>
            <th>Cliente Fisicompany</th>            
            <th>E-mail</th>
            <th>Ação</th>
        </tr>
    </tfoot>
</table>
