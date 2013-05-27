<?php require_once FCPATH . 'application/views/public/templates/header.php'; ?>
<h1 class="fern-green"><?php echo $arCategory['category_name']; ?></h1>
<div id="articles-buffer" class="clearfix concrete">
    <?php if( sizeof( $arArticles ) ): ?>
    <?php $i = 0; ?>
    <?php foreach( $arArticles as $arArticle ): ?>
    <?php $i++; ?>
    <?php require FCPATH . 'application/views/public/templates/article.php'; ?>
    <?php endforeach; ?>
    <?php else: ?>
    <p>Por el momento no hay articulos disponibles en <?php echo strtolower( $arCategory['category_name'] ); ?></p>
    <?php endif; ?>
</div><!--#/articles-buffer-->
<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>