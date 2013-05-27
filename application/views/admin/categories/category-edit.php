<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Categorías</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/categories">Categorías</a>
    <a href="/admin/categories/category-edit/<?php echo $iCategoryId; ?>" class="current">Editar categoría</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Editar categoría</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php echo form_open( '/admin/categories/category-edit/' . $iCategoryId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <div class="control-group<?php if( form_error( 'category_name' ) ):?> error<?php endif; ?>">
                            <?php echo form_label( 'Nombre', 'category_name', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_input( array( 'name' => 'category_name', 'maxlength' => 255, 'value' => $arCategory['category_name'], 'id' => 'category_name' ) ) . "\n"; ?>
                                <?php echo form_error( 'category_name' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo form_label( 'Subcategoría de', 'category_parent', array( 'class' => 'control-label' ) ) . "\n"; ?>
                            <div class="controls">
                                <?php echo form_dropdown( 'category_parent', $arCategories, $arCategory['category_parent'], 'id="category_parent"' ) . "\n"; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Guardar categoría' ) ) . "\n"; ?>
                            <a href="/admin/categories">Cancelar</a>
                        </div>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
