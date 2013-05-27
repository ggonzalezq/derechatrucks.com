<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Categorías</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/categories">Categorías</a>
    <a href="/admin/categories/category-delete/<?php echo $iCategoryId; ?>" class="current">Borrar categoría</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-align-justify"></i></span>
                    <h5>Borrar categoría</h5>
                </div>
                <div class="widget-content">
                    <h4>¿Realmente desea borrar este categoría?</h4>
                    <h5><?php echo $arCategory['category_name']; ?></h5>
                    <?php echo form_open( '/admin/categories/category-delete/' . $iCategoryId, array( 'class' => 'form-horizontal' ) ) . "\n"; ?>
                        <?php echo form_hidden( 'category_id', $iCategoryId ) . "\n"; ?>
                        <?php echo form_button( array( 'type' => 'submit', 'class' => 'btn btn-primary', 'content' => 'Borrar categoría' ) ) . "\n"; ?>
                        <a href="/admin/categories">Cancelar</a>
                    <?php echo form_close() . "\n"; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
