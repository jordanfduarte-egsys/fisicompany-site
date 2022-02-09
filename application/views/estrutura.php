<!---start-services---->
<div class="services">
    <div class="service-content">
        <h3>Estrutura</h3>
        <ul>
            <?php foreach($estruturas as $estrutura){?>
            <li>
                <div class="img_list">
                    <img src="<?php echo base_url()?>assets/media/estrutura/thumb/<?php echo $estrutura->imagem?>" alt="">
                </div>
                <div class="descricao_list">
                    <p><a><?php echo strtoupper($estrutura->nome) ?></a>
                        <?php echo $estrutura->texto ?>    
                    </p>
                </div>
            </li>
            <div class="clear"></div>
            <?php }?>
            
            
        </ul>
    </div>

    <div class="clear"></div>
</div>
<!---End-services---->
</div>
</div>
