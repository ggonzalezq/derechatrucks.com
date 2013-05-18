<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Clientes</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/customers">Clientes</a>
    <a href="/admin/customers/customer-statistics" class="current">Estadísticas</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <?php echo form_open( '/admin/customers/customer-statistics', array( 'method' => 'get' ) ) . "\n"; ?>
        <div class="clearfix filters pull-left">
            <div class="clearfix">
                <div class="form-item pull-left">
                    <?php echo form_dropdown( 'state_id', $arStates, $iStateId, 'id="state_id"' ) . "\n"; ?>
                </div>
                <div class="form-item pull-left">
                    <?php echo form_dropdown( 'city_id', $arCities, $iCityId, $iStateId === 0  ? 'disabled="disabled" id="city_id"' : 'id="city_id"' ) . "\n"; ?>
                </div>
                <div class="form-item pull-left">
                    <?php echo form_dropdown( 'user_id', $arUsers, $iUserId, 'id="user_id"' ) . "\n"; ?>
                </div>
                <div class="form-item pull-left">
                    <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn pull-right', 'content' => 'Filtrar' ) ) . "\n"; ?>
                </div>
            </div>
        </div>
        <?php echo form_close() . "\n"; ?>
    </div>
    <div class="row-fluid">
        <?php if( $iStateId === 0  ): ?>
        <div class="span3">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-briefcase"></i></span>
                    <h5>Clientes</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Clientes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $iTotal = 0; foreach( $arCustomersGroupedByState as $k => $v ): $iTotal += ( int ) $v['customer_total']; ?>
                                <tr>
                                    <td><?php if( ! empty( $v['state_name'] )  ): ?><?php echo $v['state_name']; ?><?php else: ?>No especificado<?php endif; ?></td>
                                    <td><?php echo $v['customer_total']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                                <tr>
                                    <td>Total de clientes</td>
                                    <td><strong><?php echo $iTotal;  ?></strong></td>
                                </tr>                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="span3">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-briefcase"></i></span>
                    <h5>Clientes</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ciudad</th>
                                <th>Clientes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $iTotal = 0; foreach( $arCustomersGroupedByCity as $k => $v ): $iTotal += ( int ) $v['customer_total']; ?>
                                <tr>
                                    <td><?php if( ! empty( $v['city_name'] )  ): ?><?php echo $v['state_name']; ?><?php else: ?>No especificada<?php endif; ?></td>
                                    <td><?php echo $v['customer_total']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                                <tr>
                                    <td>Total de clientes</td>
                                    <td><strong><?php echo $iTotal; ?></strong></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="span3">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-briefcase"></i></span>
                    <h5>Clientes</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Medios de comunicación</th>
                                <th>Clientes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( $arCustomersGroupedByMedia as $k => $v ): ?>
                                <tr>
                                    <td><?php echo $v['customer_media']; ?></td>
                                    <td><?php echo $v['customer_media_total']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                                <tr>
                                    <td>Total de clientes</td>
                                    <td><strong><?php echo $iTotal; ?></strong></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="span3">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-shopping-cart"></i></span>
                    <h5>Compras</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Compras</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $iTotal = 0; foreach( $arPurchasesGroupedByStatus as $k => $v ): $iTotal += ( int ) $v['purchase_status_total']; ?>
                                <tr>
                                    <td><?php echo $v['purchase_status']; ?></td>
                                    <td><?php echo $v['purchase_status_total']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                                <tr>
                                    <td>Total de compras</td>
                                    <td><strong><?php echo $iTotal; ?></strong></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="span3">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-shopping-cart"></i></span>
                    <h5>Compras</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Articulos</th>
                                <th>Compras</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( $arPurchasesGroupedByArticleStatus as $k => $v ): ?>
                                <tr>
                                    <td><?php echo $v['purchase_article_status']; ?></td>
                                    <td><?php echo $v['purchase_article_status_total']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                                <tr>
                                    <td>Total de compras</td>
                                    <td><strong><?php echo $iTotal; ?></strong></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
