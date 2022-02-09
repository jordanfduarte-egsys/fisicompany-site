<?php 

$empresa = $config["fieldsetEmpresa"];
$links =   $config["fieldsetLinks"];
$email =   $config["fieldsetEmail"];
?>

<!---start-contect--->
<div class="contact">
    <div class="section group">

        <div class="col span_2_of_3">
            <div class="contact-form">
                <h3>Contato</h3>                
                <?php echo form_open("contato/enviarEmail"); ?>
                    <div>
                        <span><label>NOME</label></span>
                        <span>
                            <input name="nome" type="text" class="textbox required">
                        </span>
                    </div>
                    <div>
                        <span><label>E-MAIL</label></span>
                        <span>
                            <input name="email" type="text" class="textbox required">
                        </span>
                    </div>
                    <div>
                        <span><label>TELEFÔNE</label></span>
                        <span>
                            <input name="telefone" type="text" class="textbox required">
                        </span>
                    </div>
                    <div>
                        <span><label>MENSAGEM</label></span>
                        <span><textarea name="mensagem" name="mensagem" class="not_required"> </textarea></span>
                    </div>
                    <div>
                        <span>
                            <input type="submit" value="Enviar" id="submitContato">
                        </span>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
        <div class="col span_1_of_3">

            <div class="company_address">
                <h3>Mais informações</h3>
                <p>
                    R. <?php echo $empresa["endereco"]; ?> <?php echo $empresa["numero"]; ?> 
                </p>
                <p>
                   <?php echo $empresa["cidade"]; ?>/<?php echo $empresa["estado"]; ?> -  83060-370
                </p>
                <p>
                    Telefône: <?php echo Common::mask($empresa["telefone"], "(##) ####-####"); ?>
                </p>
                <p>
                    Email: <span><?php echo $email["username"]; ?></span>
                </p>
                <p>
                    Follow on: <span>Facebook</span>, <span>Twitter</span>
                </p>
            </div>
            <div class="sobre">
                <h3>Horário</h3>
                <p> Segunda á Sexta-feira<br/>Das 08h00 as 23h00</p>
                <p> Sábado<br/>Das 12h00 as 15h00</p>
            </div>
            <div class="sobre">
                <h3>Facebook</h3>
                <div class="fb-like-box" data-href="https://<?php echo $links["facebook"]; ?>" data-width="290" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
            </div>
        </div>
    </div>
    <div class="sobre">
        <div class="como_chegar contact-form" data-endereco="R. <?php echo $empresa["endereco"]; ?> <?php echo $empresa["numero"]; ?> - 83060-370">
            <form>
            <h3>Como chegar</h3>
                <input type="text" class="input_como_chegar" id="endereco" placeholder="R. <?php echo $empresa["endereco"]; ?> <?php echo $empresa["numero"]; ?> - 83060-370">
                <a href="javascript:return void(0)" id="submitEndereco"><img class="bt_buscar_mapa" src="<?php base_url()?>assets/img/icon-maps.png"></a>
            </form>
        </div>
        
    </div>
    <div id="como_chegar">
        <div id="mapview">
            <div id="map_canvas" style="float: left; width: 100%; height: 500px;">
            	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3601.435742738716!2d-49.14353688528753!3d-25.490510341527386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dcf1734fce93df%3A0x47169a1c2b6b9273!2sR.+Sebasti%C3%A3o+Leonildo+Fontana%2C+453+-+Guatup%C3%A9%2C+S%C3%A3o+Jos%C3%A9+dos+Pinhais+-+PR%2C+83060-370!5e0!3m2!1spt-BR!2sbr!4v1466725287199" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
                
            </div>
        </div>
        <br>
        
    </div>
</div>