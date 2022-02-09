            <!---start-gallery---->
            <div class="gallerys">
                    <h3>Galeria</h3>
                    <?php
                     $aux = 0;                
                     foreach($galerias as $i=> $galeria){?>
                        <?php if($aux == $i){?>
                    <div class="gallery-grids">
                        <?php $aux = $aux + 3;} ?>
                        <div class="gallery-grid">                            
                            <a href="#" idgaleria="<?php echo $galeria->id_galeria?>">
                                <img src="<?php echo base_url()?>assets/media/galeria/thumb/<?php echo $galeria->imagem_principal?>" alt="" width="90%">
                            </a>
                            <h4 idgaleria="<?php echo $galeria->id_galeria?>"><?php echo $galeria->nome ?></h4>
                            <p><?php echo strip_tags($galeria->texto)?></p>
                            <div class="gallery-button">
                                <a href="#" idgaleria="<?php echo $galeria->id_galeria?>">Veja as fotos</a>
                            </div>
                        </div>    
                        <?php if($aux-1 == $i or count($galerias)-1 == $i){ ?>
                            <div class="clear"> </div>
                    </div>                    
                     <div class="clear"> </div>
                        <?php } //end if?>                
                    <?php } //end foreach?>                    
                      
                    <div class="clear"> </div>
                    
                    <div class="projects-bottom-paination paginacao">                         
                        <ul>
                            <?php echo $paginacao; ?>                            
                            
                        </ul>
                    </div>
                    <div class="gallery_show" style="display: none">                        
                    </div>                    
            </div>
            <!---End-gallery---->