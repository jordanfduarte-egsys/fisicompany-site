<link type="text/css" rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/forms.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/list.css"/>

<div id="login">
	<p>Área de acesso á informações de clientes da academia. Se você não tem acesso ainda, solicite no link
		<a href="/contato/#content">contato</a>, e acompanhe seu andamento.
	</p>
    <div class="box">
        <h3>Login</h3>
    </div>
    <div class="clear"></div>
    <?php if($this->session->flashdata('erro')): ?>
        <div class="alert alert-danger">
            <?php echo utf8_decode($this->session->flashdata('erro'))?>
        </div>
    <?php endif?>
    <?php
    $rules = array("class"=>"form-horizontal",
                   "role"=>"form");
    echo form_open("cliente/index/logon",$rules);
    ?>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon">@</span>
                  <input type="email" name="login" value="<?php echo $this->session->flashdata('login')?>" class="form-control" id="inputEmail3" placeholder="E-mail">
              </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
        <div class="col-sm-10">
          <input type="password" name="senha" class="form-control" id="inputPassword3" placeholder="Senha">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <!-- <div class="checkbox">
            <label>
              <input type="checkbox" name="lembrar" value="true"> Lembre-me
            </label>
          </div> -->
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10"> 
            <input type="hidden" name="isCliente" value="1"/>         
    <?php
        $rules = array();
        echo form_submit("ok", "Entrar", "class='btn btn-primary'");    
        echo form_close();
    ?>
    </div>
  </div>
</div>