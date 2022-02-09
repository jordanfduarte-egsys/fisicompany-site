<?php 

$empresa = $config["fieldsetEmpresa"];
$links =   $config["fieldsetLinks"];
$email =   $config["fieldsetEmail"];
?>
<div class="wrap">
<div class="notice">
    <div class="notice-content">
        <div class="notice-content-top">
        <h3><?php echo $noticia_interna[0]->titulo ?></h3>
        <p><?php echo $noticia_interna[0]->resumo ?></p>
        <p><?php echo $this->util->dataPorExtenso($noticia_interna[0]->data) ?></p>
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
        <div id="imagem_noticia_interna">
            <?php if(count($noticia_interna) == 1){ ?>
                <?php foreach($noticia_interna as $imagem){?>
                        <img class="noticia-uma-foto" src="<?php echo base_url()?>assets/media/noticia/<?php echo $imagem->imagem ?>" title="kodsok"/>                                    
                <?php } ?>
            <?php }else{ ?>
            <div id="slides">
                <?php foreach($noticia_interna as $imagem){?>
            		<div>
                    	<img style=" max-height: 300px;"src="<?php echo base_url()?>assets/media/noticia/<?php echo $imagem->imagem ?>" title="kodsok"/>
                    </div>
                <?php } ?>
                 <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
                   <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
                </div>
                <hr>
            <?php } ?>
            </div>
        <?php if(count($noticia_interna) > 1){ ?>
        <div class="clear"></div>
        <?php } ?>
        <div id="descricao_noticia">
            <?php echo $noticia_interna[0]->texto ?>
        </div>
        
    </div>
</div>
</div>