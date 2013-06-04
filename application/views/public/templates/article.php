<article class="motor-vehicle-teaser<?php if( $i % 4 === 1 ): ?> first<?php endif; ?>">
    <?php if( isset( $arArticle['picture_name'] ) ): ?>
    <figure class="motor-vehicle-figure">
        <a href="/articulos/<?php echo $arArticle['article_permalink']; ?>/<?php echo $arArticle['article_id']; ?>">
            <img
                src="/uploads/articles/<?php echo $arArticle['article_id']; ?>/small/<?php echo $arArticle['picture_name']; ?>" 
                alt="<?php if( $arArticle['picture_alt'] === '' ): ?><?php echo $arArticle['title']; ?><?php else: ?><?php echo $arArticle['picture_alt']; ?><?php endif; ?>" 
                title="<?php if( $arArticle['picture_title'] === '' ): ?><?php echo $arArticle['title']; ?><?php else: ?><?php echo $arArticle['picture_title']; ?><?php endif; ?>" 
            />
        </a>
    </figure>
    <?php endif; ?>
    <header class="motor-vehicle-header">
        <h2>
            <a href="/articulos/<?php echo $arArticle['article_permalink']; ?>/<?php echo $arArticle['article_id']; ?>"><?php echo $arArticle['title']; ?></a>
        </h2>
    </header>
    <p class="motor-vehicle-price"><?php echo $arArticle['article_price']; ?></p>
    <footer class="motor-vehicle-footer">
        <ul class="clearfix">
            <li class="first"><a href="/articulos/<?php echo $arArticle['article_permalink']; ?>/<?php echo $arArticle['article_id']; ?>" class="read-more">VER MÁS</a></li>
            <?php /*<li><a href="" class="view-video-youtube">Youtube</a></li> */ ?>
        </ul>
    </footer>
</article>