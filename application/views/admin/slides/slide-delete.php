<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Diapositivas</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/slides">Slides</a>
    <a href="/admin/slides/slide-delete/<?php echo $iSlideId; ?>" class="current">Borrar diapositiva</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Borrar diapositiva</h5>
                </div>
                <div class="widget-content">
                    <h4>¿Realmente desea borrar esta diapositiva?</h4>
                    <h5><?php echo $arSlide['slide_name']; ?></h5>
                    <?php echo form_open( '/admin/slides/slide-delete/' . $iSlideId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <?php echo form_hidden( 'slide_id', $iSlideId ) . "\n"; ?>
                        <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Borrar diapositiva' ) ) . "\n"; ?>
                        <a href="/admin/slides">Cancelar</a>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
