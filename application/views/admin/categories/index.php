<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Categorías</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/categories" class="current">Categorías</a>
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
    <?php if( ! sizeof( $arCategories ) ) : ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content">
                <p>Aún no hay registradas categorías</p>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table" id="categories-buffer">
                    <thead>
                        <tr>
                            <th id="category-name">Nombre</th>
                            <th id="category-permalink">Slug</th>
                            <th id="category-date">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $arCategories as $arCategory ): ?>
                        <tr id="category-<?php echo $arCategory['category_id']; ?>">
                            <td>
                                <a href="/admin/categories/category-edit/<?php echo $arCategory['category_id']; ?>"><?php echo $arCategory['category_name']; ?></a>
                                <ul class="clearfix buffer-options">
                                    <li><a href="/admin/categories/category-edit/<?php echo $arCategory['category_id']; ?>" class="btn btn-success btn-mini">Editar</a></li>
                                    <li><a href="/admin/categories/category-delete/<?php echo $arCategory['category_id']; ?>" class="btn btn-danger btn-mini">Borrar</a></li>
                                </ul>
                            </td>
                            <td><?php echo $arCategory['category_permalink']; ?></td>
                            <td>
                                <p><?php echo $arCategory['category_created']; ?></p>
                                <p>Creado</p>
                                <p><?php echo $arCategory['category_changed']; ?></p>
                                <p>Última modificación</p>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
