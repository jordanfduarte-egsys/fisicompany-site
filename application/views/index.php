<!--End-image-slider---->
<!---start---content----->
<div class="wrap">
    <div class="content">
        <!---start-grids----->
        <div class="grids">
            <?php foreach($modalidades as $modalidade){ ?>
                <div class="grid">                    
                    <h3><?php echo $modalidade->nome ?></h3>
                    <a ><img  src="<?php echo base_url()?>assets/media/modalidade/thumb/<?php echo $modalidade->imagem ?>"  title="Buliding" /></a>
                    <p>
                        <?php echo $modalidade->texto ?>
                    </p>                
                </div>
            <?php } ?>            
            <div class="clear"></div>
        </div>
        <!---End-grids----->
    </div>
</div>
<!---start-box---->