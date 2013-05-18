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
            <?php echo form_open( '/admin/forgot-password', array( 'class' => 'form-vertical', 'id' => 'recoverform' ) ) . "\n"; ?>
                <p>Ingrese su email y le enviaremos instrucciones de cómo recuperar su contraseña</p>
                <div class="control-group<?php if( form_error( 'identity' ) ): ?> error<?php endif; ?>">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                            <?php echo form_input( array( 'name' => 'identity', 'placeholder' => 'Email', 'value' => $sEmail, 'id' => 'email' ) ) . "\n"; ?>
                        </div>
                        <?php echo form_error( 'identity' ) . "\n"; ?>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left">
                        <a href="/admin/login">Cancelar</a>
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