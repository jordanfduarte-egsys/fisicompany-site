<!-- MENU -->
<?php 
$links = $config["fieldsetLinks"];
$empresa = $config["fieldsetEmpresa"]; 
?>
<nav class="navbar navbar-default" role="navigation">
    
    <div class="menu_logo">
        <img src="http://<?php echo $cookies["url"] . "/img/base/" .$empresa["logo"]; ?>">
    </div>    
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo anchor('home/',"<b>Início</b>","class='navbar-brand'");?>
            
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!-- <li class="active"> -->
                </li>
                <li>                    
                    <?php echo anchor('manutencao',"Manutenção");?>
                </li>
                                
                <!-- li>                            
                    <?php // echo anchor('cliente/',"Clientes");?>
                </li-->
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Site <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        
                        <li>
                            <?php echo anchor('banner/',"Banner");?>
                            
                        </li>
                        
                        <li>
                            <?php echo anchor('sobre/',"Sobre");?>                            
                        </li>
                        
                        <li>                            
                            <?php echo anchor('estrutura/',"Estrutura");?>
                        </li>
                        
                        <li>                            
                            <?php echo anchor('modalidade/',"Modalidade");?>
                        </li>
                                                
                        <li>                            
                            <?php echo anchor('noticia/',"Notícias");?>
                        </li>
                                                
                        <li>                            
                            <?php echo anchor('galeria/',"Galeria");?>
                        </li>
                        
                            <!-- li class="divider"></li-->
                        <!-- li>                            
                            <?php // echo anchor('exercicio/',"Exercicio");?>
                        </li-->
                        
                        
                        <!-- li>                            
                            <?php // echo anchor('treino_cliente/',"Treinos");?>
                        </li-->
                        
                    </ul>
                </li>
            </ul>
            <?php echo form_open("home/busca", array("class"=>"navbar-form navbar-left","role"=>"search")); ?>
            <!-- <form class="navbar-form navbar-left" role="search" method="post" action="home/busca"> -->
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Busca" name="busca" value="<?php echo $this->input->post("busca")?>">
                </div>
            <?php 
                echo form_submit("ok", "Buscar", "class='btn btn-default'");
                echo form_close();
            ?>                
        
            <ul class="nav navbar-nav navbar-right">
                <!-- <li>
                <a href="#">Link</a>
                </li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $saudacao?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo anchor('perfil',"Perfil");?>
                        </li>
                        <li>
                            <a href="http://<?php echo $links["site"]; ?>">Ver site</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="http://<?php echo $cookies["url"]?>">Administração</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!-- CONTEUDO -->
<div id="todo_content">
<!-- MENSSAGEM -->
    <?php if($this->session->flashdata('msg')){ ?>
        <div class="alert alert-success">
            <b>Ok! </b>
            <?php echo $this->session->flashdata('msg')?>
        </div>
    <?php }else if($this->session->flashdata('erro')){?>
        <div class="alert alert-danger">
            <b>Ops!</b>
            <?php echo $this->session->flashdata('erro')?>
        </div>
    <?php }?>
<!--FECHA MENSSAGEM -->