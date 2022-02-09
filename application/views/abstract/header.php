<?php 
$empresa = $config["fieldsetEmpresa"];
$links = $config["fieldsetLinks"];
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <meta charset="UTF-8">
        <!--[if IE]><link rel="shortcut icon" href="<?php echo base_url()?>assets/img/favicon.png"><![endif]-->
        <link rel="icon" href="<?php echo base_url()?>assets/img/favicon.png">
        <title>Academia Fisicompany</title>

        <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/responsiveslides.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/lightbox.css" media="screen">
        <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css"  media="all" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/js/jNotify/jquery/jNotify.jquery.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/celular.css">

        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];

                if (d.getElementById(id)) return;

                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=502388903186965";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </head>
    <body>
         <div id="top"></div>
         <div id="dialogLogin" class="window" style="display: none;">
           <!-- <div class="dialogHead">
                   <img src="<?php //echo base_url()?>assets/img/cliente_top.png"/>
           </div>     -->
           <div class="closeModalCliente" title="Fechar">
                   <img src="<?php echo base_url()?>assets/img/close_popup.png"/>
           </div>
           <div class="d-header">
               <div class="box" style="text-align: center"><h3>Cliente Fisicompany</h3></div>
               <div class="forLavbel"><label for="usuario">Usuário</label><br/>
                   <br/><br><label for="usuario" class="labelForUsuario">&nbsp;&nbsp;&nbsp;Senha</label>
               </div>
           <div  class="forLavbel lastForLabel"><input type="text" name="usuario" id="cliente_usuario" /><br/>
                   <br/><input type="password" name="senha" id="cliente_senha"/>
           </div>    
             <label class="errClienteLogin"></label>  
           </div>           
           <div class="d-login">
                  <a href="javascript:void(0)" class="cliente_entrar" ><p>>>Entrar</p></a>
           </div>
           <div class="dialogFooter">
           </div>
        </div>
        
        <!---start-header---->
        <div class="header">
            <div id="area_cliente" style="display: none;">
                <div id="area_interna">
                    <div id="espaco_cliente">
                        <a href="javascript:void(0)" class="<?php echo $this -> session -> userdata('is_cliente_logado') ? "logoff_cliente" : "logar_cliente" ?>" name="modal">
                            <h3>
                                <?php if($this -> session -> userdata('is_cliente_logado')){
                                        echo "Sair";
                                    } else {
                                        echo "Entrar";
                                    }
                                ?> 
                            </h3>
                        </a>
                    </div>
                    <div id="status_cliente">
                        <p>
                            <?php if($this -> session -> userdata('is_cliente_logado')){
                                echo "<a href='".base_url()."cliente"."'>Óla, ".$this -> session -> userdata("cliente_nome")." ".$this -> session -> userdata("cliente_sobre_nome")."</a>";
                            }?>
                        </p>
                    </div>
                </div>
            </div>
        
            <div class="wrap">
            	<div class="info-left pull-left">
                    <!---start-logo---->
                    <div class="logo">
                        <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/img/logo_thumb.png" title="logo" /></a>
                    </div>
                    
                    <!---End-logo---->
                    <div id="elementos_sociais">
                        <ul class="elementos_item">
                            <li>
                                <a href="https://<?php echo $links["facebook"]; ?>" target="_blank">
                                    <img src="<?php echo base_url()?>assets/img/ico_facebook.png"/>
                                </a>
                            </li>
                            <li>
                                <a hre="#">
                                    <img src="<?php echo base_url()?>assets/img/ico_twitter.png"/>
                                </a>
                            </li>
                            <li>
                                <a hre="#">
                                    <img src="<?php echo base_url()?>assets/img/ico_google.png"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="login-adv <?php echo $pager == "login" ? "active" : ""; ?>">
                    	<div class="tel-info pull-left">
                    		<p>
                                <?php echo Common::mask($empresa["telefone"], "(##) ####-####"); ?>
                            </p>
                    	</div>
                    	<div class="cliente-info-view">
                        	<?php if($this -> session -> userdata('is_cliente_logado')){ ?>
                                <a href="/cliente/index/logoff"><i class="fa fa-sign-out" aria-hidden="true"></i></a> 
                                <a href="/cliente">Olá <?php echo $this->session->userdata("cliente_nome")." ".$this->session->userdata("cliente_sobre_nome"); ?></a>
                            <?php } else { ?>
                                <a href="/cliente/index/login"><i class="fa fa-user-secret" aria-hidden="true"></i> Login</a>
                            <?php }?>
                    	</div>
                    </div>
                </div>
                
                <input type="checkbox" id="control-nav">
            	<label for="control-nav" class="control-nav"></label>
            	<label for="control-nav" class="control-nav-close"></label>
                <!---start-top-nav---->
                <nav class="top-nav">
                    <ul>
                        
                        <li <?php echo $pager == "home" ? 'class="active"' : ""?>>
                            <?php echo anchor("", "Home")
                            ?>
                        </li>
                        <li <?php echo $pager == "empresa" ? 'class="active"' : ""?> >
                            <?php echo anchor("empresa", "Sobre")
                            ?>
                        </li>
                        <li <?php echo $pager == "estrutura" ? 'class="active"' : ""?>>
                            <?php echo anchor("estrutura", "Estrutura")
                            ?>
                        </li>
                        <li <?php echo $pager == "noticia" ? 'class="active"' : ""?>>
                            <?php echo anchor("noticia", "Notícias")
                            ?>
                        </li>
                        <li <?php echo $pager == "galeria" ? 'class="active"' : ""?>>
                            <?php echo anchor("galeria", "Galeria")
                            ?>
                        </li>
                        <li <?php echo $pager == "contato" ? 'class="active"' : ""?>>
                            <?php echo anchor("contato", "Contato")
                            ?>
                        </li>
                    </ul>
                </nav>
                <!---End-top-nav---->
            </div>
            <div class="clear"></div>
            <!---End-header---->
        </div>
        <?php if(isset($isHome)) { ?>
            <!--start-image-slider---->
            <div class="image-slider">
                <!-- Slideshow 1 -->            
                <ul class="rslides" id="slider1">
                    <?php foreach($banners as $banner){ ?>
                        <li><a href="<?php echo $banner->link?>"><img src="<?php echo base_url()?>assets/media/banner/<?php echo $banner->imagem?>" alt="Banner"></a></li>
                    <?php } ?>                
                </ul>
                <!-- Slideshow 2 -->
            </div>
        <?php } ?>
        <!-- CONTENT -->
        <div id="content">