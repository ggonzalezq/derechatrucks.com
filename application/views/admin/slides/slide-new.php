<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Diapositivas</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/slides">Diapositivas</a>
    <a href="/admin/slides/slide-new" class="current">Agregar nueva diapositiva</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Agregar nueva diapositiva</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php echo form_open_multipart( '/admin/slides/slide-new', array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <div class="control-group<?php if( $sUploadError ): ?> error<?php endif; ?>">
                            <?php echo form_label( 'Imagen', 'slide_name', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_upload( array( 'name' => 'slide_name', 'id' => 'slide_name' ) ) . "\n"; ?>
                                <?php if( $sUploadError ): echo $sUploadError;  endif; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Título', 'slide_title', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'slide_title', 'maxlength' => 255, 'value' => set_value( 'slide_title' ), 'id' => 'slide_title' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group<?php if( form_error( 'slide_anchor' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Link', 'slide_anchor', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'slide_anchor', 'value' => set_value( 'slide_anchor' ), 'id' => 'slide_anchor' ) ) . "\n"; ?>
                                <?php echo form_error( 'slide_anchor' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Badge oferta', 'slide_badge', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_checkbox( array( 'name' => 'slide_badge', 'value' => '1', 'checked' => set_value( 'slide_badge' ) === '1' ? TRUE : FALSE, 'id' => 'slide_badge' ) ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Guardar diapositiva' ) ) . "\n"; ?>
                            <a href="/admin/slides">Cancelar</a>
                        </div>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
