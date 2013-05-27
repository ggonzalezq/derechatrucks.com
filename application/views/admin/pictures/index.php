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
        <style type="text/css">
            .alert { margin:20px 0; }
        </style>
    </head>
    <body>
        <?php if( $arAlert ): ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="alert <?php echo $arAlert['class']; ?>">
                    <button class="close" data-dismiss="alert">×</button>
                    <?php echo $arAlert['message']; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row-fluid">
            <div class="widget-box">                
                <div class="widget-title">
                    <span class="icon"><i class="icon-picture"></i></span>
                    <div class="buttons">
                        <a href="/admin/pictures/picture-new?article_id=<?php echo $iArticleId; ?>" class="btn btn-primary btn-mini">Agregar imagen</a>
                    </div>
                </div>
                <div class="widget-content<?php if( sizeof( $arPictures ) ): ?> nopadding<?php endif; ?>">
                    <?php if( ! sizeof( $arPictures ) ): ?>
                    <p>Aún no hay registradas imágenes, <a href="/admin/pictures/picture-new?article_id=<?php echo $iArticleId; ?>"> agregar nueva</a></p>
                    <?php else: ?>
                    <table class="table table-bordered data-table" id="pictures-buffer">
                        <thead>
                            <tr>
                                <th>Preview</th>
                                <th id="picture-image">Imagen</th>
                                <th id="picture-alt">Texto alternativo</th>
                                <th id="picture-title">Título</th>
                                <th id="picture-date">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( $arPictures as $arPicture ): ?>
                            <tr id="picture-<?php echo $arPicture['picture_id']; ?>">
                                <td>
                                    <?php echo form_open( '/admin/pictures/picture-preview/' . $arPicture['picture_id'] . '?article_id=' . $iArticleId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                                        <input type="checkbox" name="picture_id" value="<?php echo $arPicture['picture_preview']; ?>" <?php if( $arPicture['picture_preview'] == '1' ): ?>checked="checked" disabled="disabled" <?php endif; ?>class="picture-preview" id="picture-preview-<?php echo $arPicture['picture_id']; ?>" />
                                    <?php echo form_close() . "\n"; ?>
                                </td>
                                <td>
                                    <a href="/admin/pictures/picture-edit/<?php echo $arPicture['picture_id']; ?>?article_id=<?php echo $iArticleId; ?>">
                                        <img src="/uploads/articles/<?php echo $iArticleId; ?>/thumbnail/<?php echo $arPicture['picture_name']; ?>" alt="<?php echo $arPicture['picture_alt']; ?>" title="<?php echo $arPicture['picture_title']; ?>">
                                    </a>
                                    <ul class="clearfix buffer-options">
                                        <li><a href="/admin/pictures/picture-edit/<?php echo $arPicture['picture_id']; ?>?article_id=<?php echo $iArticleId; ?>" class="btn btn-success btn-mini">Editar</a></li>
                                        <li><a href="/admin/pictures/picture-delete/<?php echo $arPicture['picture_id']; ?>?article_id=<?php echo $iArticleId; ?>" class="btn btn-danger btn-mini">Borrar</a></li>
                                    </ul>
                                </td>
                                <td><?php echo $arPicture['picture_alt']; ?></td>
                                <td><?php echo $arPicture['picture_title']; ?></td>
                                <td>
                                    <p><?php echo $arPicture['picture_created']; ?></p>
                                    <p>Creado</p>                                
                                    <p><?php echo $arPicture['picture_changed']; ?></p>
                                    <p>Última modificación</p>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if( ( isset( $arJS ) ) && sizeof( $arJS ) ): ?>
            <?php foreach( $arJS as $k => $v ): ?>
                <?php if( file_exists( FCPATH . 'js/admin/' . $v . '.js'  ) ): ?>
                    <script src="/js/admin/<?php echo $v; ?>.js"></script>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>
