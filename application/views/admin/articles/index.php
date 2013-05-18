<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Artículos</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/articles" class="current">Artículos</a>
</div>
<div class="container-fluid">
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
    <?php if( ( ! isset( $_GET['s'] ) ) &&
              ( ! sizeof( $arArticles ) ) ): ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content">
                <p>Aún no hay registrados artículos</p>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php if( $sLike ): ?>
    <div id="sub-header" class="row-fluid">
        <h2>Resultados de <?php echo $sLike; ?></h2>
    </div><!--#/sub-header-->
    <?php endif; ?>
    <div class="row-fluid">
        <?php echo form_open( '/admin/articles', array( 'method' => 'get' ) ) . "\n"; ?>
        <div class="clearfix filters pull-left span5">
            <div class="clearfix">
                <div class="form-item pull-left">
                    <?php echo form_dropdown( 'category_id', $arCategories, $iCategoryId, 'id="category_id"' ) . "\n"; ?>
                </div>
                <div class="form-item pull-left">
                    <?php echo form_dropdown( 'status', $arStatus, $iStatusId, 'id="status"' ) . "\n"; ?>
                </div>
                <div class="form-item pull-left">
                    <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn pull-right', 'content' => 'Filtrar' ) ) . "\n"; ?>
                </div>
            </div>
        </div>
        <div id="search" class="clearfix pull-right span3">
            <div class="pull-right">
                <?php echo form_input( array( 'name' => 's', 'value' => $sLike,  'autocomplete' => 'off', 'placeholder' => 'Buscar artículos', 'class' => 'pull-left' ) ) . "\n"; ?>
                <?php echo form_button( array( 'type' => 'submit', 'class' => 'pull-left', 'content' => '<i class="hide-text icon-search icon-white">Buscar</i>' ) ) . "\n"; ?>
            </div>
        </div>
        <?php echo form_close() . "\n"; ?>
    </div>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table" id="articles-buffer">
                    <thead>
                        <tr>
                            <th id="article-active">Activo</th>
                            <th id="article-sku"> Nº de inventario</th>
                            <th id="article-details">Detalles</th>
                            <th id="article-picture">Imagen</th>
                            <th id="article-category">Categoria</th>
                            <th id="article-price">Precio</th>
                            <th id="article-status">Status</th>
                            <th id="article-date">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $arArticles as $arArticle ): ?>
                        <tr id="article-<?php echo $arArticle['article_id']; ?>">
                            <td>
                                <?php echo form_open( $arArticle['article_active'] ? '/admin/articles/article-deactivate/' . $arArticle['article_id'] : '/admin/articles/article-activate/' . $arArticle['article_id'], array( 'method' => 'post' ) ) . "\n"; ?>
                                    <?php echo form_checkbox( array( 'name' => '', 'value' => '1', 'checked' => $arArticle['article_active'], 'class' => 'article-active', 'id' => 'article-active-' . $arArticle['article_id'] ) ) . "\n"; ?>
                                <?php echo form_close() . "\n"; ?>
                            </td>
                            <td><?php echo $arArticle['article_sku']; ?></td>
                            <td>
                                <a href="/admin/articles/article-edit/<?php echo $arArticle['article_id']; ?>"><?php echo $arArticle['article_title']; ?></a>
                                <ul class="clearfix buffer-options">
                                    <li>
                                        <a href="#pictures-<?php echo $arArticle['article_id']; ?>" data-toggle="modal" class="list-images btn btn-primary btn-mini">Imágenes</a>
                                        <div id="pictures-<?php echo $arArticle['article_id']; ?>" class="modal hide">
                                            <div class="modal-header"><?php echo $arArticle['article_title']; ?> imágenes</div>
                                            <div class="modal-body">
                                                <iframe src="about:blank" data-src="/admin/pictures?article_id=<?php echo $arArticle['article_id']; ?>" class="non-rendered"></iframe>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="/admin/articles/article-edit/<?php echo $arArticle['article_id']; ?>" class="btn btn-success btn-mini">Editar</a></li>
                                    <li><a href="/admin/articles/article-delete/<?php echo $arArticle['article_id']; ?>" class="btn btn-danger btn-mini">Borrar</a></li>
                                </ul>
                            </td>
                            <td>
                                <?php if( isset( $arArticle['picture_id'] ) ): ?>
                                <img src="/uploads/articles/<?php echo $arArticle['article_id']; ?>/thumbnail/<?php echo $arArticle['picture_name']; ?>" alt="<?php echo $arArticle['picture_alt']; ?>" title="<?php echo $arArticle['picture_title']; ?>" />
                                <?php endif; ?>
                            </td>
                            <td><?php echo $arArticle['category_name']; ?></td>
                            <td>$<?php echo $arArticle['article_price']; ?> <?php echo $arArticle['article_currency']; ?></td>
                            <td>
                                <?php echo form_open( '/admin/articles/article-status/' . $arArticle['article_id'], array( 'method' => 'post' ) ) . "\n"; ?>
                                    <?php echo form_dropdown( 'status', $arStatusArticle, $arArticle['article_status'], 'class="article-status" id="article-status-' . $arArticle['article_id'] . '"' ) . "\n"; ?>
                                <?php echo form_close() . "\n"; ?>
                            </td>
                            <td>
                                <p><?php echo $arArticle['article_created']; ?></p>
                                <p>Creado</p>                                
                                <p><?php echo $arArticle['article_changed']; ?></p>
                                <p>Última modificación</p>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row-fluid">      
        <div class="clearfix pull-right span4">
            <div class="alternate pagination pull-right">
                <div class="counter"><?php echo $iArticles; ?> <?php if( $iArticles === 1): ?>Artículo<?php else: ?>Artículos<?php endif; ?></div>
                <?php echo $sPagination; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
