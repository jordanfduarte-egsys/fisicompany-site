<!---start---content----->
<div class="wrap">
    <div class="content">
        <!--start-about--->
        <div class="about">
            <div class="sobre">
                <h3>Sobre</h3>
                <p>
                    Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.
                </p>
            </div>
            <!-- SLID -->
        
            <div id="slaide" class="galery">                
                <?php foreach($sobres as $i=> $sobre){?>
                    <a href="#" <?php echo $i == 0 ? 'class="show"' : "" ?>>
                        <img alt="<?php echo $sobre->nome?>" rel="<?php echo $sobre->nome?>" src="<?php echo base_url()?>assets/media/sobre/thumb/<?php echo $sobre->imagem?>"/>
                    </a>
                <?php } ?>
                <div class="caption"><div class="content"></div></div>
            </div>
            <!-- SLID -->
            <div class="about-grids">
                <div class="about-grid">
                    <h3>Missão</h3>

                    <p>
                        Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.
                    </p>

                </div>
                <div class="about-grid center-grid1">
                    <h3>Visão</h3>
                    <p>
                        Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.
                    </p>

                </div>
                <div class="about-grid">
                    <h3>Valores</h3>
                    <p>
                        Pellenn dimentum sed, commodo vitae, ornare sit amet,lit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui.
                    </p>
                </div>

                <div class="clear"></div>
            </div>
            <div class="sobre">
                <h3>Facebook</h3>
                <div class="fb-like-box" data-href="https://<?php echo $config["fieldsetLinks"]["facebook"]; ?>" data-width="940" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
            </div>

        </div>
    </div>
</div>
