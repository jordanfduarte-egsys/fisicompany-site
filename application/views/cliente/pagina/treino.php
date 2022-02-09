<h2 class="text-muted"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Treino</h2>
<div class="panel panel-default" style="max-width:1024px;text-align: center;padding: 10px;">
     
    <?php if(!$usuario->id_treino or empty($usuario->imagem)){ ?>
            <div class="panel-heading" style="color: #333 !    
Importante;background-color: #f5f5f5 !    
Importante;border:1px solid #ddd !    
Importante;">Nenhum treino cadastrado!</div>
    <?php }else{ ?>
            <a class="fancybox-button" rel="fancybox-button" href="<?php echo PATH_ADM; ?>/img/treino/<?php echo $usuario->imagem; ?>" title="Treino">
                <img title="Treino"  class="img-thumbnail" src="<?php echo PATH_ADM; ?>/img/treino/<?php echo $usuario->imagem; ?>"/>
            </a>
                    
    <?php } ?>
</div>