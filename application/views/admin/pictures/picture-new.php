<?php echo strtolower( doctype('html5') ) . "\n"; ?>
<html lang="es">
    <head>
        <title>Derecha Trucks</title>
        <meta charset="utf-8" />
        <?php if( ( isset( $arCSS ) ) && sizeof( $arCSS ) ): ?>
            <?php foreach(  $arCSS as $k => $v ): ?>
                <?php if( file_exists( FCPATH . 'css/admin/' . $v . '.css'  ) ): ?>
                    <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => 'css/admin/' . $v . '.css' ) ) . "\n"; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </head>
    <body>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Agregar nueva imagen</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <?php echo form_open_multipart( '/admin/pictures/picture-new?article_id=' . $iArticleId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                            <div class="control-group<?php if( $sUploadError ): ?> error<?php endif; ?>">
                                <?php echo form_label( 'Imagen', 'picture_name', array( 'class' => 'control-label' ) ) . "\n"; ?>
                                <div class="controls">
                                    <?php echo form_upload( array( 'name' => 'picture_name', 'id' => 'picture_name' ) ) . "\n"; ?>
                                    <?php if( $sUploadError ): echo $sUploadError;  endif; ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <?php echo form_label( 'Texto alternativo', 'picture_alt', array( 'class' => 'control-label' ) ) . "\n"; ?>
                                <div class="controls">
                                    <?php echo form_input( array( 'name' => 'picture_alt', 'maxlength' => 255, 'value' => $arPicture['picture_alt'], 'id' => 'picture_alt' ) ) . "\n"; ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <?php echo form_label( 'Título', 'picture_title', array( 'class' => 'control-label' ) ) . "\n"; ?>
                                <div class="controls">
                                    <?php echo form_input( array( 'name' => 'picture_title', 'maxlength' => 255, 'value' => $arPicture['picture_title'], 'id' => 'picture_title' ) ) . "\n"; ?>
                                </div>
                            </div>
                            <div class="form-actions">
                                <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Guardar imagen' ) ) . "\n"; ?>
                                <a href="/admin/pictures?article_id=<?php echo $iArticleId; ?>">Cancelar</a>
                            </div>
                        <?php echo form_close() . "\n"; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if( ( isset( $arJS ) ) && sizeof( $arJS ) ): ?>
            <?php foreach( $arJS as $k => $v ): ?>
                <?php if( file_exists( FCPATH . 'js/admin/' . $v . '.js'  ) ): ?>
                    <script src="/js/admin/<?php echo $v; ?>.js"></script>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>

