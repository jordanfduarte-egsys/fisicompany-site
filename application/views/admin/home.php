<?php 
$links = $config["fieldsetLinks"];

?>

<div class="jumbotron">
  <h1>Olá <?php echo $usuario_logado?></h1>
  <p><?php echo $data ?></p>
  <p><a class="btn btn-primary btn-lg" role="button" href="http://<?php echo $links["site"]; ?>"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Ir para o site</a>
  <?php echo anchor('perfil', "<span class='btn btn-primary btn-lg '><span class='glyphicon glyphicon-user'></span>&nbsp;Perfil</span>",array("role"=>"button"));?>  
  <a class="btn btn-primary btn-lg" role="button" href="http://<?php echo $cookies["url"]; ?>" target="_blank"><span class='glyphicon glyphicon-home'></span> Administração</a>
  <a class="btn btn-primary btn-lg" role="button" href="https://<?php echo $links["facebook"]; ?>" target="_blank"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Facebook</a></p>
</div>