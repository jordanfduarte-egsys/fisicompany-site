<!-- MENU -->
<nav class="navbar navbar-default" role="navigation">
    
    <div class="menu_logo">
        <img src="<?php echo PATH_ADM . "/img/base/" .$config["fieldsetEmpresa"]["logo"]; ?>">
        <h4 class="responsive-info-client">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $saudacao?></a>
        </h4>
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
            <?php echo anchor('cliente/index',"<b>Início</b>","class='navbar-brand'");?>
            
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!-- <li class="active"> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuário<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo anchor('cliente/index/meusDados',"Meus dados");?>
                        </li>                                            
                    </ul>
                </li>
                <li>
                    <?php echo anchor('cliente/index/medida',"Medidas");?>
                </li>
                <li>
                    <?php echo anchor('cliente/index/treino',"Treinos");?>
                </li>
                <li>
                    <?php echo anchor('cliente/index/exercicio',"Exercícios");?>
                </li>
                <li>
                    <?php echo anchor('cliente/index/extrato',"Extrato");?>
                </li>                                
            </ul>            
            <ul class="nav navbar-nav navbar-right">
                <!-- <li>
                <a href="#">Link</a>
                </li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle toggle-msg-saudacao" data-toggle="dropdown" data-responsive="Mais">
                        <p><?php echo $saudacao?><b class="caret"></b></p>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo anchor('http://' . $config["fieldsetLinks"]["site"],"Ir para o site");?>
                        </li>
                        <li>
                            <?php echo anchor('cliente/index/logoff',"Sair");?>
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
            <b>Ok!</b>
            <?php echo $this->session->flashdata('msg')?>
        </div>
    <?php }else if($this->session->flashdata('erro')){?>
        <div class="alert alert-danger">
            <b>Ops!</b>
            <?php echo $this->session->flashdata('erro')?>
        </div>
    <?php }?>
<!--FECHA MENSSAGEM -->