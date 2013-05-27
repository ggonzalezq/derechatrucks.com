<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Compras<?php if( isset( $arCustomer['customer_name'] ) ): ?> de <?php echo $arCustomer['customer_name']; ?><?php endif; ?></h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/purchases<?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>">Compras</a>
    <a href="/admin/purchases/purchase-edit/<?php echo $iPurchaseId; ?><?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>" class="current">Editar compra</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Editar compra</h5>
                </div>
                <div class="widget-content nopadding">                    
                    <?php echo form_open( $iCustomerId ? '/admin/purchases/purchase-edit/' . $iPurchaseId . '?customer_id=' . $iCustomerId : '/admin/purchases/purchase-edit/' . $iPurchaseId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <div class="control-group<?php if( form_error( 'customer_id' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Cliente', 'customer_id', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'customer_id', $arCustomers, $arPurchase['customer_id'], 'id="customer_id"' ) . "\n"; ?>
                                <?php echo form_error( 'customer_id' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">                           
                            <div class="control-label">Interesado en articulo</div>
                            <div class="controls">
                                <?php foreach( $arArticleStatus as $k => $v ): ?>
                                <label><?php echo form_radio( array( 'name' => 'purchase_article_status', 'value' => $k, 'checked' => $k === $arPurchase['purchase_article_status'] ? TRUE : FALSE ) ); ?> <?php echo $v; ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'article_id' ) ):?> error<?php endif; ?><?php if( $arPurchase['purchase_article_status'] !== 1 ): ?> none<?php endif; ?>" id="article-available">
                            <?php echo form_label( 'Articulo', 'article_id', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'article_id', $arArticles, $arPurchase['article_id'], 'id="article_id"' ) . "\n"; ?>
                                <?php echo form_error( 'article_id' ) . "\n"; ?>
                            </div>
                        </div>
                        <div <?php if( $arPurchase['purchase_article_status'] !== 0 ): ?> class="none" <?php endif; ?>id="article-not-available">
                            <div class="control-group<?php if( form_error( 'purchase_brand' ) ):?> error<?php endif; ?>">
                                <?php echo form_label( 'Marca', 'purchase_brand', array( 'class' => 'control-label' ) ) . "\n"; ?>
                                <div class="controls">
                                    <?php echo form_input( array( 'name' => 'purchase_brand', 'maxlength' => 255, 'value' => $arPurchase['purchase_brand'], 'id' => 'purchase_brand' ) ) . "\n"; ?>
                                    <?php echo form_error( 'purchase_brand' ) . "\n"; ?>
                                </div>
                            </div>
                            <div class="control-group<?php if( form_error( 'purchase_model' ) ):?> error<?php endif; ?>">
                                <?php echo form_label( 'Modelo', 'purchase_model', array( 'class' => 'control-label' ) ) . "\n"; ?>
                                <div class="controls">
                                    <?php echo form_input( array( 'name' => 'purchase_model', 'maxlength' => 255, 'value' => $arPurchase['purchase_model'], 'id' => 'purchase_model' ) ) . "\n"; ?>
                                    <?php echo form_error( 'purchase_model' ) . "\n"; ?>
                                </div>
                            </div>
                            <div class="control-group<?php if( form_error( 'purchase_year' ) ):?> error<?php endif; ?>">
                                <?php echo form_label( 'Año', 'purchase_year', array( 'class' => 'control-label' ) ) . "\n"; ?>
                                <div class="controls">
                                    <?php echo form_input( array( 'name' => 'purchase_year', 'maxlength' => 4, 'value' => $arPurchase['purchase_year'], 'id' => 'purchase_year' ) ) . "\n"; ?>
                                    <?php echo form_error( 'purchase_year' ) . "\n"; ?>
                                </div>
                            </div>
                        </div><!--#/article-not-available-->
                        <div class="control-group<?php if( form_error( 'purchase_status' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Status', 'purchase_status', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'purchase_status', $arPurchaseStatus, $arPurchase['purchase_status'], 'id="purchase_status"' ) . "\n"; ?>
                                <?php echo form_error( 'purchase_status' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Comentarios', 'purchase_comments', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_textarea( array( 'name' => 'purchase_comments', 'value' => $arPurchase['purchase_comments'], 'id' => 'purchase_comments' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Guardar compra' ) ) . "\n"; ?>
                            <a href="/admin/purchases<?php if( $iCustomerId ): ?>?customer_id=<?php echo $iCustomerId; ?><?php endif; ?>">Cancelar</a>
                        </div>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
