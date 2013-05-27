<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Artículos</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/articles">Artículos</a>
    <a href="/admin/articles/article-new" class="current">Agregar nuevo artículo</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Agregar nuevo artículo</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php echo form_open( '/admin/articles/article-new', array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <div class="control-group<?php if( form_error( 'article_year' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Año', 'article_year', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_year', 'maxlength' => 4, 'value' => $arArticle['article_year'], 'id' => 'article_year' ) ) . "\n"; ?>
                                <?php echo form_error( 'article_year' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="control-label">Camarote</div>
                            <div class="controls">
                                <label><?php echo form_radio( array( 'name' => 'article_sleeper', 'value' => 1, 'checked' => $arArticle['article_sleeper'] ? TRUE : FALSE, 'id' => 'article_sleeper_1' ) ); ?>Si</label>
                                <label><?php echo form_radio( array( 'name' => 'article_sleeper', 'value' => 0, 'checked' => ! $arArticle['article_sleeper'] ? TRUE : FALSE, 'id' => 'article_sleeper_0' ) ); ?>No</label>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Capacidad', 'article_capacity', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_capacity', 'maxlength' => 255, 'value' => $arArticle['article_capacity'], 'id' => 'article_capacity' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'category_id' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Categoría', 'category_id', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'category_id', $arCategories, $arArticle['category_id'], 'id="category_id"' ) . "\n"; ?>
                                <?php echo form_error( 'category_id' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'article_color' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Color', 'article_color', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_color', 'maxlength' => 255, 'value' => $arArticle['article_color'], 'id' => 'article_color' ) ) . "\n"; ?>
                                <?php echo form_error( 'article_color' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Comentarios', 'article_comments', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_textarea( array( 'name' => 'article_comments', 'value' => $arArticle['article_comments'], 'id' => 'article_comments' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Diferencial', 'article_differential', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_differential', 'maxlength' => 255, 'value' => $arArticle['article_differential'], 'id' => 'article_differential' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'article_brakes' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Frenos', 'article_brakes', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'article_brakes', $arBrakes, $arArticle['article_brakes'], 'id="article_brakes"' ) . "\n"; ?>
                                <?php echo form_error( 'article_brakes' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'article_brand' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Marca', 'article_brand', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_brand', 'maxlength' => 255, 'value' => $arArticle['article_brand'], 'id' => 'article_brand' ) ) . "\n"; ?>
                                <?php echo form_error( 'article_brand' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'article_model' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Modelo', 'article_model', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_model', 'maxlength' => 255, 'value' => $arArticle['article_model'], 'id' => 'article_model' ) ) . "\n"; ?>
                                <?php echo form_error( 'article_model' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Motor', 'article_engine', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_engine', 'maxlength' => 255, 'value' => $arArticle['article_engine'], 'id' => 'article_engine' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'article_price' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Precio', 'article_price', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_price', 'maxlength' => 255, 'value' => $arArticle['article_price'], 'id' => 'article_price' ) ) . "\n"; ?>
                                <?php echo form_error( 'article_price' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'article_currency' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Tipo de moneda', 'article_currency', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'article_currency', $arCurrencies, $arArticle['article_currency'], 'id="article_currency"' ) . "\n"; ?>
                                <?php echo form_error( 'article_currency' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Rines', 'article_wheels', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_wheels', 'maxlength' => 255, 'value' => $arArticle['article_wheels'], 'id' => 'article_wheels' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Rodado', 'article_tires', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_tires', 'maxlength' => 255, 'value' => $arArticle['article_tires'], 'id' => 'article_tires' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'article_status' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Status', 'article_status', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'article_status', $arStatus, $arArticle['article_status'], 'id="article_status"' ) . "\n"; ?>
                                <?php echo form_error( 'article_status' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Ubicación', 'article_ubication', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_ubication', 'maxlength' => 255, 'value' => $arArticle['article_ubication'], 'id' => 'article_ubication' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'article_suspension' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Suspensión', 'article_suspension', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'article_suspension', $arSuspension, $arArticle['article_suspension'], 'id="article_suspension"' ) . "\n"; ?>
                                <?php echo form_error( 'article_suspension' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Transmisión', 'article_transmission', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'article_transmission', 'maxlength' => 255, 'value' => $arArticle['article_transmission'], 'id' => 'article_transmission' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Guardar artículo' ) ) . "\n"; ?>
                            <a href="/admin/articles">Cancelar</a>
                        </div>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
