<?php echo strtolower( doctype('html5') ) . "\n"; ?>
<html lang="es">
    <head>
        <title>Derecha Trucks</title>
        <meta charset="utf-8" />
        <?php echo meta( array( 'name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0' ) ) . "\n"; ?>
        <?php if( ( isset( $arCSS ) ) && sizeof( $arCSS ) ): ?>
            <?php foreach(  $arCSS as $k => $v ): ?>
                <?php if( file_exists( FCPATH . 'css/admin/' . $v . '.css'  ) ): ?>
                    <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => 'css/admin/' . $v . '.css' ) ) . "\n"; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </head>
    <body>
        <div id="header">
            <h1><a href="/admin/">Derecha Trucks</a></h1>
        </div><!--#/header-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">
                <li class="btn btn-inverse">
                    <a href="/admin/logout"><i class="icon icon-share-alt"></i> <span class="text">Cerrar sesión</span></a>
                </li>
            </ul>
        </div><!--#user-nav-->
        <div id="sidebar">
            <ul>
                <?php if( $this->ion_auth->is_admin() ): ?>
                <li class="submenu<?php if( defined( 'ARTICLES' ) ): ?> active open<?php endif;?>">
                    <a href="/admin/categories"><i class="icon icon-list-alt"></i> <span>Artículos</span></a>
                    <ul>
                        <li<?php if( defined( 'ALL_ARTICLES' ) ): ?> class="active"<?php endif;?>><a href="/admin/articles"><i class="icon icon-list"></i> <span>Todos las artículos</span></a></li>
                        <li<?php if( defined( 'NEW_ARTICLE' ) ): ?> class="active"<?php endif;?>><a href="/admin/articles/article-new"><i class="icon icon-plus"></i> <span>Agregar artículo</span></a></li>
                    </ul>                                        
                </li>
                <li class="submenu<?php if( defined( 'CATEGORIES' ) ): ?> active open<?php endif;?>">
                    <a href="/admin/categories"><i class="icon icon-folder-open"></i> <span>Categorias</span></a>
                    <ul>
                        <li<?php if( defined( 'ALL_CATEGORIES' ) ): ?> class="active"<?php endif;?>><a href="/admin/categories"><i class="icon icon-list"></i> <span>Todos las categorías</span></a></li>
                        <li<?php if( defined( 'NEW_CATEGORY' ) ): ?> class="active"<?php endif;?>><a href="/admin/categories/category-new"><i class="icon icon-plus"></i> <span>Agregar categoría</span></a></li>
                    </ul>                                        
                </li>
                <?php endif; ?>
                <li class="submenu<?php if( defined( 'CUSTOMERS' ) ): ?> active open<?php endif;?>">
                    <a href="/admin/customers"><i class="icon icon-briefcase"></i> <span>Clientes</span></a>
                    <ul>
                        <li<?php if( defined( 'ALL_CUSTOMERS' ) ): ?> class="active"<?php endif;?>><a href="/admin/customers"><i class="icon icon-list"></i> <span>Todos los clientes</span></a></li>
                        <li<?php if( defined( 'NEW_CUSTOMER' ) ): ?> class="active"<?php endif;?>><a href="/admin/customers/customer-new"><i class="icon icon-plus"></i> <span>Agregar cliente</span></a></li>
                        <li<?php if( defined( 'STATISTICS' ) ): ?> class="active"<?php endif;?>><a href="/admin/customers/customer-statistics"><i class="icon icon-signal"></i> <span>Estadísticas</span></a></li>
                    </ul>
                </li>
                <li class="submenu<?php if( defined( 'PURCHASES' ) ): ?> active open<?php endif;?>">
                    <a href="/admin/customers"><i class="icon icon-shopping-cart"></i> <span>Compras</span></a>
                    <ul>
                        <li<?php if( defined( 'ALL_PURCHASES' ) ): ?> class="active"<?php endif;?>><a href="/admin/purchases<?php if( ( isset( $iCustomerId ) ) && ( $iCustomerId ) ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>"><i class="icon icon-list"></i> <span>Todas las compras</span></a></li>
                        <li<?php if( defined( 'NEW_PURCHASE' ) ): ?> class="active"<?php endif;?>><a href="/admin/purchases/purchase-new<?php if( ( isset( $iCustomerId ) ) && ( $iCustomerId ) ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>"><i class="icon icon-plus"></i> <span>Agregar compra</span></a></li>
                    </ul>
                </li>
                <?php if( $this->ion_auth->is_admin() ): ?>
                <li class="submenu<?php if( defined( 'USERS' ) ): ?> active open<?php endif;?>">
                    <a href="/admin/users"><i class="icon icon-user"></i> <span>Usuarios</span></a>
                    <ul>
                        <li<?php if( defined( 'ALL_USERS' ) ): ?> class="active"<?php endif;?>><a href="/admin/users"><i class="icon icon-list"></i> <span>Todos los usuarios</span></a></li>
                        <li<?php if( defined( 'NEW_USER' ) ): ?> class="active"<?php endif;?>><a href="/admin/users/user-new"><i class="icon icon-plus"></i> <span>Agregar usuario</span></a></li>
                    </ul>                                        
                </li>
                <?php endif; ?>
            </ul>
        </div><!--#/sidebar-->
        <div id="content">