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
            <div>
                <a href="#/articulos/imprimir/<?php /*echo $sPermalink;*/ ?>/<?php /*echo $iArticleId;*/ ?>" class="print">Imprimir</a>
            </div>
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
<script id="print-article" type="text/x-handlebars-template">
    <div id="wrapper-2">
        <header id="main-header-2">
            <div id="branding-2">
                <img src="/images/derecha-trucks.png" alt="Derecha trucks" />
            </div><!--#/branding-2-->
            <div id="social-2">
                <ul>
                    <li class="clearfix">
                        <div class="pull-left">
                            <img src="/images/print/facebook.png" alt="" />
                        </div>
                        <div class="pull-right">derechatrucks</div>
                    </li>
                    <li class="clearfix">
                        <div class="pull-left">
                            <img src="/images/print/twitter.png" alt="" />
                        </div>
                        <div class="pull-right">derechatrucks</div>
                    </li>
                    <li class="clearfix">
                        <div class="pull-left">
                            <img src="/images/print/youtube.png" alt="" />
                        </div>
                        <div class="pull-right">derechatrucks</div>
                    </li>
                </ul>
            </div><!--#/social-2-->
            <div id="contact-2">
                <p>¡Ll&aacute;manos!</p>
                <div id="telephone-2" class="clearfix">
                    <p><img src="/images/print/telephone.png" alt="" /> (662) 250 1818</p>
                </div><!--#/telephone-2-->
            </div><!--#/contact-2-->
        </header><!--#/main-header-2-->
        <section id="main-section-2">
            <article id="main-article-2" class="clearfix">
                <div class="pull-left">
                    <h1><?php echo $arArticle['title']; ?></h1>
                    <p class="motor-vehicle-price"><?php echo $arArticle['article_price']; ?></p>
                    <?php if( $arArticle['article_status'] === '4' ): ?>
                    <p class="motor-vehicle-sold-out"><?php echo strtoupper( $arArticle['article_status_name'] ); ?></p>
                    <?php endif; ?>
                    <?php if( $arArticle['article_comments'] ): ?>
                    <p class="motor-vehicle-comments"><?php echo $arArticle['article_comments']; ?></p>
                    <?php endif; ?>
                    <ul>
                        <?php if( $arArticle['article_sku'] !== '' ): ?>
                        <li><b>Nº de inventario:</b> <?php echo $arArticle['article_sku']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_status_name'] !== '' ): ?>
                        <li><b>Status:</b> <?php echo $arArticle['article_status_name']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_brand'] !== '' ): ?>
                        <li><b>Marca:</b> <?php echo $arArticle['article_brand']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_model'] !== '' ): ?>
                        <li><b>Modelo:</b> <?php echo $arArticle['article_model']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_year'] !== '' ): ?>
                        <li><b>Año:</b> <?php echo $arArticle['article_year']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_engine'] !== '' ): ?>
                        <li><b>Motor:</b> <?php echo $arArticle['article_engine']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_transmission'] !== '' ): ?>
                        <li><b>Transmisión:</b> <?php echo $arArticle['article_transmission']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_color'] !== '' ): ?>
                        <li><b>Color:</b> <?php echo $arArticle['article_color']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_tires'] !== '' ): ?>
                        <li><b>Rodado:</b> <?php echo $arArticle['article_tires']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_wheels'] !== '' ): ?>
                        <li><b>Rines:</b> <?php echo $arArticle['article_wheels']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_differential'] !== '' ): ?>
                        <li><b>Diferencial:</b> <?php echo $arArticle['article_differential']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_suspension'] !== '' ): ?>
                        <li><b>Suspensión:</b> <?php echo $arArticle['article_suspension']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_sleeper'] !== '' ): ?>
                        <li><b>Camarote:</b> <?php echo $arArticle['article_sleeper']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_capacity'] !== '' ): ?>
                        <li><b>Capacidad:</b> <?php echo $arArticle['article_capacity']; ?></li>
                        <?php endif; ?>
                        <?php if( $arArticle['article_brakes'] !== '' ): ?>
                        <li><b>Frenos:</b> <?php echo $arArticle['article_brakes']; ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php if( sizeof( $arPictures ) ): ?>
                <section id="pictures-2" class="pull-right">
                    <?php if( isset( $arPictures[0] ) ): ?>
                    <div class="primary-picture">
                        <img src="/uploads/articles/<?php echo $arArticle['article_id']; ?>/medium/<?php echo $arPictures[0]['picture_name']; ?>" alt=""  />
                    </div>
                    <?php endif; ?>
                    <?php if(   ( isset( $arPictures[1] ) ) ||
                                ( isset( $arPictures[2] ) ) ): ?>
                    <div class="clearfix secondary-pictures">
                        <?php if( isset( $arPictures[1] ) ): ?>
                        <div class="pull-left">
                            <img src="/uploads/articles/<?php echo $arArticle['article_id']; ?>/medium/<?php echo $arPictures[1]['picture_name']; ?>" alt=""  />
                        </div>
                        <?php endif; ?>
                        <?php if( isset( $arPictures[2] ) ): ?>
                        <div class="pull-right">
                            <img src="/uploads/articles/<?php echo $arArticle['article_id']; ?>/medium/<?php echo $arPictures[2]['picture_name']; ?>" alt=""  />
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </section><!--#/pictures-2-->
                <?php endif; ?>
            </article><!--#/main-article-2-->
        </section><!--#/main-section-2-->
        <footer id="main-footer-2">
            <p><b>Dirección</b>  Periferico Sur No. 22 Esquina Paseo las Lomas</p>
            <p>Colonia Las Lomas . C.P. 83293 . Hermosillo, Sonora México</p>
            <p><b>Email:</b> ventas@derechatrucks.com</p>
            <p class="copyright">www.derechatrucks.com</p>
        </footer><!--#/main-footer-2-->
    </div><!--#/wrapper-2-->
</script>
<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>