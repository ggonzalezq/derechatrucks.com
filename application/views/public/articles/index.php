<?php require_once FCPATH . 'application/views/public/templates/header.php'; ?>

<div id="banner">
    <a href="/contacto"><img src="/uploads/derecha-trucks.png" alt="Venta de tractocamiones y remolques" /></a>
</div>
<section id="articles-stream">
    <h1>Ultimos articulos</h1>
    <?php foreach( $arArticles as $arArticle ): ?>
    <article class="group">
        <?php if( isset( $arArticle['picture_id'] ) ): ?>
        <div class="slave-column-one">
            <a href="/articulos/<?php echo $arArticle['article_permalink']; ?>/<?php echo $arArticle['article_id']; ?>">
                <img
                    src="/uploads/articles/<?php echo $arArticle['article_id']; ?>/small/<?php echo $arArticle['picture_name']; ?>" 
                    alt="<?php if( $arArticle['picture_alt'] === '' ): ?><?php echo $arArticle['title']; ?><?php else: ?><?php echo $arArticle['picture_alt']; ?><?php endif; ?>" 
                    title="<?php if( $arArticle['picture_title'] === '' ): ?><?php echo $arArticle['title']; ?><?php else: ?><?php echo $arArticle['picture_title']; ?><?php endif; ?>" 
                />
            </a>
        </div>
        <div class="slave-column-two">
            <h2><?php echo $arArticle['title']; ?></h2>
            <?php if( $arArticle['article_comments'] !== ''): ?>
            <p><?php echo $arArticle['article_comments']; ?></p>
            <?php endif; ?>
            <div>
                <a href="/articulos/<?php echo $arArticle['article_permalink']; ?>/<?php echo $arArticle['article_id']; ?>" class="apple">Ver detalles</a>
            </div>
        </div>
        <?php else: ?>
            <h2><?php echo $arArticle['title']; ?></h2>
            <?php if( $arArticle['article_comments'] !== ''): ?>
            <p><?php echo $arArticle['article_comments']; ?></p>
            <?php endif; ?>
            <div>
                <a href="/articulos/<?php echo $arArticle['article_permalink']; ?>/<?php echo $arArticle['article_id']; ?>" class="apple">Ver detalles</a>
            </div>                
        <?php endif; ?>
    </article>
    <?php endforeach; ?>
</section><!--#/articles-stream-->

<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>