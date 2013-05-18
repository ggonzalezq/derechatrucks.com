<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Clientes</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/customers">Clientes</a>
    <a href="/admin/customers/customer-new" class="current">Agregar nuevo cliente</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Agregar nuevo cliente</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php echo form_open( '/admin/customers/customer-new', array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <div class="control-group<?php if( form_error( 'customer_name' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Nombre', 'customer_name', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'customer_name', 'maxlength' => 255, 'value' => $arCustomer['customer_name'], 'id' => 'customer_name' ) ) . "\n"; ?>
                                <?php echo form_error( 'customer_name' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Empresa', 'customer_company', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'customer_company', 'maxlength' => 255, 'value' => $arCustomer['customer_company'], 'id' => 'customer_company' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Dirección', 'customer_address', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'customer_address', 'maxlength' => 255, 'value' => $arCustomer['customer_address'], 'id' => 'customer_address' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_telephone' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Teléfono', 'customer_telephone', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'customer_telephone', 'maxlength' => 255, 'value' => $arCustomer['customer_telephone'], 'id' => 'customer_telephone' ) ) . "\n"; ?>
                                <?php echo form_error( 'customer_telephone' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_mobile' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Celular', 'customer_mobile', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'customer_mobile', 'maxlength' => 255, 'value' => $arCustomer['customer_mobile'], 'id' => 'customer_mobile' ) ) . "\n"; ?>
                                <?php echo form_error( 'customer_mobile' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_nextel' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Nextel', 'customer_nextel', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'customer_nextel', 'maxlength' => 255, 'value' => $arCustomer['customer_nextel'], 'id' => 'customer_nextel' ) ) . "\n"; ?>
                                <?php echo form_error( 'customer_nextel' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_email' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Email', 'customer_email', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'customer_email', 'maxlength' => 255, 'value' => $arCustomer['customer_email'], 'id' => 'customer_email' ) ) . "\n"; ?>
                                <?php echo form_error( 'customer_email' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Estado', 'state_id', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'state_id', $arStates, $arCustomer['state_id'], 'id="state_id"' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Ciudad', 'city_id', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'city_id', $arCities, $arCustomer['city_id'], $arCustomer['state_id'] === 0  ? 'disabled="disabled" id="city_id"' : 'id="city_id"' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_media' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Medio de comunicación', 'customer_media', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'customer_media', $arMedia, $arCustomer['customer_media'], 'id="customer_media"' ) . "\n"; ?>
                                <?php echo form_error( 'customer_media' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Comentarios', 'customer_comments', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_textarea( array( 'name' => 'customer_comments', 'value' => $arCustomer['customer_comments'], 'id' => 'customer_comments' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <?php echo form_button( array( 'type' => 'submit', 'name' => 'action', 'value' => '1', 'class' => 'btn btn-primary', 'content' => 'Guardar cliente' ) ) . "\n"; ?>
                            <?php echo form_button( array( 'type' => 'submit', 'name' => 'action', 'value' => '2', 'class' => 'btn btn-primary', 'content' => 'Guardar cliente y agregar compra' ) ) . "\n"; ?>
                            <a href="/admin/customers">Cancelar</a>
                        </div>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
