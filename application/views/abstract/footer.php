<?php 

$empresa = $config["fieldsetEmpresa"];
$links =   $config["fieldsetLinks"];
?>

</div>
<!---End---content----->
<div class="clear"></div>
<div class="top-link">
    <a href="#top" class="scroll">Topo</a>
</div>
<!---End-wrap---->
<div class="boxs">
    <?php if(!isset($isNoticias)){ ?>
    <div class="wrap">
            
        <?php
         $count = count($noticias);
         foreach($noticias as $i => $noticia) { ?>
            
            <?php
            if($i == 0){?>
            <div class="box">
                <h3>Últimas Notícias</h3>
                <span><?php echo $noticia->data_br ?></span>
                <p>
                    <?php echo strlen($noticia->texto) > 150 ? substr(strip_tags($noticia->texto), 0, 150)."..." : strip_tags($noticia->texto) ?>
                    <a href="<?php echo base_url()."noticia/".$noticia->urlrewrite?>">Continue lendo</a>
                </p>
            </div>
            <?php }
                if($i == 1){
                echo '<div class="box center-box"><ul>';
                }
                if($i > 0 && $i <= 5 ){
            ?>
                <li>
                    <a href="<?php echo base_url()."noticia/".$noticia->urlrewrite?>"><?php echo strlen($noticia->titulo) > 50 ? substr($noticia->titulo, 0, 51)."..." : $noticia->titulo  ?></a>
                </li>
            <?php }
                    if($i == 5 or $i == $count){
                 ?>
                </ul>
            </div>
            <?php  } if($i > 5){ ?>
            <div class="box">
                <h3><?php echo strlen($noticia->titulo) > 28 ? substr($noticia->titulo, 0, 30)."..." : $noticia->titulo  ?></h3>
                <p>
                    <?php echo strlen($noticia->texto) > 150 ? substr(strip_tags($noticia->texto), 0, 150)."..." : strip_tags($noticia->texto) ?>
                    <a href="<?php echo base_url()."noticia/".$noticia->urlrewrite?>">Continue lendo</a>
                </p>
            </div>
            <?php }
                if($i == 6)
                break;
             ?>
        <?php } ?>
        <div class="clear"></div>
        <?php }else if(isset($isNoticias) and !$isNoticias) { ?>
            <div class="veja_mais">
                <h3>Veja também:</h3>
                </div>            
            <div class="wrap">            
                <?php foreach($outros as  $i =>$outro){ ?>
                    <div class="box <?php echo $i == 1 ? ' center-box' : ""?>">
                        <span><?php echo $outro->data_br ?></span>
                        <p><?php echo $outro->resumo?>
                           <?php echo anchor("noticia/".$outro->urlrewrite, "Continue lendo")?>
                        </p>
                    </div>
                <?php } ?>
                <div class="clear"></div>
            </div>
            
        <?php }else{ ?>
            <div class="veja_mais">
                <h3>Veja também: </h3>
            </div>
            <ul class="noticia_links">
                <li>
                    <?php echo anchor("estrutura", "Estrutura")?>
                    
                </li>
                <li class="last">
                    <?php echo anchor("galeria", "Galeria")?>
                    
                </li>
            </ul>
        <?php } ?>
    </div>
    <!---start-box---->
</div>

<div class="clear"></div>
<div class="footer">
    <div class="wrap">
        <div class="footer-left">
            <p>
                <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/img/logo_thumb.png" title="logo" /></a>
            </p>
            <p>
                R. <?php echo $empresa["endereco"]; ?> <?php echo $empresa["numero"]; ?> - 83060-370 <br/>
                <?php echo $empresa["cidade"]; ?>/<?php echo $empresa["estado"]; ?>
            </p>
        </div>
        
        <div class="footer-right">
            <ul>
                <li>
                    <?php echo anchor("empresa", "Sobre");?>
                </li>
                <li>
                    <?php echo anchor("estrutura", "Estrutura");?>
                </li>
                <li>
                    <?php echo anchor("noticia", "Notícias");?>
                </li>
                <li>
                <?php echo anchor("galeria", "Galeria");?>
                </li>                            
                <li>
                    <?php echo anchor("contato", "Contato");?>
                </li>
            </ul>

        </div>
        <div class="clear"></div>

    </div>
    
    <div class="fobar">
        <div class="redes_social_foobar">
            <div id="elementos_sociais">
                <ul class="elementos_item">
                    <li>
                        <a href="https://<?php echo $links["facebook"]?>" target="_blank">
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
        <div id="rede_social">
            <div class="fb-like" data-href="https://<?php echo $links["facebook"]?>" data-layout="button_count" data-action="recommend" data-show-faces="false" data-share="false"></div>
            <!-- Twitter-->
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="twitterapi" data-lang="en">Tweet</a>
            <script>
                ! function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "https://platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");
            </script>
            <!-- Twitter-->
        </div>
        </div>
        <div class="desenvolvido_por footer-left">
            <p>Desenvolvido em <a target="_blank" href="https://www.facebook.com/jordanfduarte"><b>projeto final de curso. Turma TDS121A</b></a></p>
        </div>
        <div class="clear"></div>
    </div>    
    <div class="clear"></div>
</div>
<div class="clear"></div>

<input type="hidden" id="base_site" value="<?php echo base_url() ?>" />
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2/ui/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/responsiveslides.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.lightbox.js"></script>
<script src="<?php echo base_url(); ?>assets/js/slaides/source/jquery.slides.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php if(file_exists("./././assets/js/modules/".$this->uri->segment(1).".js")) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/modules/<?=$this->uri->segment(1) ?>.js"></script>
<?php } ?>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/isLoading/jquery.isloading.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jNotify/jquery/jNotify.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/maskinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/scripts.js"></script>
</body>
</html>