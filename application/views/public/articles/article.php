<?php require_once FCPATH . 'application/views/public/templates/header.php'; ?>
<article class="motor-vehicle">
    <div class="clearfix master-row-one">
        <div class="motor-vehicle-details slave-column-one">
            <header class="motor-vehicle-header">
                <h1 class="title"><?php echo $arArticle['title']; ?></h1>
            </header>
            <p class="motor-vehicle-price"><?php echo $arArticle['article_price']; ?></p>
            <?php if( $arArticle['article_status'] === '4' ): ?>
            <p class="motor-vehicle-sold-out"><?php echo strtoupper( $arArticle['article_status_name'] ); ?></p>
            <?php endif; ?>
            <?php if( $arArticle['article_comments'] ): ?>
            <p class="motor-vehicle-comments"><?php echo $arArticle['article_comments']; ?></p>
            <?php endif; ?>
            <table>
                <?php if( $arArticle['article_sku'] !== '' ): ?>
                <tr class="motor-vehicle-sku">
                    <th>Nº de inventario</th>
                    <td><?php echo $arArticle['article_sku']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_status_name'] !== '' ): ?>
                <tr class="motor-vehicle-status">
                    <th>Status</th>
                    <td><?php echo $arArticle['article_status_name']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_brand'] !== '' ): ?>
                <tr class="motor-vehicle-brand">
                    <th>Marca</th>
                    <td><?php echo $arArticle['article_brand']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_model'] !== '' ): ?>
                <tr class="motor-vehicle-model">
                    <th>Modelo</th>
                    <td><?php echo $arArticle['article_model']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_year'] !== '' ): ?>
                <tr class="motor-vehicle-year">
                    <th>Año</th>
                    <td><?php echo $arArticle['article_year']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_engine'] !== '' ): ?>
                <tr class="motor-vehicle-engine">
                    <th>Motor</th>
                    <td><?php echo $arArticle['article_engine']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_transmission'] !== '' ): ?>
                <tr class="motor-vehicle-transmission">
                    <th>Transmisión</th>
                    <td><?php echo $arArticle['article_transmission']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_color'] !== '' ): ?>
                <tr class="motor-vehicle-color">
                    <th>Color</th>
                    <td><?php echo $arArticle['article_color']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_tires'] !== '' ): ?>
                <tr class="motor-vehicle-tires">
                    <th>Rodado</th><td><?php echo $arArticle['article_tires']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_wheels'] !== '' ): ?>
                <tr class="motor-vehicle-wheels">
                    <th>Rines</th><td><?php echo $arArticle['article_wheels']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_differential'] !== '' ): ?>
                <tr class="motor-vehicle-differential">
                    <th>Diferencial</th><td><?php echo $arArticle['article_differential']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_suspension'] !== '' ): ?>
                <tr class="motor-vehicle-suspension">
                    <th>Suspensión</th>
                    <td><?php echo $arArticle['article_suspension']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_sleeper'] !== '' ): ?>
                <tr class="motor-vehicle-sleeper">
                    <th>Camarote</th><td><?php echo $arArticle['article_sleeper']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_capacity'] !== '' ): ?>
                <tr class="motor-vehicle-capacity">
                    <th>Capacidad</th><td><?php echo $arArticle['article_capacity']; ?></td>
                </tr>
                <?php endif; ?>
                <?php if( $arArticle['article_brakes'] !== '' ): ?>
                <tr class="motor-vehicle-brakes">
                    <th>Frenos</th><td><?php echo $arArticle['article_brakes']; ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
        <div class="motor-vehicle-contact slave-column-two">
            <h2>Contáctanos</h2>
            <?php if( $bSent ): ?>
            <div class="success">Gracias tu correo ha sido recibido!</div>
            <?php endif; ?>
            <?php echo form_open( 'articulos/' . $arArticle['article_permalink'] . '/' . $arArticle['article_id'], array( 'id' => 'article-form' ) ) . "\n"; ?>
                <div class="form-item">
                    <?php echo form_label( 'Nombre', 'name' ) . "\n"; ?>
                    <?php echo form_input( array( 'name' => 'name', 'value' => ! $bSent ? set_value( 'name' ) : '', 'class' => 'form-text', 'id' => 'name' ) ) . "\n"; ?>
                    <?php echo form_error( 'name' ) . "\n"; ?>
                </div>
                <div class="form-item">
                    <?php echo form_label( ' Teléfono', 'telephone' ) . "\n"; ?>
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
                    <?php echo form_button( array( 'type' => 'submit', 'class' => 'form-button grenadier', 'content' => 'Enviar mensaje' ) ) . "\n"; ?>
                </div>
            <?php echo form_close() . "\n"; ?>
        </div>
    </div>
    <?php if( sizeof( $arPictures ) ): ?>
    <section class="clearfix master-row-two motor-vehicle-gallery">
        <?php $i = 0; ?>
        <?php if( isset( $arArticle['youtube_id'] ) ): ?>
        <?php $i++; ?>
        <figure class="motor-vehicle-figure motor-vehicle-video first">
            <figcaption>Youtube</figcaption>
            <iframe width="422" height="237" src="http://www.youtube.com/embed/<?php echo $arArticle['youtube_id']; ?>" frameborder="0" allowfullscreen></iframe>
        </figure>
        <?php endif; ?>
        <?php foreach( $arPictures as $arPicture ): ?>
        <?php $i++; ?>
        <figure class="motor-vehicle-figure<?php if( $i % 2 === 1 ): ?> first<?php endif; ?>">
            <img
                src="/uploads/articles/<?php echo $arArticle['article_id']; ?>/medium/<?php echo $arPicture['picture_name']; ?>" 
                alt="<?php if( $arPicture['picture_alt'] === '' ): ?><?php echo $arArticle['title']; ?><?php else: ?><?php echo $arPicture['picture_alt']; ?><?php endif; ?>" 
                title="<?php if( $arPicture['picture_title'] === '' ): ?><?php echo $arArticle['title']; ?><?php else: ?><?php echo $arPicture['picture_title']; ?><?php endif; ?>" 
            />
            <?php if( $arArticle['article_status'] === '4' ): ?>
            <figcaption class="sold-out"><?php echo strtoupper( $arArticle['article_status_name'] ); ?></figcaption>
            <?php endif; ?>
        </figure>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>
</article>
<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>