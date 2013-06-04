<?php require_once FCPATH . 'application/views/public/templates/header.php'; ?>

<?php if( sizeof( $arSlides ) ): ?>
<section id="main-slider" class="flexslider">
    <div id="slider" class="slides">
        <?php foreach( $arSlides as $k => $v ): ?>
        <?php if( $v['slide_anchor'] === '' ): ?>
        <figure class="slide" id="slide-<?php echo $v['slide_id']; ?>">
        <?php else: ?>
        <a href="<?php echo $v['slide_anchor']; ?>" class="slide" id="slide-<?php echo $v['slide_id']; ?>">
            <figure>        
        <?php endif; ?>
            <img src="/uploads/slides/<?php echo $v['slide_name']; ?>" alt="<?php echo $v['slide_title']; ?>" class="slide-picture" />
            <figcaption>
                <?php if( $v['slide_badge'] !== '0' ): ?>
                <div class="slide-badge">Oferta</div>
                <?php endif; ?>
                <div class="slide-title"><?php echo $v['slide_title']; ?></div>
            </figcaption>
        <?php if( $v['slide_anchor'] === '' ): ?>
        </figure>
        <?php else: ?>
            </figure>
        </a>
        <?php endif; ?>
        <?php endforeach; ?>
    </div><!--#/slider-->
</section><!--#/main-slider-->
<?php endif; ?>
<h1 class="fern-green">Últimos Artículos</h1>
<div id="articles-buffer" class="clearfix concrete">
    <?php $i = 0; ?>
    <?php foreach( $arArticles as $arArticle ): ?>
    <?php $i++; ?>
    <?php require FCPATH . 'application/views/public/templates/article.php'; ?>
    <?php endforeach; ?>
</div><!--#/articles-buffer-->
<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>