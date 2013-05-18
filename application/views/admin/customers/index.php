<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Clientes</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/customers" class="current">Clientes</a>
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
    <?php if( ( ! isset( $_GET['s'] ) ) &&
              ( ! sizeof( $arCustomers ) ) ): ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content">
                <p>Aún no hay registrados clientes</p>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php if( $sLike ): ?>
    <div id="sub-header" class="row-fluid">
        <h2>Resultados de <?php echo $sLike; ?></h2>
    </div><!--#/sub-header-->
    <?php endif; ?>
    <div class="row-fluid">
        <?php echo form_open( '/admin/customers', array( 'method' => 'get' ) ) . "\n"; ?>
        <div class="clearfix filters pull-left span5">
            <div class="clearfix">
                <div class="form-item pull-left">
                    <?php echo form_dropdown( 'state_id', $arStates, $iStateId, 'id="state_id"' ) . "\n"; ?>
                </div>
                <div class="form-item pull-left">
                    <?php echo form_dropdown( 'user_id', $arUsers, $iUserId, 'id="user_id"' ) . "\n"; ?>
                </div>
                <div class="form-item pull-left">
                    <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn pull-right', 'content' => 'Filtrar' ) ) . "\n"; ?>
                </div>
            </div>
        </div>
        <div id="search" class="clearfix pull-right span3">
            <div class="pull-right">
                <?php echo form_input( array( 'name' => 's', 'value' => $sLike,  'autocomplete' => 'off', 'placeholder' => 'Buscar clientes', 'class' => 'pull-left' ) ) . "\n"; ?>
                <?php echo form_button( array( 'type' => 'submit', 'class' => 'pull-left', 'content' => '<i class="hide-text icon-search icon-white">Buscar</i>' ) ) . "\n"; ?>
            </div>
        </div>
        <?php echo form_close() . "\n"; ?>
    </div>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table" id="customers-buffer">
                    <thead>
                        <tr>
                            <th id="customer-name">Nombre</th>
                            <th id="customer-state">Estado</th>
                            <th id="customer-city">Municipio</th>
                            <th id="customer-media">Medio de comunicación</th>
                            <th id="customer-author">Autor</th>
                            <th id="customer-details">Detalles</th>
                            <th id="customer-date">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $arCustomers as $arCustomer ): ?>
                        <tr id="customer-<?php echo $arCustomer['customer_id']; ?>">
                            <td>
                                <a href="/admin/customers/customer-edit/<?php echo $arCustomer['customer_id']; ?>"><?php echo $arCustomer['customer_name']; ?></a>
                                <?php if( ( $this->ion_auth->is_admin() ) ||
                                          ( $arCustomer['user_id'] == $iCurrentUserId) ): ?>
                                <ul class="clearfix buffer-options">
                                    <li><a href="/admin/purchases?customer_id=<?php echo $arCustomer['customer_id']; ?>" class="btn btn-primary btn-mini">Todas las compras</a></li>
                                    <li><a href="/admin/purchases/purchase-new?customer_id=<?php echo $arCustomer['customer_id']; ?>" class="btn btn-primary btn-mini">Agregar compra</a></li>
                                    <li><a href="/admin/customers/customer-edit/<?php echo $arCustomer['customer_id']; ?>" class="btn btn-success btn-mini">Editar</a></li>
                                    <li><a href="/admin/customers/customer-delete/<?php echo $arCustomer['customer_id']; ?>" class="btn btn-danger btn-mini">Borrar</a></li>
                                </ul>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $arCustomer['state_name']; ?></td>
                            <td><?php echo $arCustomer['city_name']; ?></td>
                            <td><?php echo $arCustomer['customer_media']; ?></td>
                            <td><?php echo $arCustomer['username']; ?></td>
                            <td>
                                <?php if( $arCustomer['customer_company'] ) : ?>
                                <p>Empresa <?php echo $arCustomer['customer_company']; ?></p>
                                <?php endif; ?>
                                
                                <?php if( $arCustomer['customer_address'] ) : ?>
                                <p>Dirección <?php echo $arCustomer['customer_address']; ?></p>
                                <?php endif; ?>

                                <?php if( $arCustomer['customer_telephone'] ) : ?>                                
                                <p>Teléfono <?php echo $arCustomer['customer_telephone']; ?></p>
                                <?php endif; ?>
                                
                                <?php if( $arCustomer['customer_mobile'] ) : ?>
                                <p>Celular <?php echo $arCustomer['customer_mobile']; ?></p>
                                <?php endif; ?>
                                
                                <?php if( $arCustomer['customer_nextel'] ) : ?>
                                <p>Nextel <?php echo $arCustomer['customer_nextel']; ?></p>
                                <?php endif; ?>
                                
                                <?php if( $arCustomer['customer_email'] ) : ?>
                                <p>Email <a href="mailto:<?php echo urlencode( strip_tags( $arCustomer['customer_email'] ) ); ?>"><?php echo $arCustomer['customer_email']; ?></a></p>
                                <?php endif; ?>
                                
                                <?php if( $arCustomer['customer_comments'] ) : ?>
                                <p>Comentarios</p>
                                <p class="customer-comments"><?php echo $arCustomer['customer_comments']; ?></p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <p><?php echo $arCustomer['customer_created']; ?></p>
                                <p>Creado</p>                                
                                <?php if( $arCustomer['customer_changed'] ): ?>
                                    <p><?php echo $arCustomer['customer_changed']; ?></p>
                                    <p>Última modificación</p>
                                <?php endif; ?>
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
                <div class="counter"><?php echo $iCustomers; ?> <?php if( $iCustomers === 1): ?>Cliente<?php else: ?>Clientes<?php endif; ?></div>
                <?php echo $sPagination; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
