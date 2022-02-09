</div>
<blockquote >    
  <footer>Sistema de gerenciamento de conteúdo.</footer>  
  <p>Desenvolvido em <a  target="_blank" href="https://www.facebook.com/jordanfduarte">projeto final de curso. Turma TDS121A</a></p>
</blockquote>

</div>
<!-- FECHA CONTEUDO -->
<!-- Div para visualização de modals, dialogs -->
    <div class="view_dialog"></div>
<!-- Base site -->
    <input type="hidden" id="base_site" value="/" module="<?php echo $this->uri->segment(2)?>" />
<!-- Incluindo arquivos js -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="/assets/js/jquery-ui-1.9.2/ui/jquery-ui.js"></script>    
    <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="/assets/js/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
    <script src="/assets/js/tinymce-advanced/js/tinymce/tinymce.min.js"></script>            
    <?php if(file_exists("./././assets/js/modules/admin/".$this->uri->segment(2).".js")){?>        
        <script type="text/javascript" src="/assets/js/modules/admin/<?=$this->uri->segment(2)?>.js"></script>
    <?php } ?>
    <script type="text/javascript" src="/assets/js/abstract_models.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap/bootstrap-select.js"></script>
    <script type="text/javascript" src="/assets/js/DataTables-1.9.4/extras/TableTools/media/js/TableTools.min.js"></script>
    <script src="/assets/js/uploadFile/jquery.uploadfile.min.js"></script>
    <script src="/assets/js/uploadFile/jquery.uploadfile.js"></script>
    <script type="text/javascript" src="/assets/js/isLoading/jquery.isloading.min.js"></script>
    <script src="/assets/js/jNotify/jquery/jNotify.jquery.js"></script>
    <script type="text/javascript" src="/assets/js/maskMoney.js"></script>
    
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