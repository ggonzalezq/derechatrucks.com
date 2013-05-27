<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Clientes</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/customers">Clientes</a>
    <a href="/admin/customers/customer-edit/<?php echo $iCustomerId; ?>" class="current">Editar cliente</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?php if( ! $bPermission ): ?>
            <div class="alert alert-info">
                Tu no tienes permisos para editar este cliente
            </div>
            <?php endif; ?>
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Editar cliente</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php echo form_open( '/admin/customers/customer-edit/' . $iCustomerId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <?php if( ! $this->ion_auth->is_admin() ): ?>
                        <div class="control-group">
                            <?php echo form_label( 'Autor', 'customer_author', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <input type="text" name="customer_author" maxlength="255" value="<?php echo set_value( 'customer_author', $arCustomer['username'] ); ?>" disabled="disabled" id="customer_author" />
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="control-group<?php if( form_error( 'customer_name' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Nombre', 'customer_name', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <input type="text" name="customer_name" maxlength="255" value="<?php echo set_value( 'customer_name', $arCustomer['customer_name'] ); ?>" <?php if( ! $bPermission ): ?>disabled="disabled" <?php endif; ?>id="customer_name" />
                                <?php echo form_error( 'customer_name' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Empresa', 'customer_company', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <input type="text" name="customer_company" maxlength="255" value="<?php echo set_value( 'customer_company', $arCustomer['customer_company'] ); ?>" <?php if( ! $bPermission ): ?>disabled="disabled" <?php endif; ?>id="customer_company" />
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Dirección', 'customer_address', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <input type="text" name="customer_address" maxlength="255" value="<?php echo set_value( 'customer_address', $arCustomer['customer_address'] ); ?>" <?php if( ! $bPermission ): ?>disabled="disabled" <?php endif; ?>id="customer_address" />
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_telephone' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Teléfono', 'customer_telephone', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <input type="text" name="customer_telephone" maxlength="255" value="<?php echo set_value( 'customer_telephone', $arCustomer['customer_telephone'] ); ?>" <?php if( ! $bPermission ): ?>disabled="disabled" <?php endif; ?>id="customer_telephone" />
                                <?php echo form_error( 'customer_telephone' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_mobile' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Celular', 'customer_mobile', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <input type="text" name="customer_mobile" maxlength="255" value="<?php echo set_value( 'customer_mobile', $arCustomer['customer_mobile'] ); ?>" <?php if( ! $bPermission ): ?>disabled="disabled" <?php endif; ?>id="customer_mobile" />        
                                <?php echo form_error( 'customer_mobile' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_nextel' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Nextel', 'customer_nextel', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <input type="text" name="customer_nextel" maxlength="255" value="<?php echo set_value( 'customer_nextel', $arCustomer['customer_nextel'] ); ?>" <?php if( ! $bPermission ): ?>disabled="disabled" <?php endif; ?>id="customer_nextel" />
                                <?php echo form_error( 'customer_nextel' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_email' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Email', 'customer_email', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <input type="text" name="customer_email" maxlength="255" value="<?php echo set_value( 'customer_email', $arCustomer['customer_email'] ); ?>" <?php if( ! $bPermission ): ?>disabled="disabled" <?php endif; ?>id="customer_email" />
                                <?php echo form_error( 'customer_email' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Estado', 'state_id', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <select name="state_id" <?php if( ! $bPermission): ?>disabled="disabled"<?php endif; ?> id="state_id">
                                    <?php foreach( $arStates as $k => $v ): ?>
                                    <option value="<?php echo $k; ?>"<?php echo set_select( 'state_id', $k, $k == $arCustomer['state_id'] ? TRUE : FALSE ); ?>><?php echo $v; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                            
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Ciudad', 'city_id', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <select name="city_id" <?php if( ! $bPermission): ?>disabled="disabled"<?php endif; ?> id="city_id">
                                    <?php foreach( $arCities as $k => $v ): ?>
                                    <option value="<?php echo $k; ?>"<?php echo set_select( 'city_id', $k, $k == $arCustomer['city_id'] ? TRUE : FALSE ); ?>><?php echo $v; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'customer_media' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Medio de comunicación', 'customer_media', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <select name="customer_media" <?php if( ! $bPermission): ?>disabled="disabled"<?php endif; ?> id="customer_media">
                                    <?php foreach( $arMedia as $k => $v ): ?>
                                    <option value="<?php echo $k; ?>"<?php echo set_select( 'customer_media', $k, $k == $arCustomer['customer_media'] ? TRUE : FALSE ); ?>><?php echo $v; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error( 'customer_media' ) . "\n"; ?>
                            </div>
                        </div>                              
                        <div class="control-group">
                            <?php echo form_label( 'Comentarios', 'customer_comments', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <textarea name="customer_comments" id="customer_comments" cols="40" rows="10"<?php if( ! $bPermission): ?> disabled="disabled"<?php endif; ?>><?php echo set_value( 'customer_comments', $arCustomer['customer_comments'] ); ?></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"<?php if( ! $bPermission): ?> disabled="disabled"<?php endif; ?>>Guardar cliente</button>
                            <a href="/admin/customers">Cancelar</a>
                        </div>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
