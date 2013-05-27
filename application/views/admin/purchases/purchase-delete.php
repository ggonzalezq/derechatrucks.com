<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Compras<?php if( isset( $arCustomer['customer_name'] ) ): ?> de <?php echo $arCustomer['customer_name']; ?><?php endif; ?></h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/purchases<?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>">Compras</a>
    <a href="/admin/purchases/purchase-delete/<?php echo $arPurchase['purchase_id']; ?><?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>" class="current">Borrar compra</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Borrar compra</h5>
                </div>
                <div class="widget-content">
                    <h4>¿Realmente desea borrar esta compra?</h4>
                    <h5><?php echo $arPurchase['title']; ?></h5>
                    <?php echo form_open( $iCustomerId ? '/admin/purchases/purchase-delete/' . $arPurchase['purchase_id'] . '?customer_id=' . $iCustomerId : '/admin/purchases/purchase-delete/' . $arPurchase['purchase_id'], array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <?php echo form_hidden( 'purchase_id', $arPurchase['purchase_id'] ) . "\n"; ?>
                        <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Borrar compra' ) ) . "\n"; ?>
                        <a href="/admin/purchases<?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>">Cancelar</a>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
