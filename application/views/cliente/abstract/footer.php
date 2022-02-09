
</div>
<iframe id="iframa"  style="display: none;" src="<?php echo BASE_PATH;?>cliente/index/iframe"></iframe>
<blockquote >    
  <footer>Sistema de gerenciamento de conteúdo.</footer>  
  <p>Desenvolvido em <a  target="_blank" href="https://www.facebook.com/jordanfduarte">projeto final de curso. Turma TDS121A</a></p>
</blockquote>

</div>
<!-- FECHA CONTEUDO -->
<!-- Div para visualização de modals, dialogs -->
    <div class="view_dialog"></div>
<!-- Base site -->
    <input type="hidden" id="base_site" value="<?php echo BASE_PATH ?>" module="perfil" />
<!-- Incluindo arquivos js -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/js/jquery-ui-1.9.2/ui/jquery-ui.js"></script>    
    <script src="<?php echo BASE_PATH;?>assets/js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH;?>assets/js/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/js/tinymce-advanced/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/js/bxSlider/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_PATH;?>assets/js/isLoading/jquery.isloading.min.js"></script>                
    <?php if(file_exists("./././assets/js/modules/cliente/".$this->uri->segment(3).".js")){?>        
        <script type="text/javascript" src="<?php echo BASE_PATH;?>assets/js/modules/cliente/<?=$this->uri->segment(3)?>.js"></script>
    <?php } ?>
    <script type="text/javascript" src="<?php echo BASE_PATH;?>assets/js/abstract_models.js"></script>
    <script type="text/javascript" src="<?php echo BASE_PATH;?>assets/js/bootstrap/bootstrap-select.js"></script>
    <script type="text/javascript" src="<?php echo BASE_PATH;?>assets/js/DataTables-1.9.4/extras/TableTools/media/js/TableTools.min.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/js/uploadFile/jquery.uploadfile.min.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/js/uploadFile/jquery.uploadfile.js"></script>
    <script type="text/javascript" src="<?php echo BASE_PATH;?>assets/js/fancy/source/jquery.fancybox.js"></script>
    
    
    
<!-- FOOTER -->    
<!-- <div id="footer">
    <div id="footer_descripton">
        <span>Sistema de Gerenciamento de Conteudo
            <br/>
            Copyhight 2014
        </span>
    </div>
</div> -->

<!-- FOOTER -->
</body>
</html>