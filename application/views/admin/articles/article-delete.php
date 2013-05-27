<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Artículos</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/articles">Artículos</a>
    <a href="/admin/articles/article-delete/<?php echo $iArticleId; ?>" class="current">Borrar artículo</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Borrar cliente</h5>
                </div>
                <div class="widget-content">
                    <h4>¿Realmente desea borrar este articulo?</h4>
                    <h5><?php echo $arArticle['article_title']; ?></h5>
                    <?php echo form_open( '/admin/articles/article-delete/' . $iArticleId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <?php echo form_hidden( 'article_id', $iArticleId ) . "\n"; ?>
                        <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Borrar artículo' ) ) . "\n"; ?>
                        <a href="/admin/articles">Cancelar</a>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
