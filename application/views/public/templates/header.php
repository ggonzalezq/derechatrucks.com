<!doctype html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title><?php echo $sTitle; ?></title>
        <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => '/css/normalize.css' ) ) . "\n"; ?>
        <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => '/css/main.css?v=1369651009' ) ) . "\n"; ?>
        <?php //if( defined( 'FRONTPAGE' ) ): ?>
        <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => '/css/vendor/flexslider.css' ) ) . "\n"; ?>
        <?php //endif; ?>
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-39455711-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
    </head>
    <body>
        <div id="wrapper">
            <header id="main-header">
                <div id="branding">
                    <a href="/">Derecha trucks</a>
                </div><!--#/branding-->
                <div id="telephone">
                    (662) 250-18-18
                </div><!--#/telephone-->
            </header><!--#/main-header-->
            <nav id="main-nav">
                <ul class="clearfix">
                    <li class="first"><a href="/">INICIO</a></li>
                    <li class="dropdown">
                        <a href="#">CATEGORÍAS</a>
                        <ul>
                            <?php foreach( $arCategories as $v ): ?>
                            <li><a href="/categorias/<?php echo $v['category_permalink']; ?>/<?php echo $v['category_id']; ?>"><?php echo $v['category_name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="/quienes-somos">QUIENES SOMOS</a></li>
                    <li><a href="/contacto">CONTACTO</a></li>
                    <li class="social">
                        <ul class="clearfix">
                            <li class="first twitter"><a href="https://twitter.com/derechatrucks" target="_blank">Twitter</a></li>
                            <li class="youtube"><a href="https://www.youtube.com/user/derechatrucks" target="_blank">YouTube</a></li>
                            <li class="facebook"><a href="https://www.facebook.com/derechat" target="_blank">Facebook</a></li>
                        </ul>
                    </li>
                </ul>
            </nav><!--#/main-nav-->
            <section id="main-content">
