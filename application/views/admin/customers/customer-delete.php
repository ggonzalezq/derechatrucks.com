<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Clientes</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/customers">Clientes</a>
    <a href="/admin/customers/customer-delete/<?php echo $iCustomerId; ?>" class="current">Borrar cliente</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Borrar cliente</h5>
                </div>
                <div class="widget-content">
                    <h4>¿Realmente desea borrar este cliente?</h4>
                    <h5><?php echo $arCustomer['customer_name']; ?></h5>
                    <?php echo form_open( '/admin/customers/customer-delete/' . $iCustomerId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <?php echo form_hidden( 'customer_id', $iCustomerId ) . "\n"; ?>
                        <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Borrar cliente' ) ) . "\n"; ?>
                        <a href="/admin/customers">Cancelar</a>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
