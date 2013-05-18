<!doctype html>
<!--[if lt IE 7]>      <html lang="es" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="es" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="es" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title><?php echo $sTitle; ?></title>
        <!--[if lt IE 9]><script src="dist/html5shiv.js"></script><![endif]-->
        <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => 'http://fonts.googleapis.com/css?family=Oswald' ) ) . "\n"; ?>
        <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => '/css/main.css' ) ) . "\n"; ?>
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
                    <a href="/">Derecha Trucks</a>
                </div><!--#/branding-->
            </header><!--#/main-header-->
            <nav id="main-nav">
                <ul class="group">
                    <li class="first<?php if( defined( 'FRONTPAGE' ) ): ?> current<?php endif; ?>"><a href="/">Inicio</a></li>
                    <li class="dropdown">
                        <a href="">Categorias</a>
                        <ul>
                            <?php foreach( $arCategories as $v ): ?>
                            <li><a href="/categorias/<?php echo $v['category_permalink']; ?>/<?php echo $v['category_id']; ?>"><?php echo $v['category_name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li<?php if( defined( 'ABOUT' ) ): ?> class="current"<?php endif; ?>><a href="/quienes-somos">Quienes somos</a></li>
                    <li<?php if( defined( 'CONTACT' ) ): ?> class="current"<?php endif; ?>><a href="/contacto">Contacto</a></li>
                    <li class="social facebook"><a href="http://www.facebook.com/derecha.trucks" target="_blank">Facebook</a></li>
                    <li class="social twitter"><a href="https://twitter.com/derechatrucks" target="_blank">Twitter</a></li>
                    <li class="social youtube"><a href="https://www.youtube.com/user/derechatrucks" target="_blank">YouTube</a></li>
                </ul>
            </nav><!--#/main-nav-->