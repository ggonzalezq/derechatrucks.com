<?php require_once FCPATH . 'application/views/public/templates/header.php'; ?>

<section>
    <article>
        <h1><?php echo $arArticle['title']; ?></h1>
        <?php if( $bSent ): ?>
        <div class="success">Gracias tu correo ha sido recibido!</div>
        <?php endif; ?>
        <div class="group">
            <div class="slave-column-one">
                <table id="article-details">
                    <tr><th>Nº de inventario</th><td><?php echo $arArticle['article_sku']; ?></td></tr>
                    <tr><th width="100">Status</th><td><?php echo $arArticle['article_status']; ?></td></tr>
                    <tr><th>Marca</th><td><?php echo $arArticle['article_brand']; ?></td></tr>
                    <tr><th>Modelo</th><td><?php echo $arArticle['article_model']; ?></td></tr>
                    <tr><th>A&ntilde;o</th><td><?php echo $arArticle['article_year']; ?></td></tr>
                    <tr><th>Motor</th><td><?php echo $arArticle['article_engine']; ?></td></tr>
                    <tr><th>Transmisi&oacute;n</th><td><?php echo $arArticle['article_transmission']; ?></td></tr>
                    <tr><th>Color</th><td><?php echo $arArticle['article_color']; ?></td></tr>
                    <tr><th>Rodado</th><td><?php echo $arArticle['article_tires']; ?></td></tr>
                    <tr><th>Rines</th><td><?php echo $arArticle['article_wheels']; ?></td></tr>
                    <tr><th>Diferencial</th><td><?php echo $arArticle['article_differential']; ?></td></tr>
                    <tr><th>Suspensi&oacute;n</th><td><?php echo $arArticle['article_suspension']; ?></td></tr>
                    <tr><th>Camarote</th><td><?php echo $arArticle['article_sleeper']; ?></td></tr>
                    <tr><th>Capacidad</th><td><?php echo $arArticle['article_capacity']; ?></td></tr>
                    <tr><th>Precio</th><td><?php echo $arArticle['article_price']; ?>
                    <tr><th>Ubicaci&oacute;n</th><td><?php echo $arArticle['article_ubication']; ?></td></tr>
                    <tr><th>Frenos</th><td><?php echo $arArticle['article_brakes']; ?></td></tr>
                    <tr><th>Transmisi&oacute;n</th><td><?php echo $arArticle['article_transmission']; ?></td></tr>
                </table>
            </div>
            <div class="slave-column-two">
                <h2>Contactanos</h2>
                <?php echo form_open( 'articulos/' . $arArticle['article_permalink'] . '/' . $arArticle['article_id'], array( 'id' => 'article-form' ) ) . "\n"; ?>        
                    <div class="form-item">
                        <?php echo form_label( 'Nombre', 'name' ) . "\n"; ?>
                        <?php echo form_input( array( 'name' => 'name', 'value' => ! $bSent ? set_value( 'name' ) : '', 'class' => 'form-text', 'id' => 'name' ) ) . "\n"; ?>
                        <?php echo form_error( 'name' ) . "\n"; ?>
                    </div>
                    <div class="form-item">
                        <?php echo form_label( 'Tel&eacute;fono', 'telephone' ) . "\n"; ?>
                        <?php echo form_input( array( 'name' => 'telephone', 'value' => ! $bSent ? set_value( 'telephone' ) : '', 'class' => 'form-text', 'id' => 'telephone' ) ) . "\n"; ?>
                        <?php echo form_error( 'telephone' ) . "\n"; ?>
                    </div>
                    <div class="form-item">
                        <?php echo form_label( 'Email', 'email' ) . "\n"; ?>
                        <?php echo form_input( array( 'name' => 'email', 'value' => ! $bSent ? set_value( 'email' ) : '', 'class' => 'form-text', 'id' => 'email' ) ) . "\n"; ?>
                        <?php echo form_error( 'email' ) . "\n"; ?>
                    </div>
                    <div class="form-item">
                        <?php echo form_label( 'Asunto', 'subject' ) . "\n"; ?>
                        <?php echo form_input( array( 'name' => 'subject', 'readonly' => 'readonly', 'value' => $arArticle['title'] . '  ' . $arArticle['article_sku'], 'class' => 'form-text', 'id' => 'subject' ) ) . "\n"; ?>
                    </div>
                    <div class="form-item">
                        <?php echo form_label( 'Comentarios', 'comments' ) . "\n"; ?>
                        <?php echo form_textarea( array( 'name' => 'comments', 'value' => ! $bSent ? set_value( 'comments' ) : '', 'rows' => 5, 'class' => 'form-textarea', 'id' => 'comments' ) ) . "\n"; ?>
                        <?php echo form_error( 'comments' ) . "\n"; ?>
                    </div>
                    <div class="form-item">
                        <?php echo form_button( array( 'type' => 'submit', 'class' => 'form-button', 'content' => 'Enviar mensaje' ) ) . "\n"; ?>
                    </div>
                <?php echo form_close() . "\n"; ?>
            </div>
        </div>
        <?php if( ! empty( $arArticle['comentarios'] ) ): ?>
        <h2>Comentarios</h2>
        <p><?php echo $arArticle['comentarios']; ?></p>
        <?php endif; ?>
        
        <?php if( sizeof( $arPictures ) ): ?>
        <h2>Galeria</h2>
        <?php foreach( $arPictures as $arPicture ): ?>
        <div class="group">
                <img
                    src="/uploads/articles/<?php echo $arArticle['article_id']; ?>/small/<?php echo $arPicture['picture_name']; ?>" 
                    alt="<?php if( $arPicture['picture_alt'] === '' ): ?><?php echo $arArticle['title']; ?><?php else: ?><?php echo $arPicture['picture_alt']; ?><?php endif; ?>" 
                    title="<?php if( $arPicture['picture_title'] === '' ): ?><?php echo $arArticle['title']; ?><?php else: ?><?php echo $arPicture['picture_title']; ?><?php endif; ?>" 
                />
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </article>
</section>

<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>