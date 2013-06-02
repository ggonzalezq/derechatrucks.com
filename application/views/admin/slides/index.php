<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Diapositivas</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/slides" class="current">Diapositivas</a>
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
              ( ! sizeof( $arSlides ) ) ): ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content">
                <p>Aún no hay registradas diapositivas</p>
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
        <?php echo form_open( '/admin/slides', array( 'method' => 'get' ) ) . "\n"; ?>
        <div class="clearfix filters pull-left span5">
            <div class="clearfix">
                <div class="form-item pull-left">
                    <?php echo form_dropdown( 'slide_active', array( 2 => 'Todos las diapositivas', 1 => 'Activas', 0 => 'No activas' ), $iSlideActive, 'id="slide_active"' ) . "\n"; ?>
                </div>
                <div class="form-item pull-left">
                    <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn pull-right', 'content' => 'Filtrar' ) ) . "\n"; ?>
                </div>
            </div>
        </div>
        <div id="search" class="clearfix pull-right span3">
            <div class="pull-right">
                <?php echo form_input( array( 'name' => 's', 'value' => $sLike,  'autocomplete' => 'off', 'placeholder' => 'Buscar diapositivas', 'class' => 'pull-left' ) ) . "\n"; ?>
                <?php echo form_button( array( 'type' => 'submit', 'class' => 'pull-left', 'content' => '<i class="hide-text icon-search icon-white">Buscar</i>' ) ) . "\n"; ?>
            </div>
        </div>
        <?php echo form_close() . "\n"; ?>
    </div>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table" id="slides-buffer">
                    <thead>
                        <tr>
                            <th id="slide-active">Activo</th>
                            <th id="slide-title">Título</th>
                            <th id="slide-picture">Imagen</th>
                            <th id="slide-anchor">Link</th>
                            <th id="slide-date">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $arSlides as $arSlide ): ?>
                        <tr id="slide-<?php echo $arSlide['slide_id']; ?>">
                            <td>
                                <?php echo form_open( $arSlide['slide_active'] ? '/admin/slides/slide-deactivate/' . $arSlide['slide_id'] : '/admin/slides/slide-activate/' . $arSlide['slide_id'], array( 'method' => 'post' ) ) . "\n"; ?>
                                    <?php echo form_checkbox( array( 'name' => '', 'value' => '1', 'checked' => $arSlide['slide_active'], 'class' => 'slide-active', 'id' => 'slide-active-' . $arSlide['slide_id'] ) ) . "\n"; ?>
                                <?php echo form_close() . "\n"; ?>
                            </td>
                            <td>
                                <a href="/admin/slides/slide-edit/<?php echo $arSlide['slide_id']; ?>"><?php echo $arSlide['slide_title']; ?></a>
                                <ul class="clearfix buffer-options">
                                    <li><a href="/admin/slides/slide-edit/<?php echo $arSlide['slide_id']; ?>" class="btn btn-success btn-mini">Editar</a></li>
                                    <li><a href="/admin/slides/slide-delete/<?php echo $arSlide['slide_id']; ?>" class="btn btn-danger btn-mini">Borrar</a></li>
                                </ul>
                            </td>
                            <td>
                                <img src="/uploads/slides/<?php echo $arSlide['slide_name']; ?>" alt="" />
                            </td>
                            <td><?php echo $arSlide['slide_anchor']; ?></td>
                            <td>
                                <p><?php echo $arSlide['slide_created']; ?></p>
                                <p>Creado</p>                                
                                <p><?php echo $arSlide['slide_changed']; ?></p>
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
                <div class="counter"><?php echo $iSlides; ?> <?php if( $iSlides === 1): ?>Diapositiva<?php else: ?>Diapositivas<?php endif; ?></div>
                <?php echo $sPagination; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
