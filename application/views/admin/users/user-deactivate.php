<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Categorías</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/users">Usuarios</a>
    <a href="/admin/users/user-deactivate/<?php echo $iUserId; ?>" class="current">Desactivar usuario</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Desactivar usuario</h5>
                </div>
                <div class="widget-content">
                    <h4>¿Realmente desea desactivar este usuario?</h4>
                    <h5><?php echo $arUser['username']; ?></h5>
                    <?php echo form_open( '/admin/users/user-deactivate/' . $iUserId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <?php echo form_hidden( 'id', $iUserId ) . "\n"; ?>
                        <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Desactivar usuario' ) ) . "\n"; ?>
                        <a href="/admin/users">Cancelar</a>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
