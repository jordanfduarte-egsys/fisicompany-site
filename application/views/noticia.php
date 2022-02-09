<!---start-services---->
<div class="notice">
    <div class="notice-content">
        <h3>Notícias</h3>
        <?php foreach($noticias as $i => $noticia){ ?>
        <ul>
            <li>
                <span></span>
            </li>
            <li>
                <?php if(!empty($noticia->imagem_principal)) {?>
                    <div class="noticia_index">
                        <img src="<?php echo base_url()?>assets/media/noticia/<?php echo $noticia->imagem_principal?>" width="100" />
                    </div>    
                <?php } ?>
                    <div class="noticia_index">
                        <p>
                            <?php echo anchor("noticia/".$noticia->urlrewrite, strtoupper($noticia->titulo)) ?>            
                            <?php echo $noticia->resumo ?><br/>
                            <?php echo $this->util->dataPorExtenso($noticia->data) ?>
                        </p>
                    </div>
            </li>
            <div class="clear"></div>
        </ul>
        <?php }?>
        <!-- <ul>
            <li>
                <span>2.</span>
            </li>
            <li>
                <p>
                    <a href="#">FINANCIAL INSTITUTION</a>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui.
                </p>
            </li>
            <div class="clear"></div>
        </ul>
        <ul>
            <li>
                <span>3.</span>
            </li>
            <li>
                <p>
                    <a href="#">OFFICE BUILDING</a>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui.
                </p>
            </li>
            <div class="clear"></div>
        </ul>
        <ul>
            <li>
                <span>4.</span>
            </li>
            <li>
                <p>
                    <a href="#">RESIDENTIAL COMMUNITIES</a>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui.
                </p>
            </li>
            <div class="clear"></div>
        </ul>
        <ul>
            <li>
                <span>5.</span>
            </li>
            <li>
                <p>
                    <a href="#">RETAIL INDUSTRY</a>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui.
                </p>
            </li>
            <div class="clear"></div>
        </ul>
        <ul>
            <li>
                <span>6.</span>
            </li>
            <li>
                <p>
                    <a href="#">RETAIL INDUSTRY</a>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui.
                </p>
            </li>
            <div class="clear"></div>
        </ul> -->
    </div>
    <div class="services-sidebar">
        <h3>MAis acessadas</h3>
        <ul>
            <?php foreach($mais_acessadas as $acesso){?>
            <li>
                <a href="noticia/<?php echo $acesso->urlrewrite ?>"><?php echo $acesso->titulo?></a>
            </li>
            <?php } ?>
            <!-- <li>
                <a href="#">Conse ctetur adipisicing</a>
            </li>
            <li>
                <a href="#">Elit sed do eiusmod tempor</a>
            </li>
            <li>
                <a href="#">Incididunt ut labore</a>
            </li>
            <li>
                <a href="#">Et dolore magna aliqua</a>
            </li>
            <li>
                <a href="#">Ut enim ad minim veniam</a>
            </li> -->
        </ul>
        <?php if ($arquivos) { ?>
            <h3>ARQUIVOS</h3>
            
            <ul>        
                <?php foreach($arquivos as $arquivo){ ?>
                    <li>
                        <?php echo anchor("noticia/".$arquivo->mes."/".$arquivo->ano, $this->util->mesPorExtenso($arquivo->mes).", ".$arquivo->ano); ?>
                    </li>
                <?php } ?>
            </ul>
        <?php }?>
    </div>

    <div class="clear"></div>

    <div class="projects-bottom-paination">
        <!-- <ul>
            <li class="active">
                <a href="#">1</a>
            </li>
            <li>
                <a href="#">2</a>
            </li>
        </ul> -->
        <div class="projects-bottom-paination paginacao">                         
            <ul>
                <?php echo $paginacao; ?>
            </ul>
        </div>
    </div>
</div>
<!---End-services---->
</div>
</div>
