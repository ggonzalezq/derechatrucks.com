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
                        <h5>Borrar imagen</h5>
                    </div>
                    <div class="widget-content">
                        <h4>¿Realmente desea borrar esta imagen?</h4>
                        <p>
                            <img src="/uploads/articles/<?php echo $iArticleId; ?>/thumbnail/<?php echo $arPicture['picture_name']; ?>" alt="<?php echo $arPicture['picture_alt']; ?>" title="<?php echo $arPicture['picture_title']; ?>" />
                        </p>
                        <?php echo form_open( '/admin/pictures/picture-delete/' . $iPictureId . '?article_id=' . $iArticleId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                            <?php echo form_hidden( 'picture_id', $iPictureId ) . "\n"; ?>
                            <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Borrar imagen' ) ) . "\n"; ?>
                            <a href="/admin/pictures?article_id=<?php echo $iArticleId; ?>">Cancelar</a>
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

