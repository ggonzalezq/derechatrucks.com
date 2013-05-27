<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Compras<?php if( isset( $arCustomer['customer_name'] ) ): ?> de <?php echo $arCustomer['customer_name']; ?><?php endif; ?></h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/purchases<?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>" class="current">Compras</a>
</div>
<div class="container-fluid">
    <?php if( $arAlert ): ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="alert <?php echo $arAlert['class']; ?>">
                <button class="close" data-dismiss="alert">×</button>
                <?php echo $arAlert['message']; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if( ! sizeof( $arPurchases ) ): ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content">
                <p>Aún no hay registradas compras</p>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table" id="purchases-buffer">
                    <thead>
                        <tr>
                            <th id="purchase-title">Articulo</th>
                            <th id="purchase-status">Status</th>
                            <th id="purchase-comments">Comentarios</th>
                            <th id="purchase-date">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $arPurchases as $arPurchase ): ?>
                        <tr id="purchase-<?php echo $arPurchase['purchase_id']; ?>">
                            <td>
                                <a href="/admin/purchases/purchase-edit/<?php echo $arPurchase['purchase_id']; ?><?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>"><?php echo $arPurchase['title']; ?></a>
                                <ul class="clearfix buffer-options">
                                    <li><a href="/admin/purchases/purchase-edit/<?php echo $arPurchase['purchase_id']; ?><?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>" class="btn btn-success btn-mini">Editar</a></li>
                                    <li><a href="/admin/purchases/purchase-delete/<?php echo $arPurchase['purchase_id']; ?><?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>" class="btn btn-danger btn-mini">Borrar</a></li>
                                </ul>
                            </td>
                            <td><?php echo $arPurchase['purchase_status']; ?></td>
                            <td><?php echo $arPurchase['purchase_comments']; ?></td>
                            <td>
                                <p><?php echo $arPurchase['purchase_created']; ?></p>
                                <p>Creado</p>                                
                                <p><?php echo $arPurchase['purchase_changed']; ?></p>
                                <p>Última modificación</p>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row-fluid">      
        <div class="clearfix pull-right span4">
            <div class="alternate pagination pull-right">
                <div class="counter"><?php echo $iPurchases; ?> <?php if( $iPurchases === 1): ?>Compra<?php else: ?>Compras<?php endif; ?></div>
                <?php echo $sPagination; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
