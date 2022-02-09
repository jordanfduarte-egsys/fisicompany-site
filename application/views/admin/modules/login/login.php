
<div id="login">
    <img src="/assets/img/logo.png">    
    <?php if($this->session->flashdata('msg')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('msg')?>
    </div>
<?php endif?>
<?php
$rules = array("class"=>"form-horizontal",
               "role"=>"form");
echo form_open("login/logon",$rules);
?>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <div class="input-group">
            <span class="input-group-addon">@</span>
              <input type="email" name="login" class="form-control" id="inputEmail3" placeholder="E-mail">
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
      <div class="checkbox">
        <label>
          <input type="checkbox" name="lembrar" value="true"> Lembre-me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
<?php
    $rules = array();
    echo form_submit("ok", "Entrar", "class='btn btn-default'");    
    echo form_close();
?>
</div>
  </div>
</div>