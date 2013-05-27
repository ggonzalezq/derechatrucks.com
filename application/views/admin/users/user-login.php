<?php echo strtolower( doctype('html5') ) . "\n"; ?>
<html lang="es">
    <head>
        <title>Derecha Trucks</title>
        <meta charset="utf-8" />
        <?php echo meta( array( 'name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0' ) ) . "\n"; ?>
        <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => 'css/admin/bootstrap.min.css' ) ) . "\n"; ?>
        <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => 'css/admin/bootstrap-responsive.min.css' ) ) . "\n"; ?>
        <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => 'css/admin/unicorn.login.css' ) ) . "\n"; ?>
        <?php echo link_tag( array( 'rel' => 'stylesheet', 'href' => 'css/admin/global.css' ) ) . "\n"; ?>
    </head>
    <body>
        <div id="logo">
            <img src="/images/admin/derecha-trucks.png" alt="Derecha Trucks" />
        </div><!--#/logo-->
        <div id="loginbox">            
            <?php echo form_open( '/admin/login', array( 'class' => 'form-vertical', 'id' => 'loginform' ) ) . "\n"; ?>
                <p>Iniciar sesión</p>
                <div class="control-group<?php if( form_error( 'identity' ) ):?> error<?php endif; ?>">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <?php echo form_input( array( 'name' => 'identity', 'placeholder' => 'Nombre de usuario', 'value' => $arUser['identity'], 'id' => 'identity' ) ) . "\n"; ?>
                        </div>
                        <?php echo form_error( 'identity' ) . "\n"; ?>
                    </div>
                </div>
                <div class="control-group<?php if( form_error( 'password' ) ):?> error<?php endif; ?>">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <?php echo form_password( array( 'name' => 'password', 'placeholder' => 'Contraseña', 'value' => $arUser['password'], 'id' => 'password' ) ) . "\n"; ?>
                        </div>
                    </div>
                    <?php echo form_error( 'password' ) . "\n"; ?>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <?php echo form_label( 'No cerrar sesión', 'remember' ) . "\n"; ?>
                            <?php echo form_checkbox( 'remember', '1', $arUser['remember'], 'id="remember"' ) . "\n"; ?>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left">
                        <a href="/admin/forgot-password">¿Olvidaste tu contraseña?</a>
                    </span>
                    <span class="pull-right">
                        <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-inverse', 'content' => 'Iniciar sesión' ) ) . "\n"; ?>
                    </span>
                </div>
            <?php echo form_close() . "\n"; ?>
        </div><!--#/loginbox-->
        <script src="/js/admin/jquery.min.js"></script>  
        <script src="/js/admin/unicorn.login.js"></script> 
    </body>
</html>