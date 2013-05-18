<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Usuarios</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/users">Usuarios</a>
    <a href="/admin/users/user-edit/<?php echo $iUserId; ?>" class="current">Editar usuario</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Editar usuario</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php echo form_open( '/admin/users/user-edit/' . $iUserId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <div class="control-group<?php if( form_error( 'username' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Nombre de usuario', 'username', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'username', 'maxlength' => 100, 'readonly' => 'readonly', 'value' => $arUser['username'], 'id' => 'username' ) ) . "\n"; ?>
                                <?php echo form_error( 'username' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'group' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Grupo', 'group', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'group', $arGroups, $arUser['group'], 'id="groups"' ) . "\n"; ?>
                                <?php echo form_error( 'group' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'first_name' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Nombre', 'first_name', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'first_name', 'maxlength' => 50, 'value' => $arUser['first_name'], 'id' => 'first_name' ) ) . "\n"; ?>
                                <?php echo form_error( 'first_name' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'last_name' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Apellidos', 'last_name', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'last_name', 'maxlength' => 50, 'value' => $arUser['last_name'], 'id' => 'last_name' ) ) . "\n"; ?>
                                <?php echo form_error( 'last_name' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'email' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Email', 'email', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'email', 'maxlength' => 100, 'value' => $arUser['email'], 'id' => 'email' ) ) . "\n"; ?>
                                <?php echo form_error( 'email' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'phone' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Teléfono', 'phone', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'phone', 'maxlength' => 20, 'value' => $arUser['phone'], 'id' => 'phone' ) ) . "\n"; ?>
                                <?php echo form_error( 'phone' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'password' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Contraseña', 'password', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_password( array( 'name' => 'password', 'maxlength' => 80, 'autocomplete' => 'off', 'value' => $arUser['password'], 'id' => 'password' ) ) . "\n"; ?>
                                <?php echo form_error( 'password' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'confirm_password' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Confirmar contraseña', 'confirm_password', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_password( array( 'name' => 'confirm_password', 'maxlength' => 80, 'autocomplete' => 'off', 'value' => $arUser['confirm_password'], 'id' => 'confirm_password' ) ) . "\n"; ?>
                                <?php echo form_error( 'confirm_password' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Guardar cliente' ) ) . "\n"; ?>
                            <a href="/admin/users">Cancelar</a>
                        </div>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
