<?php require_once FCPATH . 'application/views/public/templates/header.php'; ?>
<section id="main-slider" class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
        <a href="/categorias/camiones-varios/2">
            <img src="/images/camiones-varios.jpg" alt="" />
        </a>
        <a href="/categorias/gruas/3">
            <img src="/images/gruas.jpg" alt="" />
        </a>
        <a href="/categorias/maquinaria/4">
            <img src="/images/maquinaria.jpg" alt="" />
        </a>
        <a href="/categorias/pipas/5">
            <img src="/images/pipas.jpg" alt="" />
        </a>
        <a href="/categorias/revolvedoras-de-concreto/6">
            <img src="/images/revolvedoras-de-concreto.jpg" alt="" />
        </a>
        <a href="/categorias/tractocamiones/7">
            <img src="/images/tractocamiones.jpg" alt="" />
        </a>
        <a href="/categorias/volteos/8">
            <img src="/images/volteos.jpg" alt="" />
        </a>
        <a href="/categorias/automoviles/9">
            <img src="/images/automoviles.jpg" alt="" />
        </a>
    </div>
</section><!--#/main-slider-->
<h1 class="fern-green">Últimos Artículos</h1>
<div id="articles-buffer" class="clearfix concrete">
    <?php $i = 0; ?>
    <?php foreach( $arArticles as $arArticle ): ?>
    <?php $i++; ?>
    <?php require FCPATH . 'application/views/public/templates/article.php'; ?>
    <?php endforeach; ?>
</div><!--#/articles-buffer-->
<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>