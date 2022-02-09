<h2 class="text-muted"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Listagem de exercicios</h2>
<div id="lista_exercicios">
    <ul class="bxslider">
    <?php foreach($exercicios as $exercicio){
        if(empty($exercicio->imagem)) continue;
        ?>
         <li><center><img src="<?php echo PATH_ADM; ?>/img/exercicio/<?php echo $exercicio->imagem ?>" title="<b><?php echo $exercicio->nome?></b><br/><?php echo $exercicio->descricao?>"/></center></li>
    <?php } ?>
    </ul>
</div>
